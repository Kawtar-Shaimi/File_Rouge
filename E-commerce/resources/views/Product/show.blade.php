@extends('layouts.app')

@section('content')

<!-- Détails du produit -->
<div class="container mx-auto p-6 max-w-5xl">
    <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col md:flex-row">
        
        <!-- Image du produit -->
        <div class="w-full md:w-1/2">
            <img src="https://via.placeholder.com/400" alt="Produit" class="w-full rounded-lg shadow-md">
        </div>

        <!-- Informations du produit -->
        <div class="w-full md:w-1/2 md:pl-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Nom du Produit</h2>
            <p class="text-gray-600 text-lg mb-4">Une description détaillée du produit. Il est conçu avec des matériaux de qualité et offre une expérience incroyable.</p>

            <!-- Prix -->
            <div class="mb-4">
                <span class="text-gray-700 font-bold text-2xl">$29.99</span>
                <span class="text-green-600 font-semibold ml-4">✔ En stock</span>
            </div>

            <!-- Évaluation -->
            <div class="flex items-center mb-4">
                <span class="text-yellow-400 text-xl">★ ★ ★ ★ ☆</span>
                <span class="ml-2 text-gray-600">(120 avis)</span>
            </div>

            <!-- Sélection de la quantité -->
            <div class="mb-4">
                <label for="quantity" class="block text-gray-700 font-semibold">Quantité :</label>
                <select id="quantity" class="w-20 p-2 border rounded-md">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>

            <!-- Boutons d'achat -->
            <div class="flex flex-col gap-4">
                <button class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg hover:bg-blue-600 transition duration-300 shadow-md">
                    🛒 Ajouter au panier
                </button>
            </div>
        </div>
    </div>

</div>

@endsection