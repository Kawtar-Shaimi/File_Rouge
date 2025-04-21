<aside class="w-1/6 bg-gradient-to-b from-blue-900 to-teal-900 text-white h-screen fixed shadow-xl">
    <div class="p-6">
        <div class="text-center">
            <h1 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-teal-200 to-blue-200">Admin Panel</h1>
        </div>
    </div>
    
    <nav class="mt-2 px-4">
        <div class="space-y-1">
            <a href="{{ route('admin.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-blue-800/30 rounded-lg transition-colors">
                <i class="fas fa-tachometer-alt w-5 text-center mr-3 text-teal-400"></i>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-blue-800/30 rounded-lg transition-colors">
                <i class="fas fa-users w-5 text-center mr-3 text-teal-400"></i>
                <span>Users</span>
            </a>
            
            <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-blue-800/30 rounded-lg transition-colors">
                <i class="fas fa-folder w-5 text-center mr-3 text-teal-400"></i>
                <span>Categories</span>
            </a>
            
            <a href="{{ route('admin.categories.create') }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-blue-800/30 rounded-lg transition-colors">
                <i class="fas fa-folder-plus w-5 text-center mr-3 text-teal-400"></i>
                <span>Add Category</span>
            </a>
            
            <a href="{{ route('admin.books.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-blue-800/30 rounded-lg transition-colors">
                <i class="fas fa-book w-5 text-center mr-3 text-teal-400"></i>
                <span>Books</span>
            </a>
            
            <a href="{{ route('admin.reviews.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-blue-800/30 rounded-lg transition-colors">
                <i class="fas fa-star w-5 text-center mr-3 text-teal-400"></i>
                <span>Reviews</span>
            </a>
            
            <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-blue-800/30 rounded-lg transition-colors">
                <i class="fas fa-shopping-cart w-5 text-center mr-3 text-teal-400"></i>
                <span>Orders</span>
            </a>
            
            <a href="{{ route('admin.payments.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-blue-800/30 rounded-lg transition-colors">
                <i class="fas fa-credit-card w-5 text-center mr-3 text-teal-400"></i>
                <span>Payments</span>
            </a>
            
            <a href="{{ route('admin.visits.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-blue-800/30 rounded-lg transition-colors">
                <i class="fas fa-chart-line w-5 text-center mr-3 text-teal-400"></i>
                <span>Visits</span>
            </a>
            
            <a href="{{ route('admin.profile') }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-blue-800/30 rounded-lg transition-colors">
                <i class="fas fa-user w-5 text-center mr-3 text-teal-400"></i>
                <span>Profile</span>
            </a>
            
            <a href="{{ route('notifications.admin') }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-blue-800/30 rounded-lg transition-colors">
                <i class="fas fa-bell w-5 text-center mr-3 text-teal-400"></i>
                <span>Notifications</span>
                @if(\App\Models\User::find(Auth::guard('admin')->user()->id)->unreadNotifications->count() > 0)
                    <span class="ml-auto bg-teal-500 text-white text-xs font-bold w-6 h-6 flex items-center justify-center rounded-full">
                        {{ \App\Models\User::find(Auth::guard('admin')->user()->id)->unreadNotifications->count() }}
                    </span>
                @endif
            </a>
        </div>
        
        <div class="mt-6 pt-6 border-t border-blue-800/50">
            <form method="POST" action="{{ route('logout', 'admin') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-red-800/30 rounded-lg transition-colors">
                    <i class="fas fa-sign-out-alt w-5 text-center mr-3 text-teal-400"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>
</aside>
