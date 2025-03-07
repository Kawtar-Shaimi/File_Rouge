<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Admin Dashboard</title>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white h-screen fixed">
        <div class="p-4 text-center text-2xl font-bold">Admin Panel</div>
        <nav class="mt-6">
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">Tableau de bord</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">Utilisateurs</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">Produits</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">Commandes</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">Catégories</a>
        </nav>
    </aside>

    <!-- Contenu principal -->
    <main class="ml-64 p-6">

        <!-- Dashboard -->
        <h1 class="text-3xl font-bold mb-6">Tableau de Bord</h1>
        <div class="grid grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h3 class="text-xl font-bold">Utilisateurs</h3>
                <p class="text-3xl text-blue-500 font-bold">120</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h3 class="text-xl font-bold">Produits</h3>
                <p class="text-3xl text-green-500 font-bold">45</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h3 class="text-xl font-bold">Commandes</h3>
                <p class="text-3xl text-red-500 font-bold">32</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <h3 class="text-xl font-bold">Catégories</h3>
                <p class="text-3xl text-yellow-500 font-bold">10</p>
            </div>
        </div>

        <!-- Tableau des Utilisateurs -->
        <h2 class="text-2xl font-bold mt-8 mb-4">Liste des Utilisateurs</h2>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3 border">ID</th>
                        <th class="p-3 border">Nom</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Rôle</th>
                        <th class="p-3 border">Mot de passe</th>
                        <th class="p-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td class="p-3 border">1</td>
                        <td class="p-3 border">Jean Dupont</td>
                        <td class="p-3 border">jean.dupont@email.com</td>
                        <td class="p-3 border text-blue-500 font-semibold">Admin</td>
                        <td class="p-3 border text-gray-500 italic">🔒 Chiffré</td>
                        <td class="p-3 border">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded">Modifier</button>
                            <button class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


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


        <!-- Tableau des Commandes -->
        <h2 class="text-2xl font-bold mt-8 mb-4">Liste des Commandes</h2>
        <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3 border">ID</th>
                        <th class="p-3 border">Client</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Montant Total</th>
                        <th class="p-3 border">Statut</th>
                        <th class="p-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td class="p-3 border">1</td>
                        <td class="p-3 border">Kawtar Shaimi</td>
                        <td class="p-3 border">kawtar.shaimi8@gmail.com</td>
                        <td class="p-3 border text-green-600 font-bold">$120.50</td>
                        <td class="p-3 border">
                            <span class="bg-yellow-400 text-white px-3 py-1 rounded">Pending</span>
                        </td>
                        <td class="p-3 border">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded">Modifier</button>
                            <button class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- Tableau des Catégories -->
        <h2 class="text-2xl font-bold mt-8 mb-4">Liste des Catégories</h2>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3 border">ID</th>
                        <th class="p-3 border">Nom</th>
                        <th class="p-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td class="p-3 border">1</td>
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

</body>
</html>
