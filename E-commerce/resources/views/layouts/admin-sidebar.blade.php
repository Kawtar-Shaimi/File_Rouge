<aside class="w-1/6 bg-gray-800 text-white h-screen fixed">
    <div class="p-4 text-center text-2xl font-bold">Admin Panel</div>
    <nav class="mt-6">
        <a href="{{ route('admin.index') }}" class="block px-4 py-2 hover:bg-gray-700">Dashboard</a>
        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 hover:bg-gray-700">Users</a>
        <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 hover:bg-gray-700">Categories</a>
        <a href="{{ route('admin.categories.create') }}" class="block px-4 py-2 hover:bg-gray-700">Add Category</a>
        <a href="{{ route('admin.books.index') }}" class="block px-4 py-2 hover:bg-gray-700">Books</a>
        <a href="{{ route('admin.reviews.index') }}" class="block px-4 py-2 hover:bg-gray-700">Reviews</a>
        <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 hover:bg-gray-700">Orders</a>
        <a href="{{ route('admin.payments.index') }}" class="block px-4 py-2 hover:bg-gray-700">Payments</a>
        <a href="{{ route('admin.visits.index') }}" class="block px-4 py-2 hover:bg-gray-700">Visits</a>
        <a href="{{ route('admin.profile') }}" class="block px-4 py-2 hover:bg-gray-700">Profile</a>
        <a href="{{ route('notifications.admin') }}" class="block px-4 py-2 hover:bg-gray-700">Notifications <span id="notification-count" class="bg-red-500 text-white px-2 py-0.5 rounded-full ms-5">{{ Auth::guard('admin')->user()->unreadNotifications->count() }}</span></a>
        <form class="w-full" method="POST" action="{{ route('logout', 'admin') }}">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-700">Logout</button>
        </form>
    </nav>
</aside>
