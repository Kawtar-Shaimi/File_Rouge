@extends('layouts.back-office')

@section('title', 'Add Book')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')
    @include('layouts.admin-sidebar')

    <main class="ml-64 p-8 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <!-- Add Book Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-slate-800">Add Book</h2>
                <p class="text-sm text-slate-500 mt-1">Create a new book entry</p>
            </div>

            <!-- Add Book Form -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Name -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Name</label>
                        <input type="text" 
                            id="name" 
                            name="name" 
                            required 
                            value="{{ old('name') }}"
                            class="w-full border border-slate-200 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300"
                            placeholder="Enter book name">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-slate-700 mb-2">Description</label>
                        <textarea id="description" 
                            name="description" 
                            rows="4" 
                            required 
                            class="w-full border border-slate-200 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300"
                            placeholder="Enter book description">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="mb-6">
                        <label for="price" class="block text-sm font-medium text-slate-700 mb-2">Price</label>
                        <input type="number" 
                            id="price" 
                            name="price" 
                            required 
                            min="0" 
                            step="0.01"
                            value="{{ old('price') }}"
                            class="w-full border border-slate-200 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300"
                            placeholder="Enter book price">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div class="mb-6">
                        <label for="stock" class="block text-sm font-medium text-slate-700 mb-2">Stock</label>
                        <input type="number" 
                            id="stock" 
                            name="stock" 
                            required 
                            min="0"
                            value="{{ old('stock') }}"
                            class="w-full border border-slate-200 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300"
                            placeholder="Enter stock quantity">
                        @error('stock')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="mb-6">
                        <label for="category_id" class="block text-sm font-medium text-slate-700 mb-2">Category</label>
                        <select id="category_id" 
                            name="category_id" 
                            required
                            class="w-full border border-slate-200 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Publisher -->
                    <div class="mb-6">
                        <label for="publisher_id" class="block text-sm font-medium text-slate-700 mb-2">Publisher</label>
                        <select id="publisher_id" 
                            name="publisher_id" 
                            required
                            class="w-full border border-slate-200 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300">
                            <option value="">Select a publisher</option>
                            @foreach($publishers as $publisher)
                                <option value="{{ $publisher->id }}" {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>
                                    {{ $publisher->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('publisher_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-slate-700 mb-2">Book Image</label>
                        <input type="file" 
                            id="image" 
                            name="image" 
                            required 
                            accept="image/*"
                            class="w-full border border-slate-200 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300">
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8">
                        <button type="submit"
                            class="w-full bg-teal-600 hover:bg-teal-700 text-white px-4 py-3 rounded-xl transition-colors duration-300 flex items-center justify-center space-x-2">
                            <i class="fas fa-plus"></i>
                            <span>Add Book</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection 