<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Wishlist;
use App\Models\WishlistBook;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WishlistController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:client');
    }

    public function index()
    {
        $wishlist = Wishlist::where('client_id', Auth::guard('client')->id())->first();

        if ($wishlist) {
            $wishlist->load('wishlistBooks.book');
        }

        return view('client.wishlist.index', compact('wishlist'));
    }

    public function addToWishlist(string $uuid)
    {
        $book = Book::where('uuid', $uuid)->firstOrFail();

        $wishlist = Wishlist::where('client_id', Auth::guard('client')->id())->first();

        if (!$wishlist) {

            $wishlist = Wishlist::create([
                'uuid' => Str::uuid(),
                'client_id' => Auth::guard('client')->id(),
            ]);
        }

        $wishlistBook = WishlistBook::create([
            'wishlist_id' => $wishlist->id,
            'book_id' => $book->id,
        ]);

        if (!$wishlistBook) {
            return response()->json([
                'status' => 'faild',
                'message' => 'Error while adding book try again later.',
            ], 500)->header('Content-Type', 'application/json');
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Book added to wishlist successfully',
        ], 200)->header('Content-Type', 'application/json');
    }

    public function removeFromWishlist(string $uuid)
    {
        $book = Book::where('uuid', $uuid)->firstOrFail();

        $count = 0;
        $wishlist = Wishlist::where('client_id', Auth::guard('client')->id())->first();

        if (!$wishlist) {
            return response()->json([
                'status' => 'faild',
                'message' => 'wishlist not found try again later.',
            ], 404)->header('Content-Type', 'application/json');
        }

        $wishlist->wishlistBooks()->where('book_id', $book->id)->delete();
        $count = $wishlist->wishlistBooks()->count();

        if ($count === 0) {
            $wishlist->delete();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Book removed from wishlist successfully',
            'data' => [
                'count' => $count
            ],
        ], 200)->header('Content-Type', 'application/json');
    }
}
