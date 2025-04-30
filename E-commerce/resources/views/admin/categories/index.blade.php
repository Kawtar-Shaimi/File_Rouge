@extends('layouts.back-office')

@section('title', 'Categories List')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin/categories/categories.js'])
@endsection

@section('content')
    @include('layouts.admin-sidebar')

    <main class="ml-64 p-8 bg-slate-50 min-h-screen" style="background-color: #f0f0f0;">
        <div class="max-w-7xl mx-auto">
            <!-- Categories List Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800">Categories Table</h2>
                    <p class="text-sm text-slate-500 mt-1">Manage your book categories</p>
                </div>
                <a href="{{ route('admin.categories.create') }}" 
                    class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-xl transition-colors duration-300 flex items-center space-x-2">
                    <i class="fas fa-plus"></i>
                    <span>Add Category</span>
                </a>
            </div>

            <!-- Categories Table Container -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <!-- Filters -->
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="flex-1">
                        <input type="text" 
                            id="search" 
                            placeholder="Search by name, description, or admin name"
                            class="w-full border border-slate-200 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300">
                    </div>
                    <div class="flex items-center space-x-4">
                        <div>
                            <label for="sort" class="text-sm text-slate-600">Sort By:</label>
                            <select id="sort" 
                                class="border border-slate-200 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300">
                                <option value="id" selected>ID</option>
                                <option value="name">Name</option>
                                <option value="description">Description</option>
                                <option value="admin_name">Admin Name</option>
                                <option value="created_at">Creation Date</option>
                                <option value="updated_at">Last Update</option>
                            </select>
                        </div>
                        <div>
                            <label for="order" class="text-sm text-slate-600">Order:</label>
                            <select id="order" 
                                class="border border-slate-200 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300">
                                <option value="asc" selected>Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Categories Table -->
                <div id="categories-table">
                    @include('admin.categories.partial.categories-list', ['categories' => $categories])
                </div>
            </div>
        </div>
    </main>
@endsection
