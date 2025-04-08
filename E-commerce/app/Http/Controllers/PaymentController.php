<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\Book;
use App\Models\Cart;
use App\Models\CartBook;
use App\Models\Order;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->except('confirmCardPayment', 'paymentSuccess', 'paymentCancel', 'paymentFailed', 'paymentTryAgain', 'confirmPaypalPayment');
        $this->middleware('auth:client')->only('confirmCardPayment', 'paymentSuccess', 'paymentCancel', 'paymentFailed', 'paymentTryAgain', 'confirmPaypalPayment');
    }

    public function index()
    {
        try {
            $payments = Payment::with( 'order.client')->paginate(10);

            return view('admin.payments.index', compact('payments'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting payments try again later.');
        }
    }

    public function show(Payment $payment)
    {
        try {
            $payment->load('order', 'order.client');
            return view('admin.payments.show', compact('payment'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting payment try again later.');
        }
    }

    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        try {
            $request->validate([
                'status' => 'required|string|in:pending,paid,failed'
            ]);

            $isUpdated = $payment->update([
                'status' => $request->status
            ]);

            if (!$isUpdated) {
                return back()->with('error', 'Payment status not updated.');
            }

            return redirect()->route('admin.payments.index')->with('success', 'Payment status updated successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while updating payment status try again later.');
        }
    }

    public function destroy(Payment $payment)
    {

        try {
            $isDeleted = $payment->delete();

            if (!$isDeleted) {
                return back()->with('error', 'Payment not deleted.');
            }

            return redirect()->route('admin.payments.index')->with('success', 'Payment deleted successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while deleting payment try again later.');
        }
    }

    public function confirmCardPayment()
    {
        if (!session()->has('payment_intent') || !session()->has('order')) {
            return redirect()->route('client.checkout')->with('error', 'You didnt make any order');
        }
        return view('client.payment.stripe.confirm-card-payment');
    }

    public function confirmPayPalPayment()
    {
        if (!session()->has('client_id') || !session()->has('order')) {
            return redirect()->route('client.checkout')->with('error', 'You didnt make any order');
        }
        
        return view('client.payment.paypal.confirm-paypal-payment');
    }

    public function paymentSuccess()
    {
        if ((!session()->has('payment_intent') && !session()->has('client_id')) || !session()->has('order')) {
            return redirect()->route('client.checkout')->with('error', 'You didnt make any order');
        }

        $cart = Cart::where('client_id', Auth::guard('client')->id())->first();

        $order = Order::create(session()->get('order'));

        Payment::create([
            'order_id' => $order->id,
            'order_number' => $order->order_number,
            'method' => $order->payment_method,
            'amount' => $order->total_amount,
            'status' => 'paid'
        ]);

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

        session()->forget('payment_intent');
        session()->forget('client_id');
        session()->forget('order');

        return view('client.payment.online.success', compact('order'));
    }

    public function paymentFailed()
    {
        if ((!session()->has('payment_intent') && !session()->has('client_id')) || !session()->has('order')) {
            return redirect()->route('client.checkout')->with('error', 'You didnt make any order');
        }

        return view('client.payment.online.failed');
    }

    public function paymentCancel()
    {
        if ((!session()->has('payment_intent') && !session()->has('client_id')) || !session()->has('order')) {
            return redirect()->route('client.checkout')->with('error', 'You didnt make any order');
        }

        session()->forget('payment_intent');
        session()->forget('client_id');
        session()->forget('order');

        return redirect()->route('home')->with('error', 'Payment Cancelled');
    }

    public function paymentTryAgain()
    {
        if ((!session()->has('payment_intent') && !session()->has('client_id')) || !session()->has('order')) {
            return redirect()->route('client.checkout')->with('error', 'You didnt make any order');
        }

        session()->forget('payment_intent');
        session()->forget('client_id');
        session()->forget('order');

        return redirect()->route('client.checkout')->with('error', 'Payment Failed, Please try again.');
    }
}