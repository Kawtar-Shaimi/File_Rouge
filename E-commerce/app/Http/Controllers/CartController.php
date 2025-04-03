<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartBook;
use App\Models\Book;
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
                $cart->load('cartBooks.book');
            }

            return view('client.cart.index', compact('cart'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting cart try again later.');
        }
    }

    public function addToCart(Request $request, Book $book)
    {
        try{
            $cart = Cart::where('client_id' , Auth::guard('client')->id())->first();

            if (!$cart) {

                $cart = Cart::create([
                    'client_id' => Auth::guard('client')->id(),
                    'total_price' => 0,
                ]);

                $cartBook = CartBook::create([
                    'cart_id' => $cart->id,
                    'book_id' => $book->id,
                    'quantity' => $request->quantity ?? 1,
                ]);

                $cart->update([
                    'total_price' => $book->price * ($request->quantity ?? 1),
                ]);

            }else{
                $cartBook = $cart->cartBooks()->where('book_id', $book->id)->first();
                if ($cartBook) {
                    $cartBook->update([
                        'quantity' => $cartBook->quantity + $request->quantity,
                    ]);
                } else {
                    $cartBook = CartBook::create([
                        'cart_id' => $cart->id,
                        'book_id' => $book->id,
                        'quantity' => $request->quantity ?? 1,
                    ]);
                }

                $cart->update([
                    'total_price' => $cart->total_price + $book->price * ($request->quantity ?? 1),
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Book added to cart successfully',
                'data' => [
                    'total_price' => $cart->total_price,
                    'total_book_price' => $cartBook->quantity * $book->price,
                ],
            ], 200)->header('Content-Type', 'application/json');
        }catch(Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => 'Error while adding book to cart',
            ], 500)->header('Content-Type', 'application/json');
        }
    }

    public function removeFromCart(Request $request, Book $book)
    {
        try {
            $cart = Cart::where('client_id', Auth::guard('client')->id())->first();

            if (!$cart) {
                return response()->json([
                    'status' => 'faild',
                    'message' => 'Cart not found try again later.',
                ], 404)->header('Content-Type', 'application/json');
            }

            $cartBook = $cart->cartBooks()->where('book_id', $book->id)->first();

            $cartBook->update([
                'quantity' => $cartBook->quantity - $request->quantity,
            ]);

            $cart->update([
                'total_price' => $cart->total_price - $book->price * $request->quantity,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Book removed from cart successfully',
                'data' => [
                    'total_price' => $cart->total_price,
                    'total_book_price' => $cartBook->quantity * $book->price,
                ],
            ],200)->header('Content-Type', 'application/json');
        }catch(Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => 'Error while removing book from cart',
            ], 500)->header('Content-Type', 'application/json');
        }
    }

    public function deleteFromCart(Book $book)
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

            $cartBook = $cart->cartBooks()->where('book_id', $book->id)->first();
            $cart->update([
                'total_price' => $cart->total_price - $book->price * $cartBook->quantity,
            ]);
            $cartBook->delete();
            $count = $cart->cartBooks()->count();
            if ($count === 0) {
                $cart->delete();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Book deleted from cart successfully',
                'data' => [
                    'total_price' => $cart->total_price,
                    'count' => $count
                ],
            ],200)->header('Content-Type', 'application/json');
        }catch(Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => 'Error while deleting book from cart',
            ], 500)->header('Content-Type', 'application/json');
        }
    }
}
