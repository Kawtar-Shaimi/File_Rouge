<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('client.index',compact('products'));
    }

    public function create()
    {
        return view('client.create');
    }
    public function store(Request $request){
        $request->validate([
            'name'=> 'required|string',
            'description'=> 'required|string',
            'price'=> 'required|numeric',
            'quantity'=> 'required|numeric',
        ]);

        Product::create([
            'name' => $request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
        ]);
        return redirect()->route('clients.index')->with('success','Product created successfully');
    }
    public function update(Request $request, Product $product){
        $request->validate([
            'name'=> 'required|string',
            'description'=> 'required|string',
            'price'=> 'required|numeric',
            'quantity'=> 'required|numeric',
        ]);
        $product->update([
            'name' => $request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
        ]);
        return redirect()->route('clients.index')->with('success','Product updated successfully');
    }
    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('clients.index')->with('success','Product deleted successfully');
    }
    public function edit(Product $product){
        return view('client.edit',compact('product'));
    }
    public function show(Product $product){
        return view('client.show',compact('product'));
    }
}
