<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Tableau de Bord Admin</title>
</head>
<body class="bg-gray-100 text-gray-900">

    @include('layouts.header')

    <!-- Contenu du Tableau de Bord -->
    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">

            <!-- Carte Utilisateurs -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
                <div class="mr-4">
                    <svg class="w-16 h-16 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.66 0-8 1.34-8 4v2h16v-2c0-2.66-5.34-4-8-4z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold">Utilisateurs</h3>
                    <p class="text-lg">1500</p>
                </div>
            </div>

            <!-- Carte Produits -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
                <div class="mr-4">
                    <svg class="w-16 h-16 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 6H4v12h16V6zm-8 9h-2v-2h2v2zm0-4h-2V7h2v4z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold">Produits</h3>
                    <p class="text-lg">500</p>
                </div>
            </div>

            <!-- Carte Commandes -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
                <div class="mr-4">
                    <svg class="w-16 h-16 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8zm1-13h-2v6h2V7zM13 15h-2v2h2v-2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold">Commandes</h3>
                    <p class="text-lg">1200</p>
                </div>
            </div>

            <!-- Carte Revenu -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
                <div class="mr-4">
                    <svg class="w-16 h-16 text-purple-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8zm-1-13h2v6h-2zm1 12v-2h-2v2h2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold">Revenu</h3>
                    <p class="text-lg">$15,000</p>
                </div>
            </div>

            <!-- Carte Catégories -->
            <div class="bg-white p-6 rounded-lg shadow-md flex items-center">
                <div class="mr-4">
                    <svg class="w-16 h-16 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm1 12v-2h-2v2h2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold">Catégories</h3>
                    <p class="text-lg">30</p>
                </div>
            </div>

        </div>

        <!-- Statistiques et Graphiques -->
        <div class="bg-white p-6 mt-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6">Statistiques</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-gray-200 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-center">Ventes</h3>
                    <div class="h-40 bg-gray-400 rounded-lg mt-4">Graphique ici</div>
                </div>
                <div class="bg-gray-200 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-center">Utilisateurs</h3>
                    <div class="h-40 bg-gray-400 rounded-lg mt-4">Graphique ici</div>
                </div>
                <div class="bg-gray-200 p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-center">Commandes</h3>
                    <div class="h-40 bg-gray-400 rounded-lg mt-4">Graphique ici</div>
                </div>
            </div>
        </div>

    </div>


    @include('layouts.footer')

</body>
</html>
