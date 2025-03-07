@extends('layouts.app')

@section('content')

@include('layouts.admin-sidebar')

<!-- Contenu principal -->
<main class="ml-64 p-6">

    <!-- Tableau des Produits -->
    <h2 class="text-2xl font-bold mt-8 mb-4">Liste des Produits</h2>
    <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 border">ID</th>
                    <th class="p-3 border">Nom</th>
                    <th class="p-3 border">Description</th>
                    <th class="p-3 border">Prix</th>
                    <th class="p-3 border">Stock</th>
                    <th class="p-3 border">Image</th>
                    <th class="p-3 border">Catégorie</th>
                    <th class="p-3 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center">
                    <td class="p-3 border">1</td>
                    <td class="p-3 border">Smartphone X</td>
                    <td class="p-3 border truncate w-40">Un smartphone performant avec écran AMOLED...</td>
                    <td class="p-3 border text-green-600 font-bold">$499.99</td>
                    <td class="p-3 border text-blue-500 font-semibold">120 en stock</td>
                    <td class="p-3 border">
                        <img src="https://via.placeholder.com/50" alt="Produit" class="w-12 h-12 rounded">
                    </td>
                    <td class="p-3 border">Électronique</td>
                    <td class="p-3 border">
                        <button class="bg-blue-500 text-white px-3 py-1 rounded">Modifier</button>
                        <button class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</main>

@endsection