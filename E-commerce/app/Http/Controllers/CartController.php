<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartBook;
use App\Models\Book;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:client');
    }

    public function index()
    {
        $cart = Cart::where('client_id', Auth::guard('client')->id())->first();

        if ($cart) {
            $cart->load('cartBooks.book');
        }

        return view('client.cart.index', compact('cart'));
    }

    public function addToCart(Request $request, string $uuid)
    {
        $book = Book::where('uuid', $uuid)->firstOrFail();

        $cart = Cart::where('client_id', Auth::guard('client')->id())->first();

        if (!$cart) {

            $cart = Cart::create([
                'uuid' => Str::uuid(),
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
        } else {
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
    }

    public function removeFromCart(Request $request, string $uuid)
    {
        $book = Book::where('uuid', $uuid)->firstOrFail();

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
        ], 200)->header('Content-Type', 'application/json');
    }

    public function deleteFromCart(string $uuid)
    {
        $book = Book::where('uuid', $uuid)->firstOrFail();

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
        ], 200)->header('Content-Type', 'application/json');
    }
}
