<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Mes Produits</title>
</head>
<body class="bg-gray-100 text-gray-900">

    @include('layouts.header')

    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-extrabold mb-6 text-center text-gray-800">📦 Mes Produits Publiés</h2>

        <!-- Grille des produits -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            
            <!-- Produit 1 -->
            <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                <img src="https://via.placeholder.com/300" alt="Chaussures Nike" class="w-full h-48 object-cover rounded-md">
                <div class="mt-4">
                    <h3 class="text-xl font-semibold">Chaussures Nike</h3>
                    <p class="text-green-600 font-bold text-lg">$120.00</p>
                    <div class="mt-4 flex justify-between">
                        <button class="text-blue-500 hover:bg-blue-100 p-2 rounded-lg transition duration-300">
                            ✏️ Modifier
                        </button>
                        <button class="text-red-500 hover:bg-red-100 p-2 rounded-lg transition duration-300">
                            🗑️ Supprimer
                        </button>
                    </div>
                </div>
            </div>

            <!-- Produit 2 -->
            <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                <img src="https://via.placeholder.com/300" alt="Sac Adidas" class="w-full h-48 object-cover rounded-md">
                <div class="mt-4">
                    <h3 class="text-xl font-semibold">Sac à dos Adidas</h3>
                    <p class="text-green-600 font-bold text-lg">$80.00</p>
                    <div class="mt-4 flex justify-between">
                        <button class="text-blue-500 hover:bg-blue-100 p-2 rounded-lg transition duration-300">
                            ✏️ Modifier
                        </button>
                        <button class="text-red-500 hover:bg-red-100 p-2 rounded-lg transition duration-300">
                            🗑️ Supprimer
                        </button>
                    </div>
                </div>
            </div>

            <!-- Produit 3 -->
            <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                <img src="https://via.placeholder.com/300" alt="Montre Fossil" class="w-full h-48 object-cover rounded-md">
                <div class="mt-4">
                    <h3 class="text-xl font-semibold">Montre Fossil</h3>
                    <p class="text-green-600 font-bold text-lg">$150.00</p>
                    <div class="mt-4 flex justify-between">
                        <button class="text-blue-500 hover:bg-blue-100 p-2 rounded-lg transition duration-300">
                            ✏️ Modifier
                        </button>
                        <button class="text-red-500 hover:bg-red-100 p-2 rounded-lg transition duration-300">
                            🗑️ Supprimer
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- Message si aucun produit -->
        <p class="text-center text-gray-500 mt-6">😞 Aucun produit publié pour le moment.</p>

        <!-- Bouton Ajouter un Produit -->
        <div class="text-center mt-6">
            <button class="bg-purple-400 text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-blue-600 transition duration-300 shadow-md">
                ➕ Ajouter un produit
            </button>
        </div>

    </div>

    @include('layouts.footer')

</body>
</html>
