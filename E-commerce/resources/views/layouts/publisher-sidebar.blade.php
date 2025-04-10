<aside class="w-1/6 bg-gray-800 text-white h-screen fixed">
    <div class="p-4 text-center text-2xl font-bold">Publisher Panel</div>
    <nav class="mt-6">
        <a href="{{ route('publisher.index') }}" class="block px-4 py-2 hover:bg-gray-700">Dashboard</a>
        <a href="{{ route('publisher.books.index') }}" class="block px-4 py-2 hover:bg-gray-700">Books</a>
        <a href="{{ route('publisher.books.create') }}" class="block px-4 py-2 hover:bg-gray-700">Add Book</a>
        <a href="{{ route('publisher.reviews.index') }}" class="block px-4 py-2 hover:bg-gray-700">Reviews</a>
        <a href="{{ route('publisher.orders.index') }}" class="block px-4 py-2 hover:bg-gray-700">Orders</a>
        <a href="{{ route('publisher.profile') }}" class="block px-4 py-2 hover:bg-gray-700">Profile</a>
        <a href="{{ route('notifications.publisher') }}" class="block px-4 py-2 hover:bg-gray-700">Notifications <span id="notification-count" class="bg-red-500 text-white px-2 py-0.5 rounded-full ms-5">{{ \App\Models\User::find(Auth::guard('publisher')->user()->id)->unreadNotifications->count() }}</span></a>
        <form class="w-full" method="POST" action="{{ route('logout', 'publisher') }}">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-700">Logout</button>
        </form>
    </nav>
</aside>
