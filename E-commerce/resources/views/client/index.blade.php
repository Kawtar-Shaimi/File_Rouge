@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-16">
    <div class="container mx-auto px-4">
        <!-- Page Title -->
        <div class="mb-8 text-center">
            <h1 class="text-5xl font-bold text-white mb-4">Available Products</h1>
            <p class="text-gray-300 text-xl">Browse and explore our collection of products</p>
        </div>

        <!-- Search Bar -->
        <div class="mb-8 flex justify-center">
            <div class="relative w-full max-w-2xl">
                <input type="text" placeholder="Search products..." class="w-full bg-gray-800 text-gray-300 border border-gray-700 rounded-lg py-2 px-4 pl-10 focus:outline-none focus:border-gray-600">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
            </div>
        </div>

        <!-- Products List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $product)
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl border border-gray-700/50 p-6 transition-transform transform hover:scale-105">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-white">{{ $product->name }}</h3>
                    <span class="bg-purple-500 text-white px-3 py-1 rounded-full text-sm">{{ $product->price }} $</span>
                </div>
                <div class="mb-4">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }} image" class="w-full h-48 object-cover rounded-lg">
                </div>
                <p class="text-gray-400 mb-4">{{ Str::limit($product->description, 100) }}</p>
                <div class="flex justify-between items-center text-sm text-gray-400">
                    <span>{{ $product->category }}</span>
                    <span>{{ $product->created_at->format('Y-m-d') }}</span>
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('client.show', $product) }}" class="bg-purple-500 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-purple-600 transition-colors">View Details</a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection