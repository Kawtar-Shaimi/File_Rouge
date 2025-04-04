<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderBook;
use App\Models\Payment;
use App\Models\Review;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilterController extends Controller
{

    public function filterBooks(Request $request)
    {
        $this->middleware('auth:admin');

        $searchQuery = $request->input('query', '');
        $sortBy = $request->input('sort', 'id');
        $sortOrder = $request->input('order', 'asc');


        $books = Book::selectRaw('books.*, categories.name as category_name, users.name as publisher_name')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->join('users', 'books.publisher_id', '=', 'users.id')
            ->where('books.name', 'LIKE', "%{$searchQuery}%")
            ->orWhere('books.description', 'LIKE', "%{$searchQuery}%")
            ->orWhere('categories.name', 'LIKE', "%{$searchQuery}%")
            ->orWhere('users.name', 'LIKE', "%{$searchQuery}%")
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'html' => view('admin.books.partial.books-list', compact('books'))->render(),
                ],
            ],200)->header('Content-Type', 'application/json');
        }
        return view('admin.books.index', compact('books'));
    }

    public function filterCategories(Request $request)
    {
        $this->middleware('auth:admin');

        $searchQuery = $request->input('query', '');
        $sortBy = $request->input('sort', 'id');
        $sortOrder = $request->input('order', 'asc');

        $categories = Category::selectRaw('categories.*, users.name as admin_name')
            ->join('users', 'categories.admin_id', '=', 'users.id')
            ->where('categories.name', 'LIKE', "%{$searchQuery}%")
            ->orWhere('users.name', 'LIKE', "%{$searchQuery}%")
            ->orWhere('categories.description', 'LIKE', "%{$searchQuery}%")
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'html' => view('admin.categories.partial.categories-list', compact('categories'))->render(),
                ],
            ],200)->header('Content-Type', 'application/json');
        }
        return view('admin.categories.index', compact('categories'));
    }

    public function filterOrders(Request $request)
    {
        $this->middleware('auth:admin');

        $searchQuery = $request->input('query', '');
        $sortBy = $request->input('sort', 'id');
        $sortOrder = $request->input('order', 'asc');

        $orders = Order::selectRaw('orders.*, users.name as client_name, users.email as client_email')
            ->join('users', 'orders.client_id', '=', 'users.id')
            ->where('users.name', 'LIKE', "%{$searchQuery}%")
            ->orWhere('users.email', 'LIKE', "%{$searchQuery}%")
            ->orwhere('order_number', 'LIKE', "%{$searchQuery}%")
            ->orWhere('status', 'LIKE', "%{$searchQuery}%")
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'html' => view('admin.orders.partial.orders-list', compact('orders'))->render(),
                ],
            ],200)->header('Content-Type', 'application/json');
        }
        return view('admin.orders.index', compact('orders'));
    }

    public function filterReviews(Request $request)
    {
        $this->middleware('auth:admin');

        $searchQuery = $request->input('query', '');
        $sortBy = $request->input('sort', 'id');
        $sortOrder = $request->input('order', 'asc');

        $reviews = Review::selectRaw('reviews.*, users.name as client_name, books.name as book_name')
            ->join('users', 'reviews.client_id', '=', 'users.id')
            ->join('books', 'reviews.book_id', '=', 'books.id')
            ->where('books.name', 'LIKE', "%{$searchQuery}%")
            ->orWhere('reviews.content', 'LIKE', "%{$searchQuery}%")
            ->orWhere('users.name', 'LIKE', "%{$searchQuery}%")
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'html' => view('admin.reviews.partial.reviews-list', compact('reviews'))->render(),
                ],
            ],200)->header('Content-Type', 'application/json');
        }
        return view('admin.reviews.index', compact('reviews'));
    }

    public function filterUsers(Request $request)
    {
        $this->middleware('auth:admin');

        $searchQuery = $request->input('query', '');
        $sortBy = $request->input('sort', 'id');
        $sortOrder = $request->input('order', 'asc');

        $users = User::where('name', 'LIKE', "%{$searchQuery}%")
            ->orWhere('email', 'LIKE', "%{$searchQuery}%")
            ->orWhere('role', 'LIKE', "%{$searchQuery}%")
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'html' => view('admin.users.partial.users-list', compact('users'))->render(),
                ],
            ],200)->header('Content-Type', 'application/json');
        }
        return view('admin.users.index', compact('users'));
    }

    public function filterPayments(Request $request)
    {
        $this->middleware('auth:admin');

        $searchQuery = $request->input('query', '');
        $sortBy = $request->input('sort', 'id');
        $sortOrder = $request->input('order', 'asc');

        $payments = Payment::selectRaw('payments.*, users.name as client_name, users.email as client_email')
            ->join('orders', 'payments.order_id', '=', 'orders.id')
            ->join('users', 'orders.client_id', '=', 'users.id')
            ->Where('payments.status', 'LIKE', "%{$searchQuery}%")
            ->orWhere('payments.order_number', 'LIKE', "%{$searchQuery}%")
            ->orWhere('users.name', 'LIKE', "%{$searchQuery}%")
            ->orWhere('users.email', 'LIKE', "%{$searchQuery}%")
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'html' => view('admin.payments.partial.payments-list', compact('payments'))->render(),
                ],
            ],200)->header('Content-Type', 'application/json');
        }
        return view('admin.payments.index', compact('payments'));
    }

    public function filterVisits(Request $request)
    {
        $this->middleware('auth:admin');

        $searchQuery = $request->input('query', '');
        $sortBy = $request->input('sort', 'id');
        $sortOrder = $request->input('order', 'asc');

        $visits = Visit::where('ip_address', 'LIKE', "%{$searchQuery}%")
            ->orWhere('user_agent', 'LIKE', "%{$searchQuery}%")
            ->orWhere('last_visited_url', 'LIKE', "%{$searchQuery}%")
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'html' => view('admin.visits.partial.visits-list', compact('visits'))->render(),
                ],
            ],200)->header('Content-Type', 'application/json');
        }
        return view('admin.visits.index', compact('visits'));
    }

    public function filterPublishersBooks(Request $request)
    {
        $this->middleware('auth:publisher');

        $searchQuery = $request->input('query', '');
        $sortBy = $request->input('sort', 'id');
        $sortOrder = $request->input('order', 'asc');

        $books = Book::selectRaw('books.*, categories.name as category_name')
        ->join('categories', 'books.category_id', '=', 'categories.id')
        ->where('books.publisher_id', Auth::guard('publisher')->id())
        ->where(function ($query) use ($searchQuery) {
            $query->where('books.name', 'LIKE', "%{$searchQuery}%")
                  ->orWhere('books.description', 'LIKE', "%{$searchQuery}%")
                  ->orWhere('categories.name', 'LIKE', "%{$searchQuery}%");
        })
        ->orderBy($sortBy, $sortOrder)
        ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'html' => view('publisher.books.partial.books-list', compact('books'))->render(),
                ],
            ],200)->header('Content-Type', 'application/json');
        }
        return view('publisher.books.index', compact('books'));
    }

    public function filterPublishersReviews(Request $request)
    {
        $this->middleware('auth:publisher');

        $searchQuery = $request->input('query', '');
        $sortBy = $request->input('sort', 'id');
        $sortOrder = $request->input('order', 'asc');

        $reviews = Review::selectRaw('reviews.*, users.name as client_name, books.name as book_name')
        ->join('users', 'reviews.client_id', '=', 'users.id')
        ->join('books', 'reviews.book_id', '=', 'books.id')
        ->where('books.publisher_id', Auth::guard('publisher')->id())
        ->where(function ($query) use ($searchQuery) {
            $query->where('books.name', 'LIKE', "%{$searchQuery}%")
                  ->orWhere('reviews.content', 'LIKE', "%{$searchQuery}%")
                  ->orWhere('users.name', 'LIKE', "%{$searchQuery}%");
        })
        ->orderBy($sortBy, $sortOrder)
        ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'html' => view('publisher.reviews.partial.reviews-list', compact('reviews'))->render(),
                ],
            ],200)->header('Content-Type', 'application/json');
        }
        return view('publisher.reviews.index', compact('reviews'));
    }

    public function filterPublishersOrders(Request $request)
    {
        $this->middleware('auth:publisher');
        
        $searchQuery = $request->input('query', '');
        $sortBy = $request->input('sort', 'id');
        $sortOrder = $request->input('order', 'asc');

        $orders = OrderBook::selectRaw('orders_books.*, users.name as client_name, users.email as client_email')
        ->join('orders', 'orders_books.order_id', '=', 'orders.id')
        ->join('users', 'orders.client_id', '=', 'users.id')
        ->join('books', 'orders_books.book_id', '=', 'books.id')
        ->where('books.publisher_id', Auth::guard('publisher')->id())
        ->where(function ($query) use ($searchQuery) {
            $query->where('orders.status', 'LIKE', "%{$searchQuery}%")
                  ->orWhere('orders.order_number', 'LIKE', "%{$searchQuery}%")
                  ->orWhere('users.name', 'LIKE', "%{$searchQuery}%")
                  ->orWhere('users.email', 'LIKE', "%{$searchQuery}%");
        })
        ->orderBy($sortBy, $sortOrder)
        ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'html' => view('publisher.orders.partial.orders-list', compact('orders'))->render(),
                ],
            ],200)->header('Content-Type', 'application/json');
        }
        return view('publisher.orders.index', compact('orders'));
    }

    public function getBooksSearchTerms(Request $request){

        $this->middleware('auth:admin');

        $searchQuery = $request->input('query', '');

        $searchTerms = Book::selectRaw('distinct books.name, categories.name as category_name')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->join('users', 'books.publisher_id', '=', 'users.id')
            ->where('books.name', 'LIKE', "%{$searchQuery}%")
            ->orWhere('books.description', 'LIKE', "%{$searchQuery}%")
            ->orWhere('categories.name', 'LIKE', "%{$searchQuery}%")
            ->orWhere('users.name', 'LIKE', "%{$searchQuery}%")
            ->orderBy('books.name', 'asc')
            ->limit(5)
            ->get()
            ->flatMap(fn ($book) => [
                    $book->name
                ]
            )
            ->toArray();

        return response()->json([
            'status' => 'success',
            'data' => [
                'searchTerms' => $searchTerms,
            ],
        ],200)->header('Content-Type', 'application/json');

    }

    public function filterClientBooks(Request $request)
    {
        $search = $request->input('query');
        $sortBy = $request->input('sort');
        $sortOrder = $request->input('order');
        $category = $request->input('category');

        $query = Book::where('stock', '>', 0);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category_id', $category);
        }

        if ($sortBy) {
            $query->orderBy($sortBy, $sortOrder ?? 'asc');
        }

        $books = $query->paginate(12);
        
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

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'html' => view('books.partial.books-grid', compact('books'))->render(),
                ],
            ],200)->header('Content-Type', 'application/json');
        }
        return view('books.index', compact('books'));
    }
}
