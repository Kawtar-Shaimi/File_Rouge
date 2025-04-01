<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(){
        $products = Product::where('stock', '>', 0)->where('stock', '>', 0)->paginate(10);

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

        return view('products.index', compact('products'));
    }

    public function show(Product $product){
        try {
            $product->load(['reviews', 'reviews.client']);
            $product->loadCount('reviews');
            $product->loadAvg('reviews', 'rate');
            if (Auth::guard('client')->check()) {
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

                $product->isReviewed = $product->reviews()
                ->where('reviews.client_id', Auth::guard('client')->id())
                ->where('reviews.product_id', $product->id)->exists();
            }
            return view('products.show', compact('product'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting product try again later.');
        }
    }

    public function create(){
        $categories = Category::all();
        return view('publisher.products.create', compact('categories'));
    }

    public function store(Request $request){
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'stock' => 'required|numeric',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $image = $request->file('image');
            $image_name = uniqid("product_") ."_". time() .".". $image->extension();
            $image_path = $image->storeAs('products_images', $image_name, 'public');

            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'stock' => $request->stock,
                'description' => $request->description,
                'image' => $image_path,
                'publisher_id' => Auth::guard('publisher')->id(),
            ]);

            if(!$product){
                return back()->with('error', 'Product creation failed');
            }

            return redirect()->route('publisher.products.index')->with('success', 'Product created successfully');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while creating product try again later.');
        }
    }

    public function edit(Product $product){
        $categories = Category::all();
        return view('publisher.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product){
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'stock' => 'required|numeric',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $isUpdated = $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'stock' => $request->stock,
                'description' => $request->description,
            ]);

            if(!$isUpdated){
                return back()->with('error', 'Product update failed');
            }

            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = uniqid("product_") ."_". time() .".". $image->extension();
                $image_path = $image->storeAs('products_images', $image_name, 'public');
                $isImageUpdated = $product->update(['image' => $image_path]);
                if(!$isImageUpdated){
                    return back()->with('error', 'Product image update failed');
                }
            }

            return redirect()->route('publisher.products.index')->with('success', 'Product updated successfully');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while updating product try again later.');
        }
    }

    public function destroy(Product $product){
        try {
            $isDeleted = $product->delete();

            if(!$isDeleted){
                return back()->with('error', 'Product deletion failed');
            }

            return redirect()->route('publisher.products.index')->with('success', 'Product deleted successfully');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while deleting product try again later.');
        }
    }
}
