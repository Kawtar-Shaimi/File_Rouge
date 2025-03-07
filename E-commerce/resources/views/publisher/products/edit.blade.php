@extends('layouts.app')

@section('content')

<!-- Formulaire de modification -->
<div class="container mx-auto p-6 max-w-lg">
    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">✏️ Modifier le Produit</h2>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <form action="#" method="POST" enctype="multipart/form-data">
            
            <!-- Nom du produit -->
            <div class="mb-4">
                <label for="product_name" class="block text-sm font-medium text-gray-700">Nom du produit</label>
                <input type="text" id="product_name" name="product_name" value="Nom existant" class="w-full p-3 border rounded-lg mt-1" required>
            </div>

            <!-- Prix -->
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Prix ($)</label>
                <input type="number" id="price" name="price" value="19.99" step="0.01" class="w-full p-3 border rounded-lg mt-1" required>
            </div>

            <!-- Catégorie -->
            <div class="mb-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                <select id="category" name="category" class="w-full p-3 border rounded-lg mt-1" required>
                    <option value="vetements" selected>Vêtements</option>
                    <option value="chaussures">Chaussures</option>
                    <option value="accessoires">Accessoires</option>
                    <option value="electronique">Électronique</option>
                </select>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" class="w-full p-3 border rounded-lg mt-1" required>Texte existant...</textarea>
            </div>

            <!-- Image -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Image actuelle</label>
                <img src="https://via.placeholder.com/150" alt="Produit actuel" class="w-32 h-32 rounded-lg mt-2">
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Changer l'image</label>
                <input type="file" id="image" name="image" accept="image/*" class="w-full p-3 border rounded-lg mt-1">
            </div>

            <!-- Bouton Modifier -->
            <button type="submit" class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg mt-6 hover:bg-green-600 transition duration-300 shadow-md">
                 Modifier le produit
            </button>

        </form>
    </div>
</div>

@endsection