@extends('layouts.app')

@section('content')

@include('layouts.publisher-sidebar')

<div class="container w-5/6 ms-auto p-6">

    <h2 class="text-3xl font-extrabold mb-6 text-center text-gray-800">📦 Mes Produits Publiés</h2>

    @if (session()->has('success'))
        <x-alert type="success" :message="session('success')" />
    @elseif (session()->has('error'))
        <x-alert type="error" :message="session('error')" />
    @endif

    <!-- Bouton Ajouter un Produit -->
    <div class="text-center my-10">
        <a href="{{ route('publisher.products.create') }}" class="bg-purple-400 border border-black text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-blue-600 transition duration-300 shadow-md">
            ➕ Ajouter un produit
        </a>
    </div>

    <!-- Grille des produits -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

        @if ($products->count() > 0)
            @foreach ($products as $product)
                <!-- Produit -->
                <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md">
                    <div class="mt-4">
                        <h3 class="text-xl font-semibold">{{ $product->name }}</h3>
                        <p class="text-green-600 font-bold text-lg">{{ $product->price }} $</p>
                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('publisher.products.edit', $product->id) }}" class="text-blue-500 hover:bg-blue-100 p-2 rounded-lg transition duration-300">
                                ✏️ Modifier
                            </a>
                            <form action="{{ route('publisher.products.delete', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:bg-red-100 p-2 rounded-lg transition duration-300">
                                    🗑️ Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <!-- Message si aucun produit -->
            <p class="col-span-1 sm:col-span-2 md:col-span-3 text-center text-red-500 mt-6 text-3xl font-bold">Aucun produit publié pour le moment.</p>
        @endif

    </div>

</div>

@endsection
