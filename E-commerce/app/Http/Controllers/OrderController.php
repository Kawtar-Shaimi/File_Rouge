<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function makeOrder(Request $request)
    {
        try {
            $request->validate([
                'shipping_name' => 'required|string|max:60',
                'shipping_email' => 'required|email|max:150',
                'shipping_phone' => 'required|string|max:20',
                'shipping_address' => 'required|string|max:255',
                'shipping_country' => 'required|string|max:100',
                'shipping_city' => 'required|string|max:100',
                'shipping_postal_code' => 'required|string|max:20',
                'payment_method' => 'required|in:paypal,in shipping',
            ]);

            $cart = Cart::where('client_id', Auth::guard('client')->id())->first();

            if (!$cart) {
                return redirect()->route('client.cart.index')->with('error', 'Your cart is empty.');
            }

            $order = Order::create([
                'order_number' => uniqid('ORDER-'),
                'shipping_name' => $request->shipping_name,
                'shipping_email' => $request->shipping_email,
                'shipping_phone' => $request->shipping_phone,
                'shipping_address' => $request->shipping_address,
                'shipping_country' => $request->shipping_country,
                'shipping_city' => $request->shipping_city,
                'shipping_postal_code' => $request->shipping_postal_code,
                'payment_method' => $request->payment_method,
                'total_amount' => $cart->total_price,
                'client_id' => Auth::guard('client')->id(),
            ]);

            if (!$order) {
                return redirect()->back()->with('error', 'Error while ordering try again later.');
            }

            foreach ($cart->cartProducts as $cartProduct) {

                $orderProduct = $order->orderProducts()->create([
                    'order_id' => $order->id,
                    'product_id' => $cartProduct->product_id,
                    'quantity' => $cartProduct->quantity,
                    'total' => $cartProduct->quantity * $cartProduct->product->price,
                ]);

                if (!$orderProduct) {
                    $order->delete();
                    return redirect()->back()->with('error', 'Error while ordering try again later.');
                }

                $product = Product::where('id', $cartProduct->product_id)->first();

                if (!$product) {
                    $order->delete();
                    return redirect()->back()->with('error', 'Error while ordering try again later.');
                }

                $product->update([
                    'stock' => $product->stock - $cartProduct->quantity
                ]);

                if ($product->stock === 0) {
                    CartProduct::where('product_id', $product->id)->delete();
                }
            }

            $cart->delete();

            $payment = Payment::create([
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'method' => $request->payment_method,
                'amount' => $cart->total_price,
            ]);

            if (!$payment) {
                $order->delete();
                return redirect()->back()->with('error', 'Error while ordering try again later.');
            }

            return redirect()->route('client.order.success')
            ->with('order_number', $order->order_number)
            ->with('success', 'Order passed successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while ordering try again later.');
        }

    }

    public function successOrder(Request $request)
    {
        try {
            if (!$request->session()->has('order_number')) {
                return redirect()->back();
            }
            return view('client.payment.success', [
                'order_number' => $request->session()->get('order_number'),
            ]);
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting order number try again later.');
        }
    }

    public function show(Order $order){
        return view('client.order.show', compact('order'));
    }

    public function trackOrder(){
        return view('client.order.tackOrder');
    }

    public function getOrderStatus(Request $request){
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
        } catch(Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => 'Error while getting order status try again later.',
            ], 500)->header('Content-Type', 'application/json');
        }
    }
}
