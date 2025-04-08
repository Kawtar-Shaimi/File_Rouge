<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Category;
use App\Models\Book;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{

    public function __construct()
    {
        $this->middleware('guestAuth')->only(['index', 'show']);
        $this->middleware('auth:publisher')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $search = $request->input('query');

        $books = $search ? Book::where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->where('stock', '>', 0)
            ->paginate(12)
            : Book::where('stock', '>', 0)->paginate(12);

        if (Auth::guard('client')->check()) {
            foreach ($books as $book) {
                $query = $book->join('carts_books', 'books.id', '=', 'carts_books.book_id')
                    ->join('carts', 'carts_books.cart_id', '=', 'carts.id')
                    ->where('carts.client_id', Auth::guard('client')->id())
                    ->where('books.id', $book->id);

                $book->isInCart = $query->exists();

                $book->bookQuantity = $book->isInCart
                    ? $query->first()->quantity
                    : 0;

                $book->isInWishlist = $book->join('wishlists_books', 'books.id', '=', 'wishlists_books.book_id')
                    ->join('wishlists', 'wishlists_books.wishlist_id', '=', 'wishlists.id')
                    ->where('wishlists.client_id', Auth::guard('client')->id())
                    ->where('books.id', $book->id)->exists();
            }
        }

        $categories = Category::all();

        return view('books.index', compact('books', 'search', 'categories'));
    }

    public function show(string $uuid)
    {
        $book = Book::where('uuid', $uuid)->firstOrFail();

        $book->load(['reviews', 'reviews.client']);
        $book->loadCount('reviews');
        $book->loadAvg('reviews', 'rate');
        if (Auth::guard('client')->check()) {
            $query = $book->join('carts_books', 'books.id', '=', 'carts_books.book_id')
                ->join('carts', 'carts_books.cart_id', '=', 'carts.id')
                ->where('carts.client_id', Auth::guard('client')->id())
                ->where('books.id', $book->id);

            $book->isInCart = $query->exists();

            $book->bookQuantity = $book->isInCart
                ? $query->first()->quantity
                : 0;

            $book->isInWishlist = $book->join('wishlists_books', 'books.id', '=', 'wishlists_books.book_id')
                ->join('wishlists', 'wishlists_books.wishlist_id', '=', 'wishlists.id')
                ->where('wishlists.client_id', Auth::guard('client')->id())
                ->where('books.id', $book->id)->exists();

            $book->isReviewed = $book->reviews()
                ->where('reviews.client_id', Auth::guard('client')->id())
                ->where('reviews.book_id', $book->id)->exists();
        }
        return view('books.show', compact('book'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('publisher.books.create', compact('categories'));
    }

    public function store(StoreBookRequest $request)
    {
        $category = Category::where('uuid', $request->category_id)->firstOrFail();

        $image = $request->file('image');
        $image_name = uniqid("book_") . "_" . time() . "." . $image->extension();
        $image_path = $image->storeAs('books_images', $image_name, 'public');

        $book = Book::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $category->id,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $image_path,
            'publisher_id' => Auth::guard('publisher')->id(),
        ]);

        if (!$book) {
            return back()->with('error', 'Book creation failed');
        }

        return redirect()->route('publisher.books.index')->with('success', 'Book created successfully');
    }

    public function edit(string $uuid)
    {
        $book = Book::where('uuid', $uuid)->firstOrFail();
        $categories = Category::all();
        return view('publisher.books.edit', compact('book', 'categories'));
    }

    public function update(UpdateBookRequest $request, string $uuid)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,uuid',
            'stock' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $book = Book::where('uuid', $uuid)->firstOrFail();

        $category = Category::where('uuid', $request->category_id)->firstOrFail();

        $isUpdated = $book->update([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $category->id,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        if (!$isUpdated) {
            return back()->with('error', 'Book update failed');
        }

        if ($request->hasFile('image')) {
            if ($book->image) {
                $isImageDeleted = Storage::disk('public')->delete($book->image);

                if (!$isImageDeleted) {
                    return back()->with('error', 'Book image deletion failed');
                }

                $image = $request->file('image');
                $image_name = uniqid("book_") . "_" . time() . "." . $image->extension();
                $image_path = $image->storeAs('books_images', $image_name, 'public');
                $isImageUpdated = $book->update([
                    'image' => $image_path
                ]);
                if (!$isImageUpdated) {
                    return back()->with('error', 'Book image update failed');
                }
            }
        }

        return redirect()->route('publisher.books.index')->with('success', 'Book updated successfully');
    }

    public function destroy(string $uuid)
    {

        $book = Book::where('uuid', $uuid)->firstOrFail();

        if ($book->image) {
            $isImageDeleted = Storage::disk('public')->delete($book->image);

            if (!$isImageDeleted) {
                return back()->with('error', 'Book image deletion failed');
            }
        }

        $isDeleted = $book->delete();

        if (!$isDeleted) {
            return back()->with('error', 'Book deletion failed');
        }

        return redirect()->route('publisher.books.index')->with('success', 'Book deleted successfully');
    }
}
