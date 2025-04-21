<div class="fixed inset-y-0 left-0 w-64 bg-gradient-to-b from-blue-900 to-blue-800 text-white flex flex-col shadow-xl">
    <!-- Profile Section -->
    <div class="p-5 border-b border-blue-700/50">
        <div class="flex items-center space-x-3">
            <div class="relative group">
                <div class="w-11 h-11 rounded-lg bg-white/10 backdrop-blur-sm flex items-center justify-center text-white text-lg font-bold shadow-md border border-white/20 group-hover:border-white/30 transition-all">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-blue-800"></div>
            </div>
            <div class="flex-1 overflow-hidden">
                <h3 class="font-medium text-sm truncate">{{ Auth::user()->name }}</h3>
                <div class="flex items-center mt-0.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                    <p class="text-xs text-blue-200/80">Publisher</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Menu -->
    <div class="flex-1 overflow-y-auto p-4 space-y-1">
        <p class="text-xs font-semibold text-blue-200 mb-2 ml-2">MAIN MENU</p>
        
        <a href="{{ route('publisher.index') }}" class="flex items-center py-2 px-3 rounded-lg text-sm {{ request()->routeIs('publisher.index') ? 'bg-white/10 text-white font-medium' : 'text-blue-100 hover:bg-white/5' }} transition-colors duration-150">
            <i class="fas fa-chart-line w-5 text-center mr-3"></i>
            Dashboard
        </a>
        
        <a href="{{ route('publisher.books.index') }}" class="flex items-center py-2 px-3 rounded-lg text-sm {{ request()->routeIs('publisher.books*') && !request()->routeIs('publisher.books.create') ? 'bg-white/10 text-white font-medium' : 'text-blue-100 hover:bg-white/5' }} transition-colors duration-150">
            <i class="fas fa-book w-5 text-center mr-3"></i>
            Books
        </a>
        
        <a href="{{ route('publisher.books.create') }}" class="flex items-center py-2 px-3 rounded-lg text-sm {{ request()->routeIs('publisher.books.create') ? 'bg-white/10 text-white font-medium' : 'text-blue-100 hover:bg-white/5' }} transition-colors duration-150">
            <i class="fas fa-plus w-5 text-center mr-3"></i>
            Add Book
        </a>
        
        <div class="h-px bg-blue-700/50 my-3"></div>
        <p class="text-xs font-semibold text-blue-200 mb-2 ml-2">MANAGEMENT</p>
        
        <a href="{{ route('publisher.reviews.index') }}" class="flex items-center py-2 px-3 rounded-lg text-sm {{ request()->routeIs('publisher.reviews*') ? 'bg-white/10 text-white font-medium' : 'text-blue-100 hover:bg-white/5' }} transition-colors duration-150">
            <i class="fas fa-star w-5 text-center mr-3"></i>
            Reviews
        </a>
        
        <a href="{{ route('publisher.orders.index') }}" class="flex items-center py-2 px-3 rounded-lg text-sm {{ request()->routeIs('publisher.orders*') ? 'bg-white/10 text-white font-medium' : 'text-blue-100 hover:bg-white/5' }} transition-colors duration-150">
            <i class="fas fa-shopping-cart w-5 text-center mr-3"></i>
            Orders
        </a>
        
        <a href="{{ route('notifications.publisher') }}" class="flex items-center py-2 px-3 rounded-lg text-sm {{ request()->routeIs('notifications.publisher') ? 'bg-white/10 text-white font-medium' : 'text-blue-100 hover:bg-white/5' }} transition-colors duration-150">
            <i class="fas fa-bell w-5 text-center mr-3"></i>
            Notifications
            @if (Auth::user()->unreadNotifications->count() > 0)
                <div class="ml-auto bg-blue-500 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full">
                    {{ Auth::user()->unreadNotifications->count() }}
                </div>
            @endif
        </a>
    </div>

    <!-- Logout -->
    <div class="p-4 border-t border-blue-700/50">
        <form action="{{ route('logout', 'publisher') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center py-2 px-4 rounded-lg bg-blue-700 hover:bg-blue-600 text-white text-sm transition-colors duration-150">
                <i class="fas fa-sign-out-alt mr-2"></i>
                Logout
            </button>
        </form>
    </div>
</div>
