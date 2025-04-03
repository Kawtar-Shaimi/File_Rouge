<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::where('stock', '>', 0)->withSum('orderBooks', 'quantity')
            ->orderBy('order_books_sum_quantity', 'desc')
            ->take(4)
            ->get();

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

        return view('index', compact('books'));
    }
}
