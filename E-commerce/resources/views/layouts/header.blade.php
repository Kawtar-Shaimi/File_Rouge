<header class="bg-gradient-to-r from-slate-800 to-slate-900 text-gray-100 shadow-lg relative overflow-hidden border-b border-emerald-500/30">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
    <div class="absolute -top-24 -right-24 w-48 h-48 bg-emerald-600/20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-teal-500/20 rounded-full blur-3xl"></div>
    <div class="container mx-auto px-4 py-4 flex justify-between items-center relative z-10">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-500 tracking-tight">{{ config('app.name') }}</a>

        <!-- Navigation -->
        <nav class="hidden md:flex space-x-6">
            @if (!Auth::guard('publisher')->check() && !Auth::guard('admin')->check())
                <a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors duration-300 font-medium">Home</a>
            @endif
            @auth('client')
                <a href="{{ route('books') }}" class="hover:text-emerald-400 transition-colors duration-300 font-medium">Books</a>
                <a href="{{ route('client.order.track') }}" class="hover:text-emerald-400 transition-colors duration-300 font-medium">Track Order</a>
                <a href="{{ route('client.cart.index') }}" class="hover:text-emerald-400 transition-colors duration-300 font-medium">Cart</a>
                <a href="{{ route('client.wishlist.index') }}" class="hover:text-emerald-400 transition-colors duration-300 font-medium">WishList</a>
            @endauth
        </nav>

        @auth('client')
            <!-- Client Menu -->
            <div class="flex items-center">
                <a href="{{ route('client.index') }}" class="flex items-center space-x-4 px-4 py-2 hover:bg-slate-700/50 rounded-lg transition-colors duration-300">
                    <button class="flex items-center space-x-2">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::guard('client')->user()->name }}&background=065f46&color=fff"
                            alt="{{ Auth::guard('client')->user()->name }}" class="w-8 h-8 rounded-full ring-2 ring-emerald-500/50">
                    </button>
                    <span class="hidden md:block text-sm font-medium">{{ Auth::guard('client')->user()->name }}</span>
                </a>
                <div id="notification" class="relative mx-5">
                    <i class="fa-regular fa-bell text-xl cursor-pointer hover:text-emerald-400 transition-colors"></i>
                    @php
                        $user = Auth::guard('client')->user();
                    @endphp
                    <span id="notification-count"
                        class="absolute top-0 -right-1 bg-emerald-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs cursor-pointer">
                        {{ $user->unreadNotifications->count() }}
                    </span>
                    <div id="notification_list"
                        class="hidden absolute right-0 mt-2 w-72 bg-white rounded-lg shadow-2xl shadow-black/20 border border-slate-200">
                        <div class="py-2 px-3 bg-slate-50 border-b border-slate-200 rounded-t-lg">
                            <h4 class="text-sm font-semibold text-slate-700">Notifications</h4>
                        </div>
                        <ul class="py-2 max-h-64 overflow-y-auto">
                            @if ($user->unreadNotifications->count() > 0)
                                @for ($i = 0; $i < ($user->unreadNotifications->count() < 5 ? $user->unreadNotifications->count() : 5); $i++)
                                    <li
                                        class="px-4 py-2 border-b border-slate-100 @if (!$user->unreadNotifications[$i]->read_at) bg-emerald-50 hover:bg-emerald-100 @else hover:bg-slate-50 @endif transition-colors">
                                        <a href="{{ route('notifications.read-notification', $user->unreadNotifications[$i]->id) }}"
                                            class="block text-slate-700 text-sm">{{ Str::limit($user->unreadNotifications[$i]->data['message'], 20) }}</a>
                                    </li>
                                @endfor
                                <li><a href="{{ route('notifications.client') }}"
                                        class="block text-emerald-600 px-4 py-2 text-sm hover:underline text-center">View all
                                        notifications</a></li>
                            @else
                                <li class="px-4 py-10 text-slate-500 text-center font-medium flex items-center justify-center">
                                    <span class="border border-slate-200 rounded-lg py-3 px-4 inline-flex items-center">
                                        <i class="far fa-bell-slash mr-2 text-slate-400"></i> No notifications
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout', 'client') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors duration-300">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </button>
                </form>
            </div>
        @endauth

        @auth('publisher')
            <!-- Publisher Menu -->
            <div class="flex items-center">
                <a href="{{ route('publisher.profile') }}" class="flex items-center space-x-4 px-4 py-2 hover:bg-slate-700/50 rounded-lg transition-colors duration-300">
                    <button class="flex items-center space-x-2">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::guard('publisher')->user()->name }}&background=065f46&color=fff"
                            alt="{{ Auth::guard('publisher')->user()->name }}" class="w-8 h-8 rounded-full ring-2 ring-emerald-500/50">
                    </button>
                    <span class="hidden md:block text-sm font-medium">{{ Auth::guard('publisher')->user()->name }}</span>
                </a>
                <form method="POST" action="{{ route('logout', 'publisher') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors duration-300">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </button>
                </form>
            </div>
        @endauth

        @auth('admin')
            <!-- Admin Menu -->
            <div class="flex items-center">
                <a href="{{ route('admin.profile') }}" class="flex items-center space-x-4 px-4 py-2 hover:bg-slate-700/50 rounded-lg transition-colors duration-300">
                    <button class="flex items-center space-x-2">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::guard('admin')->user()->name }}&background=065f46&color=fff"
                            alt="{{ Auth::guard('admin')->user()->name }}" class="w-8 h-8 rounded-full ring-2 ring-emerald-500/50">
                    </button>
                    <span class="hidden md:block text-sm font-medium">{{ Auth::guard('admin')->user()->name }}</span>
                </a>
                <form method="POST" action="{{ route('logout', 'admin') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-slate-300 hover:text-white hover:bg-slate-700/50 rounded-lg transition-colors duration-300">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </button>
                </form>
            </div>
        @endauth

        @if (!Auth::guard('client')->check() && !Auth::guard('publisher')->check() && !Auth::guard('admin')->check())
            <!-- Guest Menu -->
            <div class="flex items-center space-x-4">
                <a href="{{ route('loginView') }}" class="text-slate-200 hover:text-white font-medium text-sm transition-colors">Login</a>
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white text-sm font-semibold py-2 px-5 rounded-lg transition-all duration-300 shadow-lg shadow-emerald-500/20 hover:shadow-emerald-600/30 border border-emerald-400/30">Register</a>
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
