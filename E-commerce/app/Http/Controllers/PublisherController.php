<?php

namespace App\Http\Controllers;

use App\Mail\AdminOrderBookCanceled;
use App\Mail\ClientOrderBookCanceled;
use App\Mail\PublisherOrderBookCanceled;
use App\Models\OrderBook;
use App\Models\Book;
use App\Models\Client;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PublisherController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:publisher');
    }

    public function index()
    {
        $colors = ['green', 'brown', 'yellow', 'blue', 'orange', 'red', 'pink', 'purple', 'indigo', 'teal'];

        $books_count = Book::where('publisher_id', Auth::guard('publisher')->id())->count();
        $orders_count = OrderBook::whereHas('book', function ($query) {
            $query->where('publisher_id', Auth::guard('publisher')->id());
        })->count();
        $reviews_count = Review::whereHas('book', function ($query) {
            $query->where('publisher_id', Auth::guard('publisher')->id());
        })->count();

        $incomes = number_format(OrderBook::selectRaw("SUM(total - (total * 0.3)) as amount")
            ->whereHas('book', function ($query) {
                $query->where('publisher_id', Auth::guard('publisher')->id());
            })
            ->whereHas('order', function ($query) {
                $query->where('status', 'completed');
            })
            ->first()->amount, 2);

        $incomes_chart_data = Order::selectRaw("DATE_FORMAT(orders.updated_at, '%Y-%m-%d %H:00') as full_date, TIME_Format(orders.updated_at, '%H:00') as time, SUM(total - (total * 0.3)) as amount")
            ->join('orders_books', 'orders.id', '=', 'orders_books.order_id')
            ->join('books', 'orders_books.book_id', '=', 'books.id')
            ->where('books.publisher_id', Auth::guard('publisher')->id())
            ->where('status', 'completed')
            ->groupBy('full_date', 'time')
            ->orderBy('full_date')
            ->get()
            ->map(
                fn($item) =>  [
                    $item->time,
                    (float) number_format($item->amount, 2)
                ]
            );

        shuffle($colors);
        $best_saled_books_chart_data = Order::selectRaw('books.name, SUM(orders_books.total * 0.3) as income')
            ->join('orders_books', 'orders.id', '=', 'orders_books.order_id')
            ->join('books', 'orders_books.book_id', '=', 'books.id')
            ->where('books.publisher_id', Auth::guard('publisher')->id())
            ->where('orders.status', 'completed')
            ->groupBy('books.id', 'books.name')
            ->orderByDesc('income')
            ->limit(5)
            ->get()
            ->map(fn($item, $key) =>  [
                $item->name,
                (float) number_format($item->income, 2),
                $colors[$key]
            ]);

        shuffle($colors);
        $best_saled_books_of_the_month_chart_data = Order::selectRaw('books.name, SUM(orders_books.total * 0.3) as income')
            ->join('orders_books', 'orders.id', '=', 'orders_books.order_id')
            ->join('books', 'orders_books.book_id', '=', 'books.id')
            ->where('books.publisher_id', Auth::guard('publisher')->id())
            ->where('orders.status', 'completed')
            ->whereMonth('orders.updated_at', now()->month)
            ->groupBy('books.id', 'books.name')
            ->orderByDesc('income')
            ->limit(5)
            ->get()
            ->map(fn($item, $key) =>  [
                $item->name,
                (float) number_format($item->income, 2),
                $colors[$key]
            ]);

        shuffle($colors);
        $best_saled_categories_chart_data = Order::selectRaw('categories.name, SUM(orders_books.total * 0.3) as income')
            ->join('orders_books', 'orders.id', '=', 'orders_books.order_id')
            ->join('books', 'orders_books.book_id', '=', 'books.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->where('books.publisher_id', Auth::guard('publisher')->id())
            ->where('orders.status', 'completed')
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('income')
            ->limit(5)
            ->get()
            ->map(fn($item, $key) =>  [
                $item->name,
                (float) number_format($item->income, 2),
                $colors[$key]
            ]);

        shuffle($colors);
        $best_saled_categories_of_the_month_chart_data = Order::selectRaw('categories.name, SUM(orders_books.total * 0.3) as income')
            ->join('orders_books', 'orders.id', '=', 'orders_books.order_id')
            ->join('books', 'orders_books.book_id', '=', 'books.id')
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->where('books.publisher_id', Auth::guard('publisher')->id())
            ->where('orders.status', 'completed')
            ->whereMonth('orders.updated_at', now()->month)
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('income')
            ->limit(5)
            ->get()
            ->map(fn($item, $key) =>  [
                $item->name,
                (float) number_format($item->income, 2),
                $colors[$key]
            ]);

        shuffle($colors);
        $best_rated_books_chart_data = Book::selectRaw('books.name, AVG(reviews.rate) as rating')
            ->join('reviews', 'reviews.book_id', '=', 'books.id')
            ->where('books.publisher_id', Auth::guard('publisher')->id())
            ->groupBy('books.id', 'books.name')
            ->orderByDesc('rating')
            ->limit(5)
            ->get()
            ->map(fn($item, $key) =>  [
                $item->name,
                (float) number_format($item->rating, 1),
                $colors[$key]
            ]);

        shuffle($colors);
        $best_rated_books_of_the_month_chart_data = Book::selectRaw('books.name, AVG(reviews.rate) as rating')
            ->join('reviews', 'reviews.book_id', '=', 'books.id')
            ->where('books.publisher_id', Auth::guard('publisher')->id())
            ->whereMonth('reviews.updated_at', now()->month)
            ->groupBy('books.id', 'books.name')
            ->orderByDesc('rating')
            ->limit(5)
            ->get()
            ->map(fn($item, $key) =>  [
                $item->name,
                (float) number_format($item->rating, 1),
                $colors[$key]
            ]);


        return view(
            'publisher.index',
            compact(
                'books_count',
                'orders_count',
                'reviews_count',
                'incomes',
                'incomes_chart_data',
                'best_saled_books_chart_data',
                'best_saled_books_of_the_month_chart_data',
                'best_saled_categories_chart_data',
                'best_saled_categories_of_the_month_chart_data',
                'best_rated_books_chart_data',
                'best_rated_books_of_the_month_chart_data'
            )
        );
    }

    public function orders()
    {
        $orders = OrderBook::with(['order', 'book', 'order.client'])->whereHas('book', function ($query) {
            $query->where('publisher_id', Auth::guard('publisher')->id());
        })->paginate(10);

        return view('publisher.orders.index', compact('orders'));
    }

    public function order(string $uuid)
    {
        $order = OrderBook::with(['order', 'book', 'order.client'])->whereHas('book', function ($query) {
            $query->where('publisher_id', Auth::guard('publisher')->id());
        })->whereHas('order', function ($query) use ($uuid) {
            $query->where('uuid', $uuid);
        })->first();

        return view('publisher.orders.show', compact('order'));
    }

    public function cancelOrder(Request $request, string $uuid)
    {

        if ($request->cancellation_reason === "") {
            return back()->with('error', 'Please enter a cancellation reason');
        }

        $order = OrderBook::with(['order', 'book', 'order.client'])->whereHas('book', function ($query) {
            $query->where('publisher_id', Auth::guard('publisher')->id());
        })->whereHas('order', function ($query) use ($uuid) {
            $query->where('uuid', $uuid);
        })->first();

        $is_updated = $order->update([
            'is_cancelled' => true,
            'cancellation_reason' => $request->cancellation_reason
        ]);

        if (!$is_updated) {
            return back()->with('error', 'Error while cancelling order');
        }

        $publisher = Auth::guard('publisher')->user();

        Mail::to($publisher->email)->send(new PublisherOrderBookCanceled($publisher, $order, $request->cancellation_reason, $order->book->name));

        Mail::to($order->order->client->email)->send(new ClientOrderBookCanceled($order->order->client, $order->order, $request->cancellation_reason, $order->book->name));

        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new AdminOrderBookCanceled($admin, $order->order, $request->cancellation_reason, $order->book->name));
        }

        return redirect()->route('publisher.orders.index')->with('success', 'Order has been cancelled successfully');
    }

    public function books()
    {
        $books = Book::where('publisher_id', Auth::guard('publisher')->id())->paginate(10);
        return view('publisher.books.index', compact('books'));
    }

    public function book(string $uuid)
    {
        $book = Book::where('uuid', $uuid)->firstOrFail();
        return view('publisher.books.show', compact('book'));
    }

    public function reviews()
    {
        $reviews = Review::with(['client', 'book'])
            ->whereHas('book', function ($query) {
                $query->where('publisher_id', Auth::guard('publisher')->id());
            })->paginate(10);

        return view('publisher.reviews.index', compact('reviews'));
    }

    public function review(string $uuid)
    {
        $review = Review::where('uuid', $uuid)->firstOrFail();
        $review->load('client');
        return view('publisher.reviews.show', compact('review'));
    }

    public function profile()
    {
        $orders = OrderBook::with(['order', 'book', 'order.client'])->whereHas('book', function ($query) {
            $query->where('publisher_id', Auth::guard('publisher')->id());
        })->limit(5)->orderBy('created_at', 'desc')->get();

        return view('publisher.profile.index', compact('orders'));
    }
}
