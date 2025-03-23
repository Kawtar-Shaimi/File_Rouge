@extends('layouts.app')

@section('content')

@include('layouts.admin-sidebar')

<!-- Contenu principal -->
<main class="ml-64 p-6">

    @if (session()->has('success'))
        <x-alert type="success" :message="session('success')" />
    @elseif (session()->has('error'))
        <x-alert type="error" :message="session('error')" />
    @endif

    <!-- Tableau des Produits -->
    <h2 class="text-2xl font-bold mt-8 mb-4">Liste des Produits</h2>
    <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 border">ID</th>
                    <th class="p-3 border">Nom</th>
                    <th class="p-3 border">Description</th>
                    <th class="p-3 border">Prix</th>
                    <th class="p-3 border">Stock</th>
                    <th class="p-3 border">Catégorie</th>
                    <th class="p-3 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        <tr class="text-center">
                            <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.products.show', $product) }}">#{{ $product->id }}</a></td>
                            <td class="p-3 border">{{ $product->name }}</td>
                            <td class="p-3 border truncate w-40">{{ Str::limit($product->description, 15) }}</td>
                            <td class="p-3 border text-green-600 font-bold">${{ $product->price }}</td>
                            <td class="p-3 border text-blue-500 font-semibold">{{ $product->stock }}</td>
                            <td class="p-3 border">{{ $product->category->name }}</td>
                            <td class="p-3 border">
                                <form action="{{ route('admin.products.delete', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No Products Yet</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</main>

@endsection
