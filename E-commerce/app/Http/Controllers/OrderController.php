<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Mail\AdminOrderPlaced;
use App\Mail\OrderConfirmation;
use App\Mail\PublisherOrderPlaced;
use App\Models\Cart;
use App\Models\CartBook;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Book;
use App\Models\User;
use App\Notifications\AdminOrderPlaced as NotificationsAdminOrderPlaced;
use App\Notifications\OrderConfirmation as NotificationsOrderConfirmation;
use App\Notifications\PublisherOrderPlaced as NotificationsPublisherOrderPlaced;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
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

    private function handleCreditCardPayment(OrderRequest $request, $total_price)
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

        $client_id = env('PAYPAL_CLIENT_ID');

        session()->put('client_id', $client_id);

        return redirect()->route('client.payment.paypal.confirm-paypal');
    }

    private function createOrder(OrderRequest $request, $total_price)
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

    public function makeOrder(OrderRequest $request)
    {
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

            $book = Book::where('id', $cartBook->book_id)->first();

            if (!$book) {
                $order->delete();
                return redirect()->back()->with('error', 'Error while ordering try again later.');
            }

            if ($book->stock >= $cartBook->quantity) {
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

                $book->decrement('stock', $cartBook->quantity);

                Mail::to($book->publisher->email)->send(new PublisherOrderPlaced($book->publisher, $orderBook));

                Notification::send($book->publisher, new NotificationsPublisherOrderPlaced($orderBook));
            }
        }

        $cart->delete();

        Mail::to($order->shipping_email)->send(new OrderConfirmation($order));

        Notification::send($order->client, new NotificationsOrderConfirmation($order));

        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new AdminOrderPlaced($admin, $order));

            Notification::send($admin, new NotificationsAdminOrderPlaced($order));
        }

        // Store order number in session
        session()->put('order_number', $order->order_number);
        session()->put('last_order_uuid', $order->uuid);

        return redirect()->route('client.order.success');
    }

    public function successOrder(Request $request)
    {
        if (!session()->has('order_number')) {
            return redirect()->route('home')->with('error', 'You didnt make any order');
        }

        $order_number = session('order_number');
        
        // Keep the order number for this request only, then remove it
        session()->forget('order_number');
        
        return view('client.payment.success', compact('order_number'));
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
    }
}
