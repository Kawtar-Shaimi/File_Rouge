<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\Cart;
use App\Models\CartBook;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Book;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:client');
    }

    private function getCart()
    {
        $cart = Cart::where('client_id', Auth::guard('client')->id())->first();

        if (!$cart) {
            return redirect()->route('client.cart.index')->with('error', 'Your cart is empty.');
        }

        return $cart;
    }

    private function handleCreditCardPayment(Request $request, $total_price)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntent = PaymentIntent::create([
            'amount' => (int) ($total_price * 100),
            'currency' => 'usd',
            'automatic_payment_methods' => [
                'enabled' => true, // This enables automatic methods like card payments
                'allow_redirects' => 'never', // This prevents any redirects, including 3D Secure
            ],
        ]);

        session()->put('order', [
            'uuid' => Str::uuid(),
            'order_number' => uniqid('ORDER-'),
            'shipping_name' => $request->shipping_name,
            'shipping_email' => $request->shipping_email,
            'shipping_phone' => $request->shipping_phone,
            'shipping_address' => $request->shipping_address,
            'shipping_country' => $request->shipping_country,
            'shipping_city' => $request->shipping_city,
            'shipping_postal_code' => $request->shipping_postal_code,
            'payment_method' => 'credit_card',
            'total_amount' => $total_price,
            'client_id' => Auth::guard('client')->id(),
        ]);

        session()->put('payment_intent', $paymentIntent);

        return redirect()->route('client.payment.stripe.confirm-card');
    }

    private function handlePayPalPayment(Request $request, $total_price)
    {
        session()->put('order', [
            'uuid' => Str::uuid(),
            'order_number' => uniqid('ORDER-'),
            'shipping_name' => $request->shipping_name,
            'shipping_email' => $request->shipping_email,
            'shipping_phone' => $request->shipping_phone,
            'shipping_address' => $request->shipping_address,
            'shipping_country' => $request->shipping_country,
            'shipping_city' => $request->shipping_city,
            'shipping_postal_code' => $request->shipping_postal_code,
            'payment_method' => 'paypal',
            'total_amount' => $total_price,
            'client_id' => Auth::guard('client')->id(),
        ]);

        $client_id= env('PAYPAL_CLIENT_ID');

        session()->put('client_id', $client_id);

        return redirect()->route('client.payment.paypal.confirm-paypal');
    }

    private function createOrder(Request $request, $total_price)
    {
        $order = Order::create([
            'uuid' => Str::uuid(),
            'order_number' => uniqid('ORDER-'),
            'shipping_name' => $request->shipping_name,
            'shipping_email' => $request->shipping_email,
            'shipping_phone' => $request->shipping_phone,
            'shipping_address' => $request->shipping_address,
            'shipping_country' => $request->shipping_country,
            'shipping_city' => $request->shipping_city,
            'shipping_postal_code' => $request->shipping_postal_code,
            'payment_method' => 'cash_on_delivery',
            'total_amount' => $total_price,
            'client_id' => Auth::guard('client')->id(),
        ]);

        if (!$order) {
            return redirect()->back()->with('error', 'Error while ordering try again later.');
        }

        return $order;
    }

    public function makeOrder(Request $request)
    {
        $request->validate([
            'shipping_name' => 'required|string|max:60',
            'shipping_email' => 'required|email|max:150',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:255',
            'shipping_country' => 'required|string|max:100',
            'shipping_city' => 'required|string|max:100',
            'shipping_postal_code' => 'required|string|max:20',
            'payment_method' => 'required|in:credit_card,paypal,cash_on_delivery',
        ]);


        $cart = $this->getCart();

        if ($cart instanceof RedirectResponse) {
            return $cart;
        }

        if ($request->payment_method === 'credit_card') {
            return $this->handleCreditCardPayment($request, $cart->total_price);
        }

        if ($request->payment_method === 'paypal') {
            return $this->handlePayPalPayment($request, $cart->total_price);
        }

        $order = $this->createOrder($request, $cart->total_price);

        if ($order instanceof RedirectResponse) {
            return $order;
        }

        $payment = Payment::create([
            'uuid' => Str::uuid(),
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'method' => $request->payment_method,
            'amount' => $cart->total_price,
        ]);

        if (!$payment) {
            $order->delete();
            return redirect()->back()->with('error', 'Error while ordering try again later.');
        }

        foreach ($cart->cartBooks as $cartBook) {

            $orderBook = $order->orderBooks()->create([
                'order_id' => $order->id,
                'book_id' => $cartBook->book_id,
                'quantity' => $cartBook->quantity,
                'total' => $cartBook->quantity * $cartBook->book->price,
            ]);

            if (!$orderBook) {
                $order->delete();
                return redirect()->back()->with('error', 'Error while ordering try again later.');
            }

            $book = Book::where('id', $cartBook->book_id)->first();

            if (!$book) {
                $order->delete();
                return redirect()->back()->with('error', 'Error while ordering try again later.');
            }

            $book->update([
                'stock' => $book->stock - $cartBook->quantity
            ]);

            if ($book->stock === 0) {
                CartBook::where('book_id', $book->id)->delete();
            }
        }

        $cart->delete();

        Mail::to($order->shipping_email)->send(new OrderConfirmation($order));

        return redirect()->route('client.order.success')
            ->with('order_number', $order->order_number)
            ->with('success', 'Order passed successfully');
    }

    public function successOrder(Request $request)
    {
        try {
            if (!$request->session()->has('order_number')) {
                return redirect()->route('home')->with('error', 'You didnt make any order');
            }
            return view('client.payment.success', [
                'order_number' => $request->session()->get('order_number'),
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting order number try again later.');
        }
    }

    public function show(string $uuid)
    {
        $order = Order::where('uuid', $uuid)->firstOrFail();
        return view('client.order.show', compact('order'));
    }

    public function trackOrder()
    {
        return view('client.order.tackOrder');
    }

    public function getOrderStatus(Request $request)
    {
        try {
            $orderNumber = $request->order_number;

            if (!$orderNumber) {
                return response()->json([
                    'status' => 'faild',
                    'message' => "Enter an order number please",
                ], 500)->header('Content-Type', 'application/json');
            }

            $query = Order::where('order_number', $orderNumber);

            if (!$query->exists()) {
                return response()->json([
                    'status' => 'faild',
                    'message' => "Order Number Not Found",
                ], 404)->header('Content-Type', 'application/json');
            }

            return response()->json([
                'status' => 'success',
                'data' => [
                    'status' => $query->first()->status,
                ],
            ], 200)->header('Content-Type', 'application/json');
        } catch (Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => 'Error while getting order status try again later.',
            ], 500)->header('Content-Type', 'application/json');
        }
    }
}
