<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Détail du Produit</title>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    <header class="bg-blue-500 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Ma Boutique</h1>
            <nav>
                <a href="#" class="px-4 hover:underline">Accueil</a>
                <a href="#" class="px-4 hover:underline">Produits</a>
                <a href="#" class="px-4 hover:underline">Mon compte</a>
            </nav>
        </div>
    </header>

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

        
        <!-- Avis clients -->
        <div class="bg-white p-6 mt-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Avis des clients</h3>
            
            <div class="border-b pb-4 mb-4">
                <p class="text-gray-700"><strong>Jean Dupont</strong> - ★★★★★</p>
                <p class="text-gray-600">Excellent produit, qualité au top ! Je recommande vivement.</p>
            </div>

            <div class="border-b pb-4 mb-4">
                <p class="text-gray-700"><strong>Marie Curie</strong> - ★★★★☆</p>
                <p class="text-gray-600">Très bon rapport qualité-prix, livraison rapide.</p>
            </div>

            <button class="mt-4 px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                Voir tous les avis
            </button>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center p-4 mt-10">
        &copy; 2025 Ma Boutique - Tous droits réservés.
    </footer>

</body>
</html>
