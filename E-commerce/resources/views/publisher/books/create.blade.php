@extends('layouts.back-office')

@section('title', 'Add Book')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/publisher/books/createInputValidation.js'])
@endsection

@section('content')
    @include('layouts.publisher-sidebar')

    <main class="ml-64 p-8 bg-slate-50 min-h-screen">
        <div class="max-w-2xl mx-auto">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-slate-800">Add New Book</h2>
                <p class="text-sm text-slate-500 mt-1">Fill in the details to add a new book to your collection</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                <form id="createBookForm" action="{{ route('publisher.books.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Book Name -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Book Name</label>
                        <input type="text" id="name" name="name" 
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all duration-300 text-slate-700"
                            value="{{ old('name') }}" required>
                        <p id="nameErr" class="text-red-500 text-xs mt-1"></p>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="mb-6">
                        <label for="price" class="block text-sm font-medium text-slate-700 mb-1">Price ($)</label>
                        <input type="number" id="price" name="price" step="0.01" min="0"
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all duration-300 text-slate-700"
                            value="{{ old('price') }}" required>
                        <p id="priceErr" class="text-red-500 text-xs mt-1"></p>
                        @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="mb-6">
                        <label for="category_id" class="block text-sm font-medium text-slate-700 mb-1">Category</label>
                        <select id="category_id" name="category_id" 
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all duration-300 text-slate-700"
                            required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->uuid }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <p id="categoryErr" class="text-red-500 text-xs mt-1"></p>
                        @error('category_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div class="mb-6">
                        <label for="stock" class="block text-sm font-medium text-slate-700 mb-1">Stock</label>
                        <input type="number" id="stock" name="stock" min="1"
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all duration-300 text-slate-700"
                            value="{{ old('stock') }}" required>
                        <p id="stockErr" class="text-red-500 text-xs mt-1"></p>
                        @error('stock')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                        <textarea id="description" name="description" rows="4" 
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all duration-300 text-slate-700"
                            required>{{ old('description') }}</textarea>
                        <p id="descriptionErr" class="text-red-500 text-xs mt-1"></p>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-8">
                        <label for="image" class="block text-sm font-medium text-slate-700 mb-1">Book Cover Image</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all duration-300 text-slate-700"
                            required>
                        <p id="imageErr" class="text-red-500 text-xs mt-1"></p>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button id="add-book" type="submit"
                        class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-sm hover:shadow-md">
                        Add Book
                    </button>
                </form>
            </div>
        </div>
    </main>
@endsection
