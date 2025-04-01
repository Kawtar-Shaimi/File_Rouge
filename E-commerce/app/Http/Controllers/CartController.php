<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        try {
            $cart = Cart::where('client_id', Auth::guard('client')->id())->first();

            if ($cart) {
                $cart->load('cartProducts.product');
            }

            return view('client.cart.index', compact('cart'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting cart try again later.');
        }
    }

    public function addToCart(Request $request, Product $product)
    {
        try{
            $cart = Cart::where('client_id' , Auth::guard('client')->id())->first();

            if (!$cart) {

                $cart = Cart::create([
                    'client_id' => Auth::guard('client')->id(),
                    'total_price' => 0,
                ]);

                $cartProduct = CartProduct::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $request->quantity ?? 1,
                ]);

                $cart->update([
                    'total_price' => $product->price * ($request->quantity ?? 1),
                ]);

            }else{
                $cartProduct = $cart->cartProducts()->where('product_id', $product->id)->first();
                if ($cartProduct) {
                    $cartProduct->update([
                        'quantity' => $cartProduct->quantity + $request->quantity,
                    ]);
                } else {
                    $cartProduct = CartProduct::create([
                        'cart_id' => $cart->id,
                        'product_id' => $product->id,
                        'quantity' => $request->quantity ?? 1,
                    ]);
                }

                $cart->update([
                    'total_price' => $cart->total_price + $product->price * ($request->quantity ?? 1),
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart successfully',
                'data' => [
                    'total_price' => $cart->total_price,
                    'total_product_price' => $cartProduct->quantity * $product->price,
                ],
            ], 200)->header('Content-Type', 'application/json');
        }catch(Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => 'Error while adding product to cart',
            ], 500)->header('Content-Type', 'application/json');
        }
    }

    public function removeFromCart(Request $request, Product $product)
    {
        try {
            $cart = Cart::where('client_id', Auth::guard('client')->id())->first();

            if (!$cart) {
                return response()->json([
                    'status' => 'faild',
                    'message' => 'Cart not found try again later.',
                ], 404)->header('Content-Type', 'application/json');
            }

            $cartProduct = $cart->cartProducts()->where('product_id', $product->id)->first();

            $cartProduct->update([
                'quantity' => $cartProduct->quantity - $request->quantity,
            ]);

            $cart->update([
                'total_price' => $cart->total_price - $product->price * $request->quantity,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Product removed from cart successfully',
                'data' => [
                    'total_price' => $cart->total_price,
                    'total_product_price' => $cartProduct->quantity * $product->price,
                ],
            ],200)->header('Content-Type', 'application/json');
        }catch(Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => 'Error while removing product from cart',
            ], 500)->header('Content-Type', 'application/json');
        }
    }

    public function deleteFromCart(Product $product)
    {
        try {
            $count = 0;
            $cart = Cart::where('client_id', Auth::guard('client')->id())->first();

            if (!$cart) {
                return response()->json([
                    'status' => 'faild',
                    'message' => 'Cart not found try again later.',
                ], 404)->header('Content-Type', 'application/json');
            }

            $cartProduct = $cart->cartProducts()->where('product_id', $product->id)->first();
            $cart->update([
                'total_price' => $cart->total_price - $product->price * $cartProduct->quantity,
            ]);
            $cartProduct->delete();
            $count = $cart->cartProducts()->count();
            if ($count === 0) {
                $cart->delete();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted from cart successfully',
                'data' => [
                    'total_price' => $cart->total_price,
                    'count' => $count
                ],
            ],200)->header('Content-Type', 'application/json');
        }catch(Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => 'Error while deleting product from cart',
            ], 500)->header('Content-Type', 'application/json');
        }
    }
}
