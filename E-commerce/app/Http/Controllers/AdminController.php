<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Book;
use App\Models\User;
use App\Models\Visit;
use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $colors = ['green', 'brown', 'yellow', 'blue', 'orange', 'red', 'pink', 'purple', 'indigo', 'teal'];

        $users_count = User::count();
        $books_count = Book::count();
        $orders_count = Order::count();
        $categories_count = Category::count();
        $visits_count = Visit::count();
        $incomes = number_format(Order::selectRaw("SUM(total_amount * 0.3) as amount")
        ->where('status', 'completed')
        ->first()->amount, 2);

        $users_distribution_chart_data = User::selectRaw("role, COUNT(*) as count")
        ->groupBy('role')
        ->orderBy('count')
        ->get()
        ->map(fn ($item) =>  [
                $item->role , (int) $item->count
        ]);

        $visits_chart_data = Visit::selectRaw("DATE_FORMAT(last_visit, '%Y-%m-%d %H:00') as full_date, TIME_Format(last_visit, '%H:00') as time, COUNT(*) as count")
        ->groupBy('full_date', 'time')
        ->orderBy('full_date')
        ->get()
        ->map(fn ($item) =>  [
                $item->time , $item->count
            ]
        );

        $incomes_chart_data = Order::selectRaw("DATE_FORMAT(updated_at, '%Y-%m-%d %H:00') as full_date, TIME_Format(updated_at, '%H:00') as time, SUM(total_amount * 0.3) as amount")
        ->where('status', 'completed')
        ->groupBy('full_date', 'time')
        ->orderBy('full_date')
        ->get()
        ->map(fn ($item) =>  [
                $item->time , (float) number_format($item->amount, 2)
            ]
        );

        shuffle($colors);
        $best_saled_books_chart_data = Order::selectRaw('books.name, SUM(orders_books.total * 0.3) as income')
        ->join('orders_books', 'orders.id', '=', 'orders_books.order_id')
        ->join('books', 'orders_books.book_id', '=', 'books.id')
        ->where('orders.status', 'completed')
        ->groupBy('books.id', 'books.name')
        ->orderByDesc('income')
        ->limit(5)
        ->get()
        ->map(fn($item, $key) =>  [
                $item->name, (float) number_format($item->income, 2), $colors[$key]
        ]);

        shuffle($colors);
        $best_saled_books_of_the_month_chart_data = Order::selectRaw('books.name, SUM(orders_books.total * 0.3) as income')
        ->join('orders_books', 'orders.id', '=', 'orders_books.order_id')
        ->join('books', 'orders_books.book_id', '=', 'books.id')
        ->where('orders.status', 'completed')
        ->whereMonth('orders.updated_at', now()->month)
        ->groupBy('books.id', 'books.name')
        ->orderByDesc('income')
        ->limit(5)
        ->get()
        ->map(fn ($item, $key) =>  [
                $item->name, (float) number_format($item->income, 2), $colors[$key]
        ]);

        shuffle($colors);
        $best_saled_categories_chart_data = Order::selectRaw('categories.name, SUM(orders_books.total * 0.3) as income')
        ->join('orders_books', 'orders.id', '=', 'orders_books.order_id')
        ->join('books', 'orders_books.book_id', '=', 'books.id')
        ->join('categories', 'books.category_id', '=', 'categories.id')
        ->where('orders.status', 'completed')
        ->groupBy('categories.id', 'categories.name')
        ->orderByDesc('income')
        ->limit(5)
        ->get()
        ->map(fn($item, $key) =>  [
                $item->name, (float) number_format($item->income, 2), $colors[$key]
        ]);

        shuffle($colors);
        $best_saled_categories_of_the_month_chart_data = Order::selectRaw('categories.name, SUM(orders_books.total * 0.3) as income')
        ->join('orders_books', 'orders.id', '=', 'orders_books.order_id')
        ->join('books', 'orders_books.book_id', '=', 'books.id')
        ->join('categories', 'books.category_id', '=', 'categories.id')
        ->where('orders.status', 'completed')
        ->whereMonth('orders.updated_at', now()->month)
        ->groupBy('categories.id', 'categories.name')
        ->orderByDesc('income')
        ->limit(5)
        ->get()
        ->map(fn ($item, $key) =>  [
                $item->name, (float) number_format($item->income, 2), $colors[$key]
        ]);

        shuffle($colors);
        $best_saled_publishers_chart_data = Order::selectRaw('users.name, SUM(orders_books.total * 0.3) as income')
        ->join('orders_books', 'orders.id', '=', 'orders_books.order_id')
        ->join('books', 'orders_books.book_id', '=', 'books.id')
        ->join('users', 'books.publisher_id', '=', 'users.id')
        ->where('orders.status', 'completed')
        ->groupBy('users.id', 'users.name')
        ->orderByDesc('income')
        ->limit(5)
        ->get()
        ->map(fn($item, $key) =>  [
                $item->name, (float) number_format($item->income, 2), $colors[$key]
        ]);

        shuffle($colors);
        $best_saled_publishers_of_the_month_chart_data = Order::selectRaw('users.name, SUM(orders_books.total * 0.3) as income')
        ->join('orders_books', 'orders.id', '=', 'orders_books.order_id')
        ->join('books', 'orders_books.book_id', '=', 'books.id')
        ->join('users', 'books.publisher_id', '=', 'users.id')
        ->where('orders.status', 'completed')
        ->whereMonth('orders.updated_at', now()->month)
        ->groupBy('users.id', 'users.name')
        ->orderByDesc('income')
        ->limit(5)
        ->get()
        ->map(fn ($item, $key) =>  [
                $item->name, (float) number_format($item->income, 2), $colors[$key]
        ]);

        shuffle($colors);
        $best_rated_books_chart_data = Book::selectRaw('books.name, AVG(reviews.rate) as rating')
        ->join('reviews', 'reviews.book_id', '=', 'books.id')
        ->groupBy('books.id', 'books.name')
        ->orderByDesc('rating')
        ->limit(5)
        ->get()
        ->map(fn($item, $key) =>  [
                $item->name, (float) number_format($item->rating, 1), $colors[$key]
        ]);

        shuffle($colors);
        $best_rated_books_of_the_month_chart_data = Book::selectRaw('books.name, AVG(reviews.rate) as rating')
        ->join('reviews', 'reviews.book_id', '=', 'books.id')
        ->whereMonth('reviews.updated_at', now()->month)
        ->groupBy('books.id', 'books.name')
        ->orderByDesc('rating')
        ->limit(5)
        ->get()
        ->map(fn($item, $key) =>  [
                $item->name, (float) number_format($item->rating, 1), $colors[$key]
        ]);

        return view('admin.index',
            compact('users_count', 'books_count', 'orders_count', 'categories_count', 'visits_count', 'incomes',
                'users_distribution_chart_data', 'visits_chart_data', 'incomes_chart_data', 'best_saled_books_chart_data',
                'best_saled_books_of_the_month_chart_data','best_saled_categories_chart_data',
                'best_saled_categories_of_the_month_chart_data', 'best_saled_publishers_chart_data',
                'best_saled_publishers_of_the_month_chart_data', 'best_rated_books_chart_data',
                'best_rated_books_of_the_month_chart_data'
            ));
    }

    public function books()
    {
        try {
            $books = Book::paginate(10);
            return view('admin.books.index', compact('books'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting books try again later.');
        }

    }

    public function book(Book $book)
    {
        try {
            $book->load('category', 'publisher');
            return view('admin.books.show', compact('book'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting book try again later.');
        }
    }

    public function destroyBook(Book $book)
    {
        try {
            $isDeleted = $book->delete();

            if (!$isDeleted) {
                return back()->with('error', 'Book not deleted.');
            }

            return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting deleting book try again later.');
        }
    }

    public function orders()
    {

        try {
            $orders = Order::with('client')->paginate(10);
            return view('admin.orders.index', compact('orders'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting orders try again later.');
        }
    }

    public function order(Order $order)
    {
        try {
            $order->load('client', 'orderBooks.book', 'payment');
            return view('admin.orders.show', compact('order'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting order try again later.');
        }
    }

    public function destroyOrder(Order $order)
    {
        try {
            $isDeleted = $order->delete();

            if (!$isDeleted) {
                return back()->with('error', 'Order not deleted.');
            }

            return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while deleting order try again later.');
        }
    }

    public function changeOrderStatusView(Order $order)
    {
        return view('admin.orders.change-status', compact('order'));
    }

    public function changeOrderStatus(Order $order, Request $request)
    {
        try {
            $revertedStatusArr = [
                'pending' => ["in shipping","completed","cancelled"],
                'in shipping' => ["completed","cancelled"],
                'completed' => ["cancelled"],
                'cancelled' => ["completed"],
            ];

            $request->validate([
                'status' => 'required|string|in:pending,in shipping,completed,cancelled'
            ]);

            if (in_array($order->status, $revertedStatusArr[$request->status])) {
                return back()->with('error', "You cannot revert an order status");
            }

            $isUpdated = $order->update([
                'status' => $request->status
            ]);

            if (!$isUpdated) {
                return back()->with('error', 'Order status not updated.');
            }

            if ($request->status === "completed") {
                $order->payment()->update([
                    "status" => "paid"
                ]);
            }

            if ($request->status === "cancelled") {
                $order->payment()->update([
                    "status" => "failed"
                ]);
                foreach ($order->orderBooks as $orderBook) {
                    $orderBook->book()->increment('quantity', $orderBook->quantity);
                }
            }

            return redirect()->route('admin.orders.index', $order)->with('success', 'Order status updated successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while updating order status try again later.');
        }
    }
}
