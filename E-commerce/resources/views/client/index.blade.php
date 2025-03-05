<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Accueil - E-commerce</title>
    <style>
        .product-card:hover {
            transform: scale(1.05);
            transition: transform 0.2s;
        }
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">

    <!-- HEADER -->
    @include('layouts.header')

    <!-- Bannière Hero -->
    <section class="hero text-white text-center py-20">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold mb-4">Découvrez nos meilleurs produits</h1>
            <p class="text-lg mb-6">Profitez de nos offres exceptionnelles et achetez en toute simplicité.</p>
            <a href="#products" class="bg-white text-blue-600 font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-200">Voir les produits</a>
        </div>
    </section>

    <!-- Section Produits Populaires -->
    <div id="products" class="container mx-auto px-4 py-16">
        <h2 class="text-4xl font-bold text-center mb-12 text-blue-600">Nos Meilleurs Produits</h2>
        
        <!-- Filter Bar -->
        <div class="flex justify-end mb-6">
            <input type="text" id="productFilter" class="p-2 rounded-lg border border-gray-300" placeholder="Rechercher un produit...">
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <!-- Produit 1 -->
            <div class="bg-white rounded-lg shadow-lg p-6 product-card">
                <img src="https://via.placeholder.com/300" alt="Produit 1" class="rounded-md mb-4 w-full h-48 object-cover">
                <h3 class="text-xl font-bold mb-2 text-blue-600">Produit 1</h3>
                <p class="text-gray-600 mb-4">Description courte du produit.</p>
                <p class="text-lg font-semibold text-green-500">$29.99</p>
                <div class="mt-4 flex items-center">
                    <label for="quantity-1" class="text-gray-600 mr-2">Quantité:</label>
                    <input type="number" id="quantity-1" name="quantity" min="1" value="1" class="w-16 p-2 bg-gray-100 text-gray-900 rounded-lg">
                </div>
                <button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg w-full">Ajouter au panier</button>
            </div>

            <!-- Produit 2 -->
            <div class="bg-white rounded-lg shadow-lg p-6 product-card">
                <img src="https://via.placeholder.com/300" alt="Produit 2" class="rounded-md mb-4 w-full h-48 object-cover">
                <h3 class="text-xl font-bold mb-2 text-blue-600">Produit 2</h3>
                <p class="text-gray-600 mb-4">Description courte du produit.</p>
                <p class="text-lg font-semibold text-green-500">$39.99</p>
                <div class="mt-4 flex items-center">
                    <label for="quantity-2" class="text-gray-600 mr-2">Quantité:</label>
                    <input type="number" id="quantity-2" name="quantity" min="1" value="1" class="w-16 p-2 bg-gray-100 text-gray-900 rounded-lg">
                </div>
                <button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg w-full">Ajouter au panier</button>
            </div>

            <!-- Produit 3 -->
            <div class="bg-white rounded-lg shadow-lg p-6 product-card">
                <img src="https://via.placeholder.com/300" alt="Produit 3" class="rounded-md mb-4 w-full h-48 object-cover">
                <h3 class="text-xl font-bold mb-2 text-blue-600">Produit 3</h3>
                <p class="text-gray-600 mb-4">Description courte du produit.</p>
                <p class="text-lg font-semibold text-green-500">$49.99</p>
                <div class="mt-4 flex items-center">
                    <label for="quantity-3" class="text-gray-600 mr-2">Quantité:</label>
                    <input type="number" id="quantity-3" name="quantity" min="1" value="1" class="w-16 p-2 bg-gray-100 text-gray-900 rounded-lg">
                </div>
                <button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg w-full">Ajouter au panier</button>
            </div>

            <!-- Produit 4 -->
            <div class="bg-white rounded-lg shadow-lg p-6 product-card">
                <img src="https://via.placeholder.com/300" alt="Produit 4" class="rounded-md mb-4 w-full h-48 object-cover">
                <h3 class="text-xl font-bold mb-2 text-blue-600">Produit 4</h3>
                <p class="text-gray-600 mb-4">Description courte du produit.</p>
                <p class="text-lg font-semibold text-green-500">$59.99</p>
                <div class="mt-4 flex items-center">
                    <label for="quantity-4" class="text-gray-600 mr-2">Quantité:</label>
                    <input type="number" id="quantity-4" name="quantity" min="1" value="1" class="w-16 p-2 bg-gray-100 text-gray-900 rounded-lg">
                </div>
                <button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg w-full">Ajouter au panier</button>
            </div>

        </div>
    </div>

    <!-- Pourquoi nous choisir -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-8 text-blue-600">Pourquoi nous choisir ?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-gray-100 rounded-lg shadow-lg">
                    <i class="fas fa-truck text-blue-600 text-4xl mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Livraison rapide</h3>
                    <p class="text-gray-600">Recevez vos commandes en un temps record.</p>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow-lg">
                    <i class="fas fa-lock text-blue-600 text-4xl mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Paiement sécurisé</h3>
                    <p class="text-gray-600">Transactions sécurisées et protection des données.</p>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow-lg">
                    <i class="fas fa-star text-blue-600 text-4xl mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Qualité garantie</h3>
                    <p class="text-gray-600">Des produits de qualité sélectionnés avec soin.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Témoignages Clients -->
    <section class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-8">Ce que disent nos clients</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <p class="text-lg italic">"Super service ! Livraison rapide et produits de qualité."</p>
                    <h4 class="mt-4 font-bold">- Alice D.</h4>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                    <p class="text-lg italic">"Je recommande à 100%. Meilleure expérience d'achat en ligne."</p>
                    <h4 class="mt-4 font-bold">- Marc L.</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    @include('layouts.footer')

    <script>
        document.getElementById('productFilter').addEventListener('input', function() {
            let filterValue = this.value.toLowerCase();
            let productCards = document.querySelectorAll('.product-card');

            productCards.forEach(function(card) {
                let productName = card.querySelector('.product-name').textContent.toLowerCase();
                if (productName.includes(filterValue)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>

</body>
</html>