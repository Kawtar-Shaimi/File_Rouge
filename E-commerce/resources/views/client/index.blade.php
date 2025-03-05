@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16">
    <h1 class="text-4xl font-bold text-white mb-8 text-center">Our Products</h1>
    
    <!-- Featured Products -->
    <div class="mb-12">
        <h2 class="text-2xl font-semibold text-white mb-4">Top Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($topProducts as $product)
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded">
                    <h3 class="text-lg font-bold text-white mt-4">{{ $product->name }}</h3>
                    <p class="text-gray-400 text-sm">{{ $product->description }}</p>
                    <p class="text-yellow-400 text-xl font-semibold mt-2">${{ $product->price }}</p>
                    <button class="mt-4 w-full bg-yellow-500 text-gray-900 py-2 rounded-lg font-semibold hover:bg-yellow-600">Add to Cart</button>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- All Products -->
    <div class="mt-8 bg-gray-900 p-6 rounded-lg">
        <h2 class="text-2xl font-semibold text-white mb-6">All Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded">
                    <h3 class="text-lg font-bold text-white mt-4">{{ $product->name }}</h3>
                    <p class="text-gray-400 text-sm">{{ $product->description }}</p>
                    <p class="text-yellow-400 text-xl font-semibold mt-2">${{ $product->price }}</p>
                    <div class="flex items-center mt-4">
                        <input type="number" min="1" value="1" class="w-16 px-2 py-1 text-gray-900 rounded">
                        <button class="ml-4 bg-yellow-500 text-gray-900 px-4 py-2 rounded-lg font-semibold hover:bg-yellow-600">Add to Cart</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
