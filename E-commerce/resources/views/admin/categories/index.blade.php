@extends('layouts.back-office')

@section('title', 'Categories List')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin/categories/categories.js'])
@endsection

@section('content')
    @include('layouts.admin-sidebar')

    <main class="ml-64 p-6">
        <!-- Categories Table -->
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold mt-8 mb-4">Categories Table</h2>
            <button class="bg-blue-500 text-white px-3 py-2 rounded"><a href="{{ route('admin.categories.create') }}">Add
                    Category</a></button>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
            <div class="mb-4 flex items-center space-x-5">
                <input type="text" id="search" placeholder="Search by name, description, or admin name"
                    class="border border-gray-300 rounded-lg p-2 w-1/3">
                <div>
                    <label for="sort" class="ml-2 text-gray-600">Sort By:</label>
                    <select id="sort" class="border border-gray-300 rounded-lg p-2">
                        <option value="id" selected>ID</option>
                        <option value="name">Name</option>
                        <option value="description">Description</option>
                        <option value="admin_name">Admin Name</option>
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
            <div id="categories-table">
                @include('admin.categories.partial.categories-list', ['categories' => $categories])
            </div>
        </div>

    </main>
@endsection
