@extends('layouts.back-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/publisher/books/createInputValidation.js'
    ])
@endsection

@section('content')

@include('layouts.publisher-sidebar')

<!-- Create Book Form -->
<div class="container w-5/6 ms-auto p-6">
    <div class="max-w-lg mx-auto">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Create Book</h2>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form id="createBookForm" action="{{ route('publisher.books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Book Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Book Name</label>
                    <input type="text" id="name" name="name" class="w-full p-3 border rounded-lg mt-1" value="{{ old('name') }}" required>
                </div>
                <p id="nameErr" class="text-red-500 text-xs mt-1"></p>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Price -->
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" class="w-full p-3 border rounded-lg mt-1" value="{{ old('price') }}" required>
                </div>
                <p id="priceErr" class="text-red-500 text-xs mt-1"></p>
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Category -->
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select id="category_id" name="category_id" class="w-full p-3 border rounded-lg mt-1" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->uuid }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <p id="categoryErr" class="text-red-500 text-xs mt-1"></p>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Stock -->
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" id="stock" name="stock" min="1" class="w-full p-3 border rounded-lg mt-1" value="{{ old('stock') }}" required>
                </div>
                <p id="stockErr" class="text-red-500 text-xs mt-1"></p>
                @error('stock')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="4" class="w-full p-3 border rounded-lg mt-1" required>{{ old('description') }}</textarea>
                </div>
                <p id="descriptionErr" class="text-red-500 text-xs mt-1"></p>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Image -->
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" id="image" name="image" accept="image/*" class="w-full p-3 border rounded-lg mt-1" required>
                </div>
                <p id="imageErr" class="text-red-500 text-xs mt-1"></p>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Add Book -->
                <button id="add-book" type="submit" class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg mt-6 hover:bg-blue-600 transition duration-300 shadow-md">
                    Add Book
                </button>

            </form>
        </div>
    </div>
</div>
@endsection
