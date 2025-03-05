<header class="bg-gray-900 text-gray-200 shadow-lg">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('products.index') }}" class="text-2xl font-bold text-purple-400">E-commerce</a>

        <!-- Navigation -->
        <nav class="hidden md:flex space-x-4">
            <a href="{{ route('products.index') }}" class="hover:text-white transition-colors">Home</a>
            <a href="#" class="hover:text-white transition-colors">Categories</a>
            <a href="#" class="hover:text-white transition-colors">About Us</a>
            <a href="#" class="hover:text-white transition-colors">Contact</a>
        </nav>

        <!-- User Menu -->
        <div class="flex items-center space-x-4">
            @guest
            <a href="{{ route('login') }}" class="hover:text-white transition-colors">Login</a>
            <a href="{{ route('register') }}" class="hover:text-white transition-colors">Register</a>
            @else
            <span class="hidden md:block">{{ Auth::user()->name }}</span>
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=6B7280&color=fff" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full">
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-lg">
                    <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-700">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-700">Logout</button>
                    </form>
                </div>
            </div>
            @endguest
        </div>

        <!-- Mobile Menu Button -->
        <button class="md:hidden text-gray-200" @click="mobileMenu = !mobileMenu">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Mobile Navigation -->
    <nav x-show="mobileMenu" class="md:hidden bg-gray-800">
        <a href="{{ route('products.index') }}" class="block px-4 py-2 hover:bg-gray-700">Home</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-700">Categories</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-700">About Us</a>
        <a href="#" class="block px-4 py-2 hover:bg-gray-700">Contact</a>
    </nav>
</header>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('header', () => ({
            mobileMenu: false,
        }))
    })
</script>