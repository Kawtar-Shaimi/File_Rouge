@extends('layouts.back-office')

@section('content')

@include('layouts.publisher-sidebar')

<!-- Formulaire d'ajout -->
<div class="container w-5/6 ms-auto p-6">
    <div class="max-w-lg mx-auto">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">🛍️ Ajouter un Produit</h2>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form action="{{ route('publisher.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Nom du produit -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom du produit</label>
                    <input type="text" id="name" name="name" class="w-full p-3 border rounded-lg mt-1" value="{{ old('name') }}" required>
                </div>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Prix -->
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Prix ($)</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" class="w-full p-3 border rounded-lg mt-1" value="{{ old('price') }}" required>
                </div>
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Catégorie -->
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
                    <select id="category_id" name="category_id" class="w-full p-3 border rounded-lg mt-1" required>
                        <option value="">Sélectionner une catégorie</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Stock -->
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" id="stock" name="stock" min="1" class="w-full p-3 border rounded-lg mt-1" value="{{ old('stock') }}" required>
                </div>
                @error('stock')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="4" class="w-full p-3 border rounded-lg mt-1" required>{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Image -->
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image du produit</label>
                    <input type="file" id="image" name="image" accept="image/*" class="w-full p-3 border rounded-lg mt-1" required>
                </div>

                <!-- Bouton Ajouter -->
                <button type="submit" class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg mt-6 hover:bg-blue-600 transition duration-300 shadow-md">
                    ➕ Ajouter le produit
                </button>

            </form>
        </div>
    </div>
</div>

@endsection
