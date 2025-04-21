<header class="bg-gradient-to-r from-teal-700 to-blue-900 text-white shadow-xl">
    <div class="container mx-auto px-6 py-5 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-2xl font-bold">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-teal-200 to-blue-200">{{ config('app.name') }}</span>
        </a>

        <!-- Navigation -->
        <nav class="hidden md:flex items-center space-x-6">
            @if (!Auth::guard('publisher')->check() && !Auth::guard('admin')->check())
                <a href="{{ route('home') }}" class="text-teal-100 hover:text-white font-medium transition-all duration-200 hover:scale-105 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-teal-300 after:transition-all">Home</a>
            @endif
            @auth('client')
                <a href="{{ route('books') }}" class="text-teal-100 hover:text-white font-medium transition-all duration-200 hover:scale-105 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-teal-300 after:transition-all">Books</a>
                <a href="{{ route('client.order.track') }}" class="text-teal-100 hover:text-white font-medium transition-all duration-200 hover:scale-105 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-teal-300 after:transition-all">Track Order</a>
                <a href="{{ route('client.cart.index') }}" class="text-teal-100 hover:text-white font-medium transition-all duration-200 hover:scale-105 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-teal-300 after:transition-all">Cart</a>
                <a href="{{ route('client.wishlist.index') }}" class="text-teal-100 hover:text-white font-medium transition-all duration-200 hover:scale-105 relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-teal-300 after:transition-all">WishList</a>
            @endauth
        </nav>

        @auth('client')
            <!-- Client Menu -->
            <div class="flex items-center">
                <a href="{{ route('client.index') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg hover:bg-blue-800/50 transition-colors duration-200">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::guard('client')->user()->name }}&background=0891b2&color=fff"
                            alt="{{ Auth::guard('client')->user()->name }}" class="w-9 h-9 rounded-full shadow-md border-2 border-teal-300">
                        <div class="absolute -bottom-1 -right-1 h-3 w-3 bg-green-400 rounded-full border border-white"></div>
                    </div>
                    <span class="hidden md:block font-medium">{{ Auth::guard('client')->user()->name }}</span>
                </a>
                <div id="notification" class="relative mx-4">
                    <i class="fa-regular fa-bell text-xl cursor-pointer hover:text-teal-200 transition-colors"></i>
                    @php
                        $user = \App\Models\User::find(Auth::guard('client')->user()->id);
                    @endphp
                    <span id="notification-count"
                        class="absolute top-0 -right-1 bg-teal-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold cursor-pointer shadow-md">
                        {{ $user->unreadNotifications->count() }}
                    </span>
                    <div id="notification_list"
                        class="hidden absolute right-0 mt-3 w-72 bg-white rounded-lg shadow-2xl border border-gray-100 z-50">
                        <div class="py-2 px-3 bg-gradient-to-r from-teal-700 to-blue-900 text-white rounded-t-lg">
                            <h3 class="font-semibold">Notifications</h3>
                        </div>
                        <ul class="py-2 max-h-80 overflow-y-auto">
                            @if ($user->unreadNotifications->count() > 0)
                                @for ($i = 0; $i < ($user->unreadNotifications->count() < 5 ? $user->unreadNotifications->count() : 5); $i++)
                                    <li class="border-b border-gray-100 last:border-0">
                                        <a href="{{ route('notifications.read-notification', $user->unreadNotifications[$i]->id) }}"
                                            class="block px-4 py-3 hover:bg-gray-50 transition-colors @if (!$user->unreadNotifications[$i]->read_at) bg-teal-50 @endif">
                                            <p class="text-gray-800 font-medium">{{ Str::limit($user->unreadNotifications[$i]->data['message'], 40) }}</p>
                                            <p class="text-xs text-gray-500 mt-1">{{ $user->unreadNotifications[$i]->created_at->diffForHumans() }}</p>
                                        </a>
                                    </li>
                                @endfor
                                <li class="border-t border-gray-100 bg-gray-50">
                                    <a href="{{ route('notifications.client') }}"
                                        class="block text-teal-600 px-4 py-2 text-sm font-medium hover:underline text-center">
                                        View all notifications
                                    </a>
                                </li>
                            @else
                                <li class="px-4 py-6 text-gray-500 text-center">
                                    <i class="fas fa-bell-slash text-gray-300 text-3xl mb-2"></i>
                                    <p class="font-medium">No notifications</p>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout', 'client') }}">
                    @csrf
                    <button type="submit" class="rounded-lg px-4 py-2 bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white font-medium transition-all hover:shadow-lg">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </button>
                </form>
            </div>
        @endauth

        @auth('publisher')
            <!-- Publisher Menu -->
            <div class="flex items-center">
                <a href="{{ route('publisher.profile') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg hover:bg-blue-800/50 transition-colors duration-200">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::guard('publisher')->user()->name }}&background=0891b2&color=fff"
                            alt="{{ Auth::guard('publisher')->user()->name }}" class="w-9 h-9 rounded-full shadow-md border-2 border-teal-300">
                        <div class="absolute -bottom-1 -right-1 h-3 w-3 bg-green-400 rounded-full border border-white"></div>
                    </div>
                    <span class="hidden md:block font-medium">{{ Auth::guard('publisher')->user()->name }}</span>
                </a>
                <form method="POST" action="{{ route('logout', 'publisher') }}">
                    @csrf
                    <button type="submit" class="ml-3 rounded-lg px-4 py-2 bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white font-medium transition-all hover:shadow-lg">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </button>
                </form>
            </div>
        @endauth

        @auth('admin')
            <!-- Admin Menu -->
            <div class="flex items-center">
                <a href="{{ route('admin.profile') }}" class="flex items-center space-x-3 px-4 py-2 rounded-lg hover:bg-blue-800/50 transition-colors duration-200">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::guard('admin')->user()->name }}&background=0891b2&color=fff"
                            alt="{{ Auth::guard('admin')->user()->name }}" class="w-9 h-9 rounded-full shadow-md border-2 border-teal-300">
                        <div class="absolute -bottom-1 -right-1 h-3 w-3 bg-green-400 rounded-full border border-white"></div>
                    </div>
                    <span class="hidden md:block font-medium">{{ Auth::guard('admin')->user()->name }}</span>
                </a>
                <form method="POST" action="{{ route('logout', 'admin') }}">
                    @csrf
                    <button type="submit" class="ml-3 rounded-lg px-4 py-2 bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white font-medium transition-all hover:shadow-lg">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </button>
                </form>
            </div>
        @endauth

        @if (!Auth::guard('client')->check() && !Auth::guard('publisher')->check() && !Auth::guard('admin')->check())
            <!-- Guest Menu -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('loginView') }}" class="px-4 py-2 text-teal-100 hover:text-white font-medium transition-colors">Login</a>
                <a href="{{ route('register') }}" class="rounded-lg px-4 py-2 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white font-medium transition-all hover:shadow-lg">Register</a>
            </div>
        @endif
    </div>
    <script>
        $(document).ready(function() {
            $('#notification').click(function() {
                $('#notification_list').toggleClass('hidden');
            });
        })
    </script>
</header>
