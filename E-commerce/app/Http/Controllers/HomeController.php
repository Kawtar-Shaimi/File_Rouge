<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)->withSum('orderProducts', 'quantity')
            ->orderBy('order_products_sum_quantity', 'desc')
            ->take(4)
            ->get();

        if (Auth::guard('client')->check()) {
            foreach ($products as $product) {
                $query = $product->join('carts_products', 'products.id', '=', 'carts_products.product_id')
                ->join('carts', 'carts_products.cart_id', '=', 'carts.id')
                ->where('carts.client_id', Auth::guard('client')->id())
                ->where('products.id', $product->id);

                $product->isInCart = $query->exists();

                $product->productQuantity = $product->isInCart
                ? $query->first()->quantity
                : 0;

                $product->isInWishlist = $product->join('wishlists_products', 'products.id', '=', 'wishlists_products.product_id')
                ->join('wishlists', 'wishlists_products.wishlist_id', '=', 'wishlists.id')
                ->where('wishlists.client_id', Auth::guard('client')->id())
                ->where('products.id', $product->id)->exists();
            }
        }

        return view('index', compact('products'));
    }
}
