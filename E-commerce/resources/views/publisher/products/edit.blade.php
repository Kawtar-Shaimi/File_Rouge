@extends('layouts.back-office')

@section('content')

@include('layouts.publisher-sidebar')

<!-- Formulaire de modification -->
<div class="container w-5/6 ms-auto p-6">
    <div class="max-w-lg mx-auto">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">✏️ Modifier le Produit</h2>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <form action="{{ route('publisher.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nom du produit -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom du produit</label>
                    <input type="text" id="name" name="name" class="w-full p-3 border rounded-lg mt-1" value="{{ old('name', $product->name) }}" required>
                </div>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Prix -->
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Prix ($)</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" class="w-full p-3 border rounded-lg mt-1" value="{{ old('price', $product->price) }}" required>
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
                            <option @if ($category->id === $product->category_id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Stock -->
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" id="stock" name="stock" min="1" class="w-full p-3 border rounded-lg mt-1" value="{{ old('stock', $product->stock) }}" required>
                </div>
                @error('stock')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="4" class="w-full p-3 border rounded-lg mt-1" required>{{ old('description', $product->description) }}</textarea>
                </div>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <!-- Image Preview -->
                <div class="mb-4">
                    <label for="image_preview" class="block text-sm font-medium text-gray-700">Image du produit</label>
                    <img id="image_preview" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md">
                </div>

                <!-- Image -->
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Image du produit</label>
                    <input type="file" id="image" name="image" accept="image/*" class="w-full p-3 border rounded-lg mt-1">
                </div>

                <!-- Bouton Modifier -->
                <button type="submit" class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg mt-6 hover:bg-green-600 transition duration-300 shadow-md">
                    Modifier le produit
                </button>

            </form>
        </div>
    </div>
</div>

@endsection
