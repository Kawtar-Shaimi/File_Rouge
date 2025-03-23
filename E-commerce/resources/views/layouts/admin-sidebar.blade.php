<aside class="w-1/6 bg-gray-800 text-white h-screen fixed">
    <div class="p-4 text-center text-2xl font-bold">Admin Panel</div>
    <nav class="mt-6">
        <a href="{{ route('admin.index') }}" class="block px-4 py-2 hover:bg-gray-700">Tableau de bord</a>
        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 hover:bg-gray-700">Utilisateurs</a>
        <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 hover:bg-gray-700">Catégories</a>
        <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 hover:bg-gray-700">Produits</a>
        <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 hover:bg-gray-700">Commandes</a>
    </nav>
</aside>
