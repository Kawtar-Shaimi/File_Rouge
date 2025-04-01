<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublisherController extends Controller
{
    public function index()
    {
        $products_count = Product::where('publisher_id', Auth::guard('publisher')->id())->count();
        $orders = OrderProduct::with(['order', 'product', 'order.client'])->whereHas('product', function ($query) {
            $query->where('publisher_id', Auth::guard('publisher')->id());
        })->get();
        $orders_count = $orders->count();


        return view('publisher.index', compact('products_count', 'orders', 'orders_count'));
    }

    public function orders()
    {
        $orders = OrderProduct::with(['order', 'product', 'order.client'])->whereHas('product', function ($query) {
            $query->where('publisher_id', Auth::guard('publisher')->id());
        })->get();

        return view('publisher.orders.index', compact('orders'));
    }

    public function order($order_number)
    {
        $order = OrderProduct::with(['order', 'product', 'order.client'])->whereHas('product', function ($query) {
            $query->where('publisher_id', Auth::guard('publisher')->id());
        })->whereHas('order', function ($query) use ($order_number) {
            $query->where('order_number', $order_number);
        })->first();

        return view('publisher.orders.show', compact('order'));
    }

    public function products()
    {
        try {
            $products = Product::where('publisher_id', Auth::guard('publisher')->id())->get();
            return view('publisher.products.index', compact('products'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting products try again later.');
        }
    }
    public function product(Product $product)
    {
        try {
            return view('publisher.products.show', compact('product'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting product try again later.');
        }
    }

    public function reviews()
    {
        try {
            $reviews = Review::with('client')
            ->whereHas('product', function ($query) {
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

    public function deleteReview(Review $review)
    {
        try {
            $isDeleted = $review->delete();

            if (!$isDeleted) {
                return back()->with('error', 'Review not deleted.');
            }

            return redirect()->route('publisher.reviews.index')->with('success', 'Review deleted successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while deleting review try again later.');
        }
    }
}
