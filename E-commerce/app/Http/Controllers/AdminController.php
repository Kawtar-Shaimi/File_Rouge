<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $user_count = User::count();
        $product_count = Product::count();
        $order_count = Order::count();
        $category_count = Category::count();
        $payments = Payment::with( 'order.user')->get();

        return view('admin.index', compact('user_count', 'product_count', 'order_count', 'category_count', 'payments'));
    }

    public function products()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function product(Product $product)
    {
        $product->load('category', 'publisher');
        return view('admin.products.show', compact('product'));
    }

    public function destroyProduct(Product $product)
    {
        $isDeleted = $product->delete();

        if (!$isDeleted) {
            return back()->with('error', 'Product not deleted.');
        }

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }


    public function orders()
    {
        $orders = Order::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function order(Order $order)
    {
        $order->load('user', 'orderProducts.product', 'payment');
        /* dd($order); */
        return view('admin.orders.show', compact('order'));
    }

    public function destroyOrder(Order $order)
    {
        $isDeleted = $order->delete();

        if (!$isDeleted) {
            return back()->with('error', 'Order not deleted.');
        }

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted.');
    }

    public function changeOrderStatusView(Order $order)
    {
        return view('admin.orders.change-status', compact('order'));
    }

    public function changeOrderStatus(Order $order, Request $request)
    {
        $request->validate([
            'status' => 'required|string|in:pending,in shipping,completed,cancelled'
        ]);

        $isUpdated = $order->update([
            'status' => $request->status
        ]);

        if (!$isUpdated) {
            return back()->with('error', 'Order status not updated.');
        }

        return redirect()->route('admin.orders.index', $order)->with('success', 'Order status updated.');
    }
}
