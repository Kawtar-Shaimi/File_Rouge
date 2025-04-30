@extends('layouts.back-office')

@section('title', 'Add Category')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin/categories/createInputValidation.js'])
@endsection

@section('content')
    @include('layouts.admin-sidebar')

    <main class="ml-64 p-8 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <!-- Add Category Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-slate-800">Add Category</h2>
                <p class="text-sm text-slate-500 mt-1">Create a new book category</p>
            </div>

            <!-- Add Category Form -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                <form id="create-category-form" action="{{ route('admin.categories.store') }}" method="POST">
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
                            placeholder="Enter category name">
                        <p id="nameErr" class="text-red-500 text-sm mt-1"></p>
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
                            placeholder="Enter category description">{{ old('description') }}</textarea>
                        <p id="descriptionErr" class="text-red-500 text-sm mt-1"></p>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8">
                        <button id="create-category" 
                            type="submit"
                            class="w-full bg-teal-600 hover:bg-teal-700 text-white px-4 py-3 rounded-xl transition-colors duration-300 flex items-center justify-center space-x-2">
                            <i class="fas fa-plus"></i>
                            <span>Add Category</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
