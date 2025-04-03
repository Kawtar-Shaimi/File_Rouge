<aside class="w-1/6 bg-gray-800 text-white h-screen fixed">
    <div class="p-4 text-center text-2xl font-bold">Publisher Panel</div>
    <nav class="mt-6">
        <a href="{{ route('publisher.index') }}" class="block px-4 py-2 hover:bg-gray-700">Tableau de bord</a>
        <a href="{{ route('publisher.books.index') }}" class="block px-4 py-2 hover:bg-gray-700">Books</a>
        <a href="{{ route('publisher.books.create') }}" class="block px-4 py-2 hover:bg-gray-700">Create Books</a>
        <a href="{{ route('publisher.reviews.index') }}" class="block px-4 py-2 hover:bg-gray-700">Reviews</a>
        <a href="{{ route('publisher.orders.index') }}" class="block px-4 py-2 hover:bg-gray-700">Orders</a>
        <form class="w-full" method="POST" action="{{ route('logout', 'publisher') }}">
            @csrf
            <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-700">Logout</button>
        </form>
    </nav>
</aside>
