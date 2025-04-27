@extends('layouts.front-office')

@section('title', 'Books')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/client/cart/addToCart.js', 'resources/js/client/cart/addOneToCart.js', 'resources/js/client/cart/removeFromCart.js', 'resources/js/client/wishlist/addToWishlist.js', 'resources/js/client/wishlist/removeFromWishlist.js', 'resources/js/client/book/searchTerms.js', 'resources/js/client/book/bookFilter.js'])
@endsection

@section('content')
    <!-- Search -->
    <div class="bg-gradient-to-b from-green-50 to-white">
        <div class="container mx-auto px-4 py-10">
            <h1 class="text-4xl font-bold text-center mb-8 text-teal-500">All Books</h1>
            <div class="mb-10 flex flex-wrap gap-4 items-center justify-center md:justify-start">
                <div class="w-full md:w-1/3">
                    <div class="relative">
                        <input type="text" id="search" 
                               class="w-full p-3 bg-white rounded-lg border border-green-100 shadow-sm focus:ring-2 focus:ring-teal-400 focus:border-transparent transition-all"
                               placeholder="Search for a book...">
                        <span class="absolute right-3 top-3 text-gray-400">
                            <i class="fas fa-search"></i>
                        </span>
                        <div class="w-full relative hidden" id="results">
                            <div class="absolute bg-white shadow-lg shadow-gray-200 mt-2 w-full z-10 rounded-lg border border-green-50">
                                <ul id="search-results" class="max-h-60 overflow-y-auto rounded-lg divide-y divide-gray-100">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filter-group">
                    <label for="sort" class="text-gray-600 font-medium">Sort By:</label>
                    <select id="sort" class="ml-2 bg-white border border-green-100 rounded-lg p-2 focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                        <option value="" selected>Sort By</option>
                        <option value="name">Name</option>
                        <option value="price">Price</option>
                        <option value="category_name">Category</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="order" class="text-gray-600 font-medium">Order:</label>
                    <select id="order" class="ml-2 bg-white border border-green-100 rounded-lg p-2 focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                        <option value="" selected>Order By</option>
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>

                @php
                    if (!isset($categories)) {
                        $categories = \App\Models\Category::all();
                    }
                @endphp
                <div class="filter-group">
                    <label for="category" class="text-gray-600 font-medium">Category:</label>
                    <select id="category" class="ml-2 bg-white border border-green-100 rounded-lg p-2 focus:ring-2 focus:ring-teal-400 focus:border-transparent">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->uuid }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if (isset($search))
                <div class="mb-4">
                    <p class="text-lg font-semibold text-teal-500">Search results for: "<span
                            id="search-term">{{ $search }}</span>"</p>
                </div>
            @endif

            <!-- Books Grid -->
            <div id="bookGrid">
                @include('books.partial.books-grid', ['books' => $books])
            </div>
        </div>
    </div>
@endsection
