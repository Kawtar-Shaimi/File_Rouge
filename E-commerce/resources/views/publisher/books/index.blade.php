@extends('layouts.back-office')

@section('title', 'Books List')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/publisher/books/books.js'])
@endsection

@section('content')
    @include('layouts.publisher-sidebar')

    <main class="ml-64 p-6">
        <!-- Books Table -->
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold mt-8 mb-4">Books Table</h2>
            <button class="bg-blue-500 text-white px-3 py-2 rounded"><a href="{{ route('publisher.books.create') }}">Add
                    Book</a></button>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
            <div class="mb-4 flex items-center space-x-5">
                <input type="text" id="search" placeholder="Search by name, description, category, or publisher"
                    class="border border-gray-300 rounded-lg p-2 w-1/3">
                <div>
                    <label for="sort" class="ml-2 text-gray-600">Sort By:</label>
                    <select id="sort" class="border border-gray-300 rounded-lg p-2">
                        <option value="name" selected>Name</option>
                        <option value="price">Price</option>
                        <option value="stock">Stock</option>
                        <option value="category_name">Category</option>
                        <option value="created_at">Creation Date</option>
                        <option value="updated_at">Last Update</option>
                    </select>
                </div>
                <div>
                    <label for="order" class="ml-2 text-gray-600">Order:</label>
                    <select id="order" class="border border-gray-300 rounded-lg p-2">
                        <option value="asc" selected>Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>
            </div>
            <div id="books-table">
                @include('publisher.books.partial.books-list', ['books' => $books])
            </div>
        </div>

    </main>
@endsection
