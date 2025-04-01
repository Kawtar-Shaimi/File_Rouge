<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use App\Models\WishlistProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        try {
            $wishlist = Wishlist::where('client_id', Auth::guard('client')->id())->first();

            if ($wishlist) {
                $wishlist->load('wishlistProducts.product');
            }

            return view('client.wishlist.index', compact('wishlist'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting wishlist try again later.');
        }
    }

    public function addToWishlist(Product $product)
    {
        try{
            $wishlist = Wishlist::where('client_id' , Auth::guard('client')->id())->first();

            if (!$wishlist) {

                $wishlist = Wishlist::create([
                    'client_id' => Auth::guard('client')->id(),
                ]);

            }

            $wishlistProduct = WishlistProduct::create([
                'wishlist_id' => $wishlist->id,
                'product_id' => $product->id,
            ]);

            if (!$wishlistProduct) {
                return response()->json([
                    'status' => 'faild',
                    'message' => 'Error while adding product try again later.',
                ], 500)->header('Content-Type', 'application/json');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Product added to wishlist successfully',
            ], 200)->header('Content-Type', 'application/json');

        }catch(Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => 'Error while adding product to wishlist',
            ], 500)->header('Content-Type', 'application/json');
        }
    }

    public function removeFromWishlist(Product $product)
    {
        try {
            $count = 0;
            $wishlist = Wishlist::where('client_id', Auth::guard('client')->id())->first();

            if (!$wishlist) {
                return response()->json([
                    'status' => 'faild',
                    'message' => 'wishlist not found try again later.',
                ], 404)->header('Content-Type', 'application/json');
            }

            $wishlist->wishlistProducts()->where('product_id', $product->id)->delete();
            $count = $wishlist->wishlistProducts()->count();

            if ($count === 0) {
                $wishlist->delete();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Product removed from wishlist successfully',
                'data' => [
                    'count' => $count
                ],
            ],200)->header('Content-Type', 'application/json');

        }catch(Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => 'Error while removing product from wishlist',
            ], 500)->header('Content-Type', 'application/json');
        }
    }

}
