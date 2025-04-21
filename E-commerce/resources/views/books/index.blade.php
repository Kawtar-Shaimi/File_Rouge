@extends('layouts.front-office')

@section('title', 'Books')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/client/cart/addToCart.js', 'resources/js/client/cart/addOneToCart.js', 'resources/js/client/cart/removeFromCart.js', 'resources/js/client/wishlist/addToWishlist.js', 'resources/js/client/wishlist/removeFromWishlist.js', 'resources/js/client/book/searchTerms.js', 'resources/js/client/book/bookFilter.js'])
@endsection

@section('content')
    <!-- Book Exploration Section -->
    <div class="bg-gray-50 min-h-screen pt-10 pb-16 px-4">
        <div class="container mx-auto max-w-7xl">
            <!-- Header -->
            <div class="relative mb-12">
                <h1 class="text-4xl md:text-5xl font-bold text-center text-gray-800 mb-2">
                    Book Collection
                </h1>
                <div class="mx-auto w-20 h-1 bg-teal-500 rounded-full"></div>
            </div>
            
            <!-- Search Card -->
            <div class="mb-12 bg-white rounded-lg shadow-md border border-gray-200 p-6 lg:p-8">
                <!-- Search Bar -->
                <div class="flex flex-col lg:flex-row items-start lg:items-end space-y-6 lg:space-y-0 lg:space-x-6">
                    <div class="w-full lg:w-1/3">
                        <label for="search" class="block text-lg font-medium mb-2 text-gray-700">Find Books</label>
                        <div class="relative">
                            <input type="text" id="search" class="block w-full py-3 px-4 bg-gray-50 border border-gray-300 focus:border-teal-500 text-gray-700 rounded-lg placeholder-gray-400 focus:ring-2 focus:ring-teal-500/30 transition-all duration-200"
                                placeholder="Search for titles, authors...">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <div class="w-full relative hidden" id="results">
                                <div class="absolute bg-white border border-gray-200 shadow-lg rounded-lg mt-1 w-full z-10">
                                    <ul id="search-results" class="max-h-60 overflow-y-auto rounded-lg divide-y divide-gray-100"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Filter Controls -->
                    <div class="flex flex-col sm:flex-row flex-wrap gap-4 sm:gap-6 w-full lg:w-2/3">
                        <div class="w-full sm:w-auto">
                            <label for="sort" class="block text-sm font-medium mb-2 text-gray-700">Sort By</label>
                            <div class="relative">
                                <select id="sort" class="appearance-none block w-full py-3 px-4 bg-gray-50 border border-gray-300 focus:border-teal-500 text-gray-700 rounded-lg focus:ring-2 focus:ring-teal-500/30 pr-10 transition-all duration-200">
                                    <option value="" selected>Choose...</option>
                                    <option value="name">Name</option>
                                    <option value="price">Price</option>
                                    <option value="category_name">Category</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div class="w-full sm:w-auto">
                            <label for="order" class="block text-sm font-medium mb-2 text-gray-700">Order</label>
                            <div class="relative">
                                <select id="order" class="appearance-none block w-full py-3 px-4 bg-gray-50 border border-gray-300 focus:border-teal-500 text-gray-700 rounded-lg focus:ring-2 focus:ring-teal-500/30 pr-10 transition-all duration-200">
                                    <option value="" selected>Choose...</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        @php
                            if (!isset($categories)) {
                                $categories = \App\Models\Category::all();
                            }
                        @endphp
                        
                        <div class="w-full sm:w-auto">
                            <label for="category" class="block text-sm font-medium mb-2 text-gray-700">Category</label>
                            <div class="relative">
                                <select id="category" class="appearance-none block w-full py-3 px-4 bg-gray-50 border border-gray-300 focus:border-teal-500 text-gray-700 rounded-lg focus:ring-2 focus:ring-teal-500/30 pr-10 transition-all duration-200">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->uuid }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (isset($search))
                <div class="mb-8 bg-teal-50 p-4 rounded-lg border-l-4 border-teal-500 shadow-sm">
                    <p class="text-lg font-medium text-gray-700 flex items-center">
                        <svg class="h-5 w-5 mr-2 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        Results for: "<span id="search-term" class="font-semibold text-teal-700 ml-1">{{ $search }}</span>"
                    </p>
                </div>
            @endif

            <!-- Books Grid -->
            <div id="bookGrid" class="transition-all duration-300">
                @include('books.partial.books-grid', ['books' => $books])
            </div>
        </div>
    </div>
@endsection