<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function create(){
        $categories = Category::all();
        return view('publisher.products.create', compact('categories'));
    }

    public function store(Request $request){
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
            'publisher_id' => Auth::id(),
        ]);

        if(!$product){
            return back()->with('error', 'Product creation failed');
        }

        return redirect()->route('publisher.products.index')->with('success', 'Product created successfully');
    }

    public function edit(Product $product){
        $categories = Category::all();
        return view('publisher.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product){
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
    }

    public function destroy(Product $product){
        $isDeleted = $product->delete();

        if(!$isDeleted){
            return back()->with('error', 'Product deletion failed');
        }

        return redirect()->route('publisher.products.index')->with('success', 'Product deleted successfully');
    }
}
