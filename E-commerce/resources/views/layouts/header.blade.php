<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/yourkit.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <title>Header Statique</title>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- HEADER -->
    <header class="bg-gray-900 to-purple-600 text-gray-200 shadow-xl">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="#" class="text-3xl font-bold text-white hover:text-gray-200 transition-colors duration-300">E-commerce</a>

            <!-- Navigation Desktop -->
            <nav class="hidden md:flex space-x-6">
                <a href="#" class="hover:text-white transition-colors">Acceuil</a>
                <a href="#" class="hover:text-white transition-colors">Mes Produits</a>
                <a href="#" class="hover:text-white transition-colors">Statistics</a>
                <a href="#" class="hover:text-white transition-colors">Contact</a>
                <a href="#" class="hover:text-white transition-colors">About Us</a>
            </nav>

            <!-- User Menu -->
            <div class="flex items-center space-x-10">
                <!-- Bonjour Kawtar -->
                <div class="hidden md:flex items-center text-white text-lg">
                    <span>Bonjour, Kawtar</span>
                </div>

                <!-- Shopping Cart Icon -->
                <!-- Shopping Cart Icon avec FontAwesome -->
                <div class="relative">
                    <a href="#" class="text-gray-200 hover:text-white transition-colors relative">
                        <i class="fas fa-shopping-cart text-2xl"></i> <!-- Utilisation de FontAwesome -->
                        <!-- Badge for items in the cart -->
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">3</span>
                    </a>
                </div>


                <!-- User Profile Menu -->
                <div class="relative">
                    <button id="userMenuButton" class="flex items-center space-x-4">
                        <img src="https://ui-avatars.com/api/?name=User&background=6B7280&color=fff" alt="User Avatar" class="w-8 h-8 rounded-full border-2 border-white">
                        <i class="fas fa-chevron-down text-white"></i>
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
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">Acceuil</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">Mes Produits</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">Statistics</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">Contact</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-700">About Us</a>
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
