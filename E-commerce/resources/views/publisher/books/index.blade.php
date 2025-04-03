@extends('layouts.back-office')

@section('content')

@include('layouts.publisher-sidebar')

<div class="container w-5/6 ms-auto p-6">

    <h2 class="text-3xl font-extrabold mb-6 text-center text-gray-800">📦 Mes Books Publiés</h2>



    <!-- Bouton Ajouter un Book -->
    <div class="text-center my-10">
        <a href="{{ route('publisher.books.create') }}" class="bg-purple-400 border border-black text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-blue-600 transition duration-300 shadow-md">
            ➕ Ajouter un book
        </a>
    </div>

    <!-- Grille des books -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

        @if ($books->count() > 0)
            @foreach ($books as $book)
                <!-- Book -->
                <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}" class="w-full h-48 object-cover rounded-md">
                    <div class="mt-4">
                        <h3 class="text-xl font-semibold">{{ $book->name }}</h3>
                        <p class="text-green-600 font-bold text-lg">{{ $book->price }} $</p>
                        <div class="mt-4 flex justify-between">
                            <a href="{{ route('publisher.books.edit', $book->id) }}" class="text-blue-500 hover:bg-blue-100 p-2 rounded-lg transition duration-300">
                                ✏️ Modifier
                            </a>
                            <form action="{{ route('publisher.books.delete', $book->id) }}" method="POST">
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
            <!-- Message si aucun book -->
            <p class="col-span-1 sm:col-span-2 md:col-span-3 text-center text-red-500 mt-6 text-3xl font-bold">Aucun book publié pour le moment.</p>
        @endif

    </div>

</div>

@endsection
