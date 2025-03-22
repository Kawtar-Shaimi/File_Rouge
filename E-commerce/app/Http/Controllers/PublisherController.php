<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublisherController extends Controller
{
    public function index()
    {
        $products_count = Product::where('publisher_id', Auth::id())->count();
        $orders = OrderProduct::with(['order', 'order.user'])->whereHas('product', function ($query) {
            $query->where('publisher_id', 1);
        })->get();
        $orders_count = $orders->count();


        return view('publisher.index', compact('products_count', 'orders', 'orders_count'));
    }

    public function products()
    {
        $products = Product::where('publisher_id', Auth::id())->get();
        return view('publisher.products.index', compact('products'));
    }
}
