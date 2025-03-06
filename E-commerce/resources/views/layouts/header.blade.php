<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/yourkit.js" crossorigin="anonymous"></script>
    <title>Header Statique</title>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- HEADER -->
    <header class="bg-gray-900 text-gray-200 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="#" class="text-2xl font-bold text-purple-400">E-commerce</a>

            <!-- Navigation Desktop -->
            <nav class="hidden md:flex space-x-4">
                <a href="#" class="hover:text-white transition-colors">Home</a>
                <a href="#" class="hover:text-white transition-colors">Categories</a>
                <a href="#" class="hover:text-white transition-colors">About Us</a>
                <a href="#" class="hover:text-white transition-colors">Contact</a>
            </nav>

            <!-- User Menu -->
            <div class="flex items-center space-x-2">
                <!-- Shopping Cart Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                    <path class="fill-white" d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                </svg>
                <a href="#" class="text-gray-200 hover:text-white transition-colors relative">
                    <i class="fas fa-shopping-cart text-2xl"></i>
                    <!-- Optionally add a badge for the number of items in the cart -->
                    <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">3</span>
                </a>
                <div class="relative">
                    <button id="userMenuButton" class="flex items-center space-x-4">
                        <img src="https://ui-avatars.com/api/?name=User&background=6B7280&color=fff" alt="User Avatar" class="w-8 h-8 rounded-full">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-lg">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-700">Profile</a>
                        <button id="logoutButton" class="block w-full text-left px-4 py-2 hover:bg-gray-700">Logout</button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobileMenuButton" class="md:hidden text-gray-200">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <nav id="mobileMenu" class="hidden md:hidden bg-gray-800">
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">Home</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">Categories</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">About Us</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">Contact</a>
            <button id="logoutButtonMobile" class="block w-full text-left px-4 py-2 hover:bg-gray-700">Logout</button>
        </nav>
    </header>

    <script>
        // Gestion du menu utilisateur
        document.getElementById("userMenuButton").addEventListener("click", function () {
            document.getElementById("userDropdown").classList.toggle("hidden");
        });

        // Gestion du menu mobile
        document.getElementById("mobileMenuButton").addEventListener("click", function () {
            document.getElementById("mobileMenu").classList.toggle("hidden");
        });

        // Gestion du logout (simple console.log)
        document.getElementById("logoutButton").addEventListener("click", function () {
            console.log("Déconnexion...");
        });

        document.getElementById("logoutButtonDesktop").addEventListener("click", function () {
            console.log("Déconnexion...");
        });

        document.getElementById("logoutButtonMobile").addEventListener("click", function () {
            console.log("Déconnexion...");
        });

        // Cacher le dropdown utilisateur quand on clique ailleurs
        document.addEventListener("click", function (event) {
            const userMenu = document.getElementById("userDropdown");
            const userMenuButton = document.getElementById("userMenuButton");

            if (!userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
                userMenu.classList.add("hidden");
            }
        });
    </script>

</body>
</html>