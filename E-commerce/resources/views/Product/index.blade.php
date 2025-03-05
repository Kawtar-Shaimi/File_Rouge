<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Nos Produits</title>
    <style>
        .product-card:hover {
            transform: scale(1.05);
            transition: transform 0.2s ease-in-out;
        }
        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .quantity-input {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- HEADER -->
    @include('layouts.header')

    <!-- Section Recherche et Filtrage -->
    <div class="container mx-auto px-4 py-10">
        <h1 class="text-4xl font-bold text-center mb-8 text-blue-600">Nos Produits</h1>

        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <!-- Recherche -->
            <div class="relative w-full md:w-1/3 mb-4 md:mb-0">
                <input type="text" id="searchInput" placeholder="Rechercher un produit..." 
                    class="w-full p-3 border rounded-lg shadow-md focus:ring focus:ring-blue-300">
                <button class="absolute right-2 top-2 bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none">
                    Chercher
                </button>
            </div>

            <!-- Filtre par prix -->
            <div>
                <label for="priceFilter" class="block text-lg font-semibold text-blue-600">Filtrer par prix :</label>
                <input type="range" id="priceFilter" min="10" max="100" value="100" 
                    class="w-64 cursor-pointer">
                <span id="priceValue" class="font-semibold">100€</span>
            </div>
        </div>

        <!-- Produits Grid -->
        <div id="productGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Les produits seront injectés ici -->
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-8">
            <button id="firstPage" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-l-lg focus:outline-none">
                Premier
            </button>
            <button id="prevPage" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 focus:outline-none">
                Précédent
            </button>
            <span id="pageNumber" class="mx-4 text-lg font-semibold text-blue-600">1</span>
            <button id="nextPage" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 focus:outline-none">
                Suivant
            </button>
            <button id="lastPage" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-r-lg focus:outline-none">
                Dernier
            </button>
        </div>
    </div>

    <!-- FOOTER -->
    @include('layouts.footer')

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const products = [
                { id: 1, name: "Produit A", price: 30, image: "https://via.placeholder.com/300" },
                { id: 2, name: "Produit B", price: 50, image: "https://via.placeholder.com/300" },
                { id: 3, name: "Produit C", price: 20, image: "https://via.placeholder.com/300" },
                { id: 4, name: "Produit D", price: 60, image: "https://via.placeholder.com/300" },
                { id: 5, name: "Produit E", price: 40, image: "https://via.placeholder.com/300" },
                { id: 6, name: "Produit F", price: 70, image: "https://via.placeholder.com/300" },
                { id: 7, name: "Produit G", price: 90, image: "https://via.placeholder.com/300" },
                { id: 8, name: "Produit H", price: 10, image: "https://via.placeholder.com/300" },
                { id: 9, name: "Produit I", price: 35, image: "https://via.placeholder.com/300" },
                { id: 10, name: "Produit J", price: 80, image: "https://via.placeholder.com/300" }
            ];

            const perPage = 4;
            let currentPage = 1;
            const searchInput = document.getElementById("searchInput");
            const priceFilter = document.getElementById("priceFilter");
            const priceValue = document.getElementById("priceValue");
            const productGrid = document.getElementById("productGrid");
            const prevPageBtn = document.getElementById("prevPage");
            const nextPageBtn = document.getElementById("nextPage");
            const pageNumber = document.getElementById("pageNumber");
            const firstPageBtn = document.getElementById("firstPage");
            const lastPageBtn = document.getElementById("lastPage");

            function renderProducts() {
                productGrid.innerHTML = "";
                let filteredProducts = products.filter(p => p.price <= priceFilter.value);

                if (searchInput.value.trim() !== "") {
                    filteredProducts = filteredProducts.filter(p => 
                        p.name.toLowerCase().includes(searchInput.value.toLowerCase())
                    );
                }

                const start = (currentPage - 1) * perPage;
                const paginatedProducts = filteredProducts.slice(start, start + perPage);

                paginatedProducts.forEach(product => {
                    const productCard = `
                        <div class="bg-white rounded-lg shadow-lg p-6 product-card">
                            <img src="${product.image}" alt="${product.name}" class="rounded-md mb-4 w-full h-48 object-cover">
                            <h3 class="text-xl font-bold mb-2 text-blue-600">${product.name}</h3>
                            <p class="text-lg font-semibold text-green-500">${product.price}€</p>
                            <div class="mt-4 flex items-center">
                            <label for="quantity-3" class="text-gray-600 mr-2">Quantité:</label>
                            <input type="number" id="quantity-3" name="quantity" min="1" value="1" class="w-16 p-2 bg-gray-100 text-gray-900 rounded-lg">
                        </div>
                            <button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg w-full">Ajouter au panier</button>
                        </div>
                    `;
                    productGrid.innerHTML += productCard;
                });
                

                document.querySelectorAll(".decrease-quantity").forEach(button => {
                    button.addEventListener("click", (event) => {
                        const input = event.target.nextElementSibling;
                        if (input.value > 1) {
                            input.value = parseInt(input.value) - 1;
                        }
                    });
                });

                document.querySelectorAll(".increase-quantity").forEach(button => {
                    button.addEventListener("click", (event) => {
                        const input = event.target.previousElementSibling;
                        input.value = parseInt(input.value) + 1;
                    });
                });

                pageNumber.textContent = currentPage;
                prevPageBtn.disabled = currentPage === 1;
                nextPageBtn.disabled = currentPage * perPage >= filteredProducts.length;
                firstPageBtn.disabled = currentPage === 1;
                lastPageBtn.disabled = currentPage * perPage >= filteredProducts.length;
            }

            searchInput.addEventListener("input", () => {
                currentPage = 1;
                renderProducts();
            });

            priceFilter.addEventListener("input", () => {
                priceValue.textContent = priceFilter.value + "€";
                currentPage = 1;
                renderProducts();
            });

            prevPageBtn.addEventListener("click", () => {
                if (currentPage > 1) {
                    currentPage--;
                    renderProducts();
                }
            });

            nextPageBtn.addEventListener("click", () => {
                currentPage++;
                renderProducts();
            });

            firstPageBtn.addEventListener("click", () => {
                currentPage = 1;
                renderProducts();
            });

            lastPageBtn.addEventListener("click", () => {
                currentPage = Math.ceil(products.filter(p => p.price <= priceFilter.value).length / perPage);
                renderProducts();
            });

            renderProducts();
        });
    </script>

</body>
</html>