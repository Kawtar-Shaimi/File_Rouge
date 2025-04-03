<?php

namespace App\Http\Controllers;

use App\Models\OrderBook;
use App\Models\Book;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublisherController extends Controller
{
    public function index()
    {
        $books_count = Book::where('publisher_id', Auth::guard('publisher')->id())->count();
        $orders = OrderBook::with(['order', 'book', 'order.client'])->whereHas('book', function ($query) {
            $query->where('publisher_id', Auth::guard('publisher')->id());
        })->get();
        $orders_count = $orders->count();


        return view('publisher.index', compact('books_count', 'orders', 'orders_count'));
    }

    public function orders()
    {
        $orders = OrderBook::with(['order', 'book', 'order.client'])->whereHas('book', function ($query) {
            $query->where('publisher_id', Auth::guard('publisher')->id());
        })->get();

        return view('publisher.orders.index', compact('orders'));
    }

    public function order($order_number)
    {
        $order = OrderBook::with(['order', 'book', 'order.client'])->whereHas('book', function ($query) {
            $query->where('publisher_id', Auth::guard('publisher')->id());
        })->whereHas('order', function ($query) use ($order_number) {
            $query->where('order_number', $order_number);
        })->first();

        return view('publisher.orders.show', compact('order'));
    }

    public function books()
    {
        try {
            $books = Book::where('publisher_id', Auth::guard('publisher')->id())->get();
            return view('publisher.books.index', compact('books'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting books try again later.');
        }
    }
    public function book(Book $book)
    {
        try {
            return view('publisher.books.show', compact('book'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting book try again later.');
        }
    }

    public function reviews()
    {
        try {
            $reviews = Review::with('client')
            ->whereHas('book', function ($query) {
                $query->where('publisher_id', Auth::guard('publisher')->id());
            })->get();

            return view('publisher.reviews.index', compact('reviews'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting reviews try again later.');
        }
    }

    public function review(Review $review)
    {
        $review->load('client');
        return view('publisher.reviews.show', compact('review'));
    }
}
