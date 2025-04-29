@extends('layouts.back-office')

@section('title', 'Books List')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/publisher/books/books.js'])
@endsection

@section('content')
    @include('layouts.publisher-sidebar')

    <main class="ml-64 p-6 bg-slate-50 min-h-screen">
        <!-- Books Table -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Books Table</h2>
                <p class="text-sm text-slate-500 mt-1">Manage your book collection</p>
            </div>
            <a href="{{ route('publisher.books.create') }}" 
               class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg shadow-sm transition-colors duration-300 flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Add Book</span>
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <!-- Search and Filters -->
            <div class="mb-6 flex flex-col md:flex-row gap-4 items-start md:items-center">
                <div class="w-full md:w-1/3">
                    <div class="relative">
                        <input type="text" 
                               id="search" 
                               placeholder="Search by name, description, category, or publisher"
                               class="w-full border border-slate-200 rounded-lg pl-10 pr-4 py-2 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all duration-300">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                    </div>
                </div>
                
                <div class="flex flex-col md:flex-row gap-4 w-full md:w-2/3">
                    <div class="flex items-center space-x-2">
                        <label for="sort" class="text-sm font-medium text-slate-700">Sort By:</label>
                        <select id="sort" 
                                class="border border-slate-200 rounded-lg px-3 py-2 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all duration-300">
                            <option value="name" selected>Name</option>
                            <option value="price">Price</option>
                            <option value="stock">Stock</option>
                            <option value="category_name">Category</option>
                            <option value="created_at">Creation Date</option>
                            <option value="updated_at">Last Update</option>
                        </select>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <label for="order" class="text-sm font-medium text-slate-700">Order:</label>
                        <select id="order" 
                                class="border border-slate-200 rounded-lg px-3 py-2 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all duration-300">
                            <option value="asc" selected>Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Books Table -->
            <div id="books-table" class="overflow-x-auto">
                @include('publisher.books.partial.books-list', ['books' => $books])
            </div>
        </div>
    </main>
@endsection
