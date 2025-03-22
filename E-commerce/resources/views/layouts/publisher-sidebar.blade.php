<aside class="w-1/6 bg-gray-800 text-white h-screen fixed">
    <div class="p-4 text-center text-2xl font-bold">Publisher Panel</div>
    <nav class="mt-6">
        <a href="{{ route('publisher.index') }}" class="block px-4 py-2 hover:bg-gray-700">Tableau de bord</a>
        <a href="{{ route('publisher.products.index') }}" class="block px-4 py-2 hover:bg-gray-700">Produits</a>
        <a href="{{ route('publisher.products.create') }}" class="block px-4 py-2 hover:bg-gray-700">Create Produits</a>
    </nav>
</aside>
