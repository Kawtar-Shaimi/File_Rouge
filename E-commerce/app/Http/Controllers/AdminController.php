<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeOrderStatusRequest;
use App\Mail\AdminBookRemoved;
use App\Mail\AdminOrderCanceled;
use App\Mail\OrderCancelled;
use App\Mail\OrderStatusUpdated;
use App\Mail\PublisherBookRemoved;
use App\Mail\PublisherOrderCanceled;
use App\Models\Category;
use App\Models\Order;
use App\Models\Book;
use App\Models\User;
use App\Models\Visit;
use App\Notifications\AdminBookRemoved as NotificationsAdminBookRemoved;
use App\Notifications\AdminOrderCanceled as NotificationsAdminOrderCanceled;
use App\Notifications\OrderCancelled as NotificationsOrderCancelled;
use App\Notifications\OrderStatusUpdated as NotificationsOrderStatusUpdated;
use App\Notifications\PublisherBookRemoved as NotificationsPublisherBookRemoved;
use App\Notifications\PublisherOrderCanceled as NotificationsPublisherOrderCanceled;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

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
            ->map(fn($item) =>  [
                $item->role,
                (int) $item->count
            ]);

        $visits_chart_data = Visit::selectRaw("DATE_FORMAT(last_visit, '%Y-%m-%d %H:00') as full_date, TIME_Format(last_visit, '%H:00') as time, COUNT(*) as count")
            ->groupBy('full_date', 'time')
            ->orderBy('full_date')
            ->get()
            ->map(
                fn($item) =>  [
                    $item->time,
                    $item->count
                ]
            );

        $incomes_chart_data = Order::selectRaw("DATE_FORMAT(updated_at, '%Y-%m-%d %H:00') as full_date, TIME_Format(updated_at, '%H:00') as time, SUM(total_amount * 0.3) as amount")
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
                $item->name,
                (float) number_format($item->income, 2),
                $colors[$key]
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
            ->map(fn($item, $key) =>  [
                $item->name,
                (float) number_format($item->income, 2),
                $colors[$key]
            ]);

        shuffle($colors);
        $best_rated_books_chart_data = Book::selectRaw('books.name, AVG(reviews.rate) as rating')
            ->join('reviews', 'reviews.book_id', '=', 'books.id')
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
            'admin.index',
            compact(
                'users_count',
                'books_count',
                'orders_count',
                'categories_count',
                'visits_count',
                'incomes',
                'users_distribution_chart_data',
                'visits_chart_data',
                'incomes_chart_data',
                'best_saled_books_chart_data',
                'best_saled_books_of_the_month_chart_data',
                'best_saled_categories_chart_data',
                'best_saled_categories_of_the_month_chart_data',
                'best_saled_publishers_chart_data',
                'best_saled_publishers_of_the_month_chart_data',
                'best_rated_books_chart_data',
                'best_rated_books_of_the_month_chart_data'
            )
        );
    }

    public function books()
    {
        $books = Book::paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function createBook()
    {
        $categories = Category::all();
        $publishers = User::where('role', 'publisher')->get();
        return view('admin.books.create', compact('categories', 'publishers'));
    }

    public function storeBook(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'category_id' => 'required|exists:categories,id',
                'publisher_id' => 'required|exists:users,id',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $imagePath = $request->file('image')->store('books', 'public');

            $book = Book::create([
                'uuid' => Str::uuid(),
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'category_id' => $validated['category_id'],
                'publisher_id' => $validated['publisher_id'],
                'image' => $imagePath
            ]);

            return redirect()->route('admin.books.index')->with('success', 'Book created successfully!');
        } catch (\Exception $e) {
            \Log::error('Admin book creation error: ' . $e->getMessage());
            return back()->with('error', 'Book creation failed. Please try again.')->withInput();
        }
    }

    public function book(string $uuid)
    {
        $book = Book::where('uuid', $uuid)->firstOrFail();
        $book->load('category', 'publisher');
        return view('admin.books.show', compact('book'));
    }

    public function destroyBook(string $uuid)
    {
        try {
            $book = Book::where('uuid', $uuid)->firstOrFail();

            $book_name = $book->name;
            $publisher = $book->publisher;

            $isDeleted = $book->delete();

            if (!$isDeleted) {
                return back()->with('error', 'Book not deleted.');
            }

            // Comment out email notifications temporarily to avoid SMTP errors
            /*
            Mail::to($publisher->email)->send(new PublisherBookRemoved($publisher, $book_name));
            Notification::send($publisher, new NotificationsPublisherBookRemoved($book_name));

            $admins = User::where('role', 'admin')->get();
            $admin_name = Auth::guard('admin')->user()->name;

            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new AdminBookRemoved($admin, $book_name, $admin_name));
                Notification::send($admin, new NotificationsAdminBookRemoved($book_name, $publisher->name, $admin_name));
            }
            */

            return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Admin book deletion error: ' . $e->getMessage());
            return back()->with('error', 'Book deletion failed. Please try again.');
        }
    }

    public function orders()
    {
        $orders = Order::with('client')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function order(string $uuid)
    {
        $order = Order::where('uuid', $uuid)->firstOrFail();
        $order->load('client', 'orderBooks.book', 'payment');
        return view('admin.orders.show', compact('order'));
    }

    public function destroyOrder(string $uuid)
    {
        $order = Order::where('uuid', $uuid)->firstOrFail();

        $isDeleted = $order->delete();

        if (!$isDeleted) {
            return back()->with('error', 'Order not deleted.');
        }

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }

    public function changeOrderStatusView(string $uuid)
    {
        $order = Order::where('uuid', $uuid)->firstOrFail();

        return view('admin.orders.change-status', compact('order'));
    }

    public function changeOrderStatus(ChangeOrderStatusRequest $request, string $uuid)
    {
        try {
            $order = Order::where('uuid', $uuid)->firstOrFail();

            $revertedStatusArr = [
                'pending' => ["in shipping", "completed", "cancelled"],
                'in shipping' => ["completed", "cancelled"],
                'completed' => ["cancelled"],
                'cancelled' => ["completed"],
            ];

            if (in_array($order->status, $revertedStatusArr[$request->status])) {
                return back()->withErrors([
                    'status' => 'Status cannot be reverted.'
                ]);
            }

            if ($request->status === "cancelled") {

                if ($request->reason === "") {
                    return back()->withErrors([
                        'reason' => 'Reason is required.'
                    ]);
                }

                $order->update([
                    "cancellation_reason" => $request->reason
                ]);

                $order->payment()->update([
                    "status" => "failed"
                ]);

                foreach ($order->orderBooks as $orderBook) {
                    $orderBook->book()->increment('stock', $orderBook->quantity);
                    $orderBook->update([
                        'is_cancelled' => true,
                        'cancellation_reason' => $request->reason
                    ]);

                    // Comment out email notifications
                    /*
                    Mail::to($orderBook->book->publisher->email)->send(new PublisherOrderCanceled($orderBook->book->publisher, $orderBook, $request->reason, $orderBook->book->name));

                    Notification::send($orderBook->book->publisher, new NotificationsPublisherOrderCanceled($orderBook->order, $request->reason, $orderBook->book->name));
                    */
                }

                // Comment out email notifications
                /*
                Mail::to($order->client->email)->send(new OrderCancelled($order, $request->reason));

                Notification::send($order->client, new NotificationsOrderCancelled($order, $request->reason));

                $admins = User::where('role', 'admin')->get();

                foreach ($admins as $admin) {
                    Mail::to($admin->email)->send(new AdminOrderCanceled($admin, $order, $request->reason));

                    Notification::send($admin, new NotificationsAdminOrderCanceled($order, $request->reason));
                }
                */
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

            // Comment out email notifications
            /*
            Mail::to($order->client->email)->send(new OrderStatusUpdated($order));

            Notification::send($order->client, new NotificationsOrderStatusUpdated($order));
            */

            return redirect()->route('admin.orders.index', $order)->with('success', 'Order status updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Order status change error: ' . $e->getMessage());
            return back()->with('error', 'Failed to update order status. Please try again.');
        }
    }

    public function profile()
    {
        $orders = Order::with('client')->limit(5)->orderBy('created_at', 'desc')->get();

        return view('admin.profile.index', compact('orders'));
    }
}
