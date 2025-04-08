<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:client');
    }

    public function index()
    {
        $orders = Order::where('client_id', Auth::guard('client')->id())
            ->orderByDesc('created_at')
            ->get();

        return view('client.profile.index', compact('orders'));
    }

    public function checkout()
    {
        $cart = Cart::where('client_id', Auth::guard('client')->id())->first();

        if (!$cart) {
            return redirect()->route('home')->with('error', 'Your cart is empty');
        }


        $cart->load('cartBooks.book');
        return view('client.payment.checkout', compact('cart'));
    }
}
