<header class="bg-gray-900 text-gray-200 shadow-lg">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-2xl font-bold text-purple-400">E-Commerce</a>

        <!-- Navigation -->
        <nav class="hidden md:flex space-x-4">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            @auth('client')
            <a href="{{ route('products') }}" class="hover:text-white transition-colors">Products</a>
            <a href="{{ route('client.order.track') }}" class="hover:text-white transition-colors">Track Order</a>
                <a href="{{ route('client.cart.index') }}" class="hover:text-white transition-colors">Cart</a>
                <a href="{{ route('client.wishlist.index') }}" class="hover:text-white transition-colors">WishList</a>
            @endauth
        </nav>

        @auth('client')
            <!-- Client Menu -->
            <div class="flex items-center">
                <a href="{{ route('client.index') }}" class="flex items-center space-x-4 px-4 py-2 hover:bg-gray-700">
                    <button class="flex items-center space-x-2">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::guard('client')->user()->name }}&background=c084fc&color=fff" alt="{{ Auth::guard('client')->user()->name }}" class="w-8 h-8 rounded-full">
                    </button>
                    <span class="hidden md:block">{{ Auth::guard('client')->user()->name }}</span>
                </a>
                <form method="POST" action="{{ route('logout', 'client') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-700">Logout</button>
                </form>
            </div>
        @endauth

        @guest('client')
            <div class="flex items-center space-x-4">
                <a href="{{ route('loginView') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            </div>
        @endguest
    </div>
</header>
