<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Statistiques Publisher</title>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    @include('layouts.header')

    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold mb-6 text-center">Statistiques Publisher</h2>

        <!-- Statistiques -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <!-- Total Produits -->
            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center">
                <div class="p-4 bg-blue-500 text-white rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 3h18v18H3z"></path>
                        <path d="M16 3v18"></path>
                        <path d="M8 3v18"></path>
                        <path d="M3 10h18"></path>
                        <path d="M3 16h18"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Total Produits Publiés</h3>
                    <p class="text-2xl font-bold text-gray-700">25</p> <!-- Valeur dynamique -->
                </div>
            </div>

            <!-- Total Commandes -->
            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center">
                <div class="p-4 bg-green-500 text-white rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 9l7 7 7-7"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold">Total Commandes Reçues</h3>
                    <p class="text-2xl font-bold text-gray-700">12</p> <!-- Valeur dynamique -->
                </div>
            </div>
        </div>

        <!-- Tableau des Produits Publiés -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <h3 class="text-xl font-semibold mb-4">Produits Publiés</h3>
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Nom</th>
                        <th class="py-3 px-6 text-left">Description</th>
                        <th class="py-3 px-6 text-left">Prix</th>
                        <th class="py-3 px-6 text-left">Stock</th>
                        <th class="py-3 px-6 text-left">Catégorie</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">Produit 1</td>
                        <td class="py-3 px-6">Description du produit</td>
                        <td class="py-3 px-6">120 DH</td>
                        <td class="py-3 px-6">50</td>
                        <td class="py-3 px-6">Électronique</td>
                        <td class="py-3 px-6 text-center">
                            <button class="text-blue-500 hover:underline">Modifier</button> |
                            <button class="text-red-500 hover:underline">Supprimer</button>
                        </td>
                    </tr>
                    <!-- Autres produits ici -->
                </tbody>
            </table>
        </div>

        <!-- Tableau des Commandes -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Commandes Passées</h3>
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID Commande</th>
                        <th class="py-3 px-6 text-left">Client</th>
                        <th class="py-3 px-6 text-left">Total</th>
                        <th class="py-3 px-6 text-left">Statut</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">#10234</td>
                        <td class="py-3 px-6">Kawtar Shaimi</td>
                        <td class="py-3 px-6">450 DH</td>
                        <td class="py-3 px-6">
                            <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Complétée</span>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <button class="text-blue-500 hover:underline">Voir</button> |
                            <button class="text-red-500 hover:underline">Annuler</button>
                        </td>
                    </tr>
                    <!-- Autres commandes ici -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

</body>
</html>
