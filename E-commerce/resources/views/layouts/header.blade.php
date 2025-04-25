<header class="bg-gray-900 text-gray-200 shadow-lg">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-2xl font-bold text-purple-400">{{ config('app.name') }}</a>

        <!-- Navigation -->
        <nav class="hidden md:flex space-x-4">
            @if (!Auth::guard('publisher')->check() && !Auth::guard('admin')->check())
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            @endif
            @auth('client')
                <a href="{{ route('books') }}" class="hover:text-white transition-colors">Books</a>
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
                        <img src="https://ui-avatars.com/api/?name={{ Auth::guard('client')->user()->name }}&background=c084fc&color=fff"
                            alt="{{ Auth::guard('client')->user()->name }}" class="w-8 h-8 rounded-full">
                    </button>
                    <span class="hidden md:block">{{ Auth::guard('client')->user()->name }}</span>
                </a>
                <div id="notification" class="relative mx-5">
                    <i class="fa-regular fa-bell text-xl cursor-pointer"></i>
                    @php
                        $user = Auth::guard('client')->user();
                    @endphp
                    <span id="notification-count"
                        class="absolute top-0 -right-1 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-sm cursor-pointer">
                        {{ $user->unreadNotifications->count() }}
                    </span>
                    <div id="notification_list"
                        class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-2xl shadow-black">
                        <ul class="py-2">
                            @if ($user->unreadNotifications->count() > 0)
                                @for ($i = 0; $i < ($user->unreadNotifications->count() < 5 ? $user->unreadNotifications->count() : 5); $i++)
                                    <li
                                        class="px-4 py-2 border-b @if (!$user->unreadNotifications[$i]->read_at) bg-gray-400 hover:bg-gray-500 @else hover:bg-gray-100 @endif">
                                        <a href="{{ route('notifications.read-notification', $user->unreadNotifications[$i]->id) }}"
                                            class="block text-gray-800">{{ Str::limit($user->unreadNotifications[$i]->data['message'], 20) }}</a>
                                    </li>
                                @endfor
                                <li><a href="{{ route('notifications.client') }}"
                                        class="block text-blue-400 px-4 py-1 text-sm hover:underline">View all
                                        notifications</a></li>
                            @else
                                <li class="px-4 py-2 hover:bg-gray-100 text-red-500 text-center font-semibold">No
                                    notifications</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout', 'client') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-700">Logout</button>
                </form>
            </div>
        @endauth

        @auth('publisher')
            <!-- Publisher Menu -->
            <div class="flex items-center">
                <a href="{{ route('publisher.profile') }}" class="flex items-center space-x-4 px-4 py-2 hover:bg-gray-700">
                    <button class="flex items-center space-x-2">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::guard('publisher')->user()->name }}&background=c084fc&color=fff"
                            alt="{{ Auth::guard('publisher')->user()->name }}" class="w-8 h-8 rounded-full">
                    </button>
                    <span class="hidden md:block">{{ Auth::guard('publisher')->user()->name }}</span>
                </a>
                <form method="POST" action="{{ route('logout', 'publisher') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-700">Logout</button>
                </form>
            </div>
        @endauth

        @auth('admin')
            <!-- Admin Menu -->
            <div class="flex items-center">
                <a href="{{ route('admin.profile') }}" class="flex items-center space-x-4 px-4 py-2 hover:bg-gray-700">
                    <button class="flex items-center space-x-2">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::guard('admin')->user()->name }}&background=c084fc&color=fff"
                            alt="{{ Auth::guard('admin')->user()->name }}" class="w-8 h-8 rounded-full">
                    </button>
                    <span class="hidden md:block">{{ Auth::guard('admin')->user()->name }}</span>
                </a>
                <form method="POST" action="{{ route('logout', 'admin') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-700">Logout</button>
                </form>
            </div>
        @endauth

        @if (!Auth::guard('client')->check() && !Auth::guard('publisher')->check() && !Auth::guard('admin')->check())
            <!-- Guest Menu -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('loginView') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
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
