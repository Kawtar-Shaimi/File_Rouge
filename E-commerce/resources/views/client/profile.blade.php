@extends('layouts.app')

@section('content')

<div class="container mx-auto p-8">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-xl space-y-6">
        <!-- Informations Utilisateur -->
        <div class="flex items-center justify-between space-x-8 border-b pb-6">
            <div class="flex items-center space-x-4">
                <img class="w-24 h-24 rounded-full border-4 border-indigo-600" src="https://via.placeholder.com/100" alt="Avatar">
                <div>
                    <h3 class="text-3xl font-bold text-gray-800">Kawtar Shaimi</h3>
                    <p class="text-lg text-gray-600">kawtar.shaimi8@gmail.com</p>
                    <p class="text-lg text-gray-600">Téléphone : <span class="text-indigo-500">0724636240</span></p>
                    <p class="text-gray-600 text-lg font-semibold">Rôle : <span class="text-indigo-500">Utilisateur</span></p>
                </div>
            </div>

            <button class="px-6 py-2 bg-purple-400 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition-all duration-300">
                Modifier le Profil
            </button>
        </div>

        <!-- Informations supplémentaires -->
        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-gray-800">Informations supplémentaires</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <h4 class="text-lg font-semibold text-gray-800">Nom</h4>
                    <p class="text-gray-600">Kawtar Shaimi</p>
                </div>
                <div class="space-y-2">
                    <h4 class="text-lg font-semibold text-gray-800">Email vérifié</h4>
                    <p class="text-gray-600">Oui</p>
                </div>
                <div class="space-y-2">
                    <h4 class="text-lg font-semibold text-gray-800">Date d'inscription</h4>
                    <p class="text-gray-600">01/01/2023</p>
                </div>
                <div class="space-y-2">
                    <h4 class="text-lg font-semibold text-gray-800">Rôle</h4>
                    <p class="text-gray-600">Utilisateur</p>
                </div>
            </div>
        </div>

        <!-- Historique des Commandes -->
        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-gray-800">Historique des Commandes</h2>

            <div class="overflow-x-auto bg-gray-100 p-6 rounded-lg shadow-lg">
                <table class="min-w-full text-sm">
                    <thead class="text-gray-600">
                        <tr class="bg-indigo-100">
                            <th class="py-3 px-4 text-left">N° Commande</th>
                            <th class="py-3 px-4 text-left">Date</th>
                            <th class="py-3 px-4 text-left">Montant</th>
                            <th class="py-3 px-4 text-left">Statut</th>
                            <th class="py-3 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Exemple de commande -->
                        <tr class="border-t hover:bg-indigo-50 text-gray-600">
                            <td class="py-3 px-4">#12345</td>
                            <td class="py-3 px-4">05/03/2025</td>
                            <td class="py-3 px-4">$49.99</td>
                            <td class="py-3 px-4">
                                <span class="px-3 py-1 bg-green-500 text-white text-xs rounded-full">Complétée</span>
                            </td>
                            <td class="py-3 px-4">
                                <button class="px-4 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition duration-300">Voir</button>
                            </td>
                        </tr>
                        <tr class="border-t hover:bg-indigo-50 text-gray-600">
                            <td class="py-3 px-4">#12346</td>
                            <td class="py-3 px-4">02/03/2025</td>
                            <td class="py-3 px-4">$19.99</td>
                            <td class="py-3 px-4">
                                <span class="px-3 py-1 bg-yellow-500 text-white text-xs rounded-full">En attente</span>
                            </td>
                            <td class="py-3 px-4">
                                <button class="px-4 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition duration-300">Voir</button>
                            </td>
                        </tr>
                        <tr class="border-t hover:bg-indigo-50 text-gray-600">
                            <td class="py-3 px-4">#12347</td>
                            <td class="py-3 px-4">28/02/2025</td>
                            <td class="py-3 px-4">$99.99</td>
                            <td class="py-3 px-4">
                                <span class="px-3 py-1 bg-red-500 text-white text-xs rounded-full">Annulée</span>
                            </td>
                            <td class="py-3 px-4">
                                <button class="px-4 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition duration-300">Voir</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection