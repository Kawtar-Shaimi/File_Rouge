@extends('layouts.front-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/addToCart.js',
        'resources/js/addOneToCart.js',
        'resources/js/removeFromCart.js',
        'resources/js/addToWishlist.js',
        'resources/js/removeFromWishlist.js'
    ])
@endsection

@section('content')
<!-- Bannière Hero -->
<section class="hero text-white text-center py-20">
    <div class="container mx-auto px-4">
        <h1 class="text-5xl font-bold mb-4">Découvrez nos meilleurs books</h1>
        <p class="text-lg mb-6">Profitez de nos offres exceptionnelles et achetez en toute simplicité.</p>
        <a href="{{ route('books') }}" class="bg-white text-blue-600 font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-gray-200">Voir les books</a>
    </div>
</section>

<!-- Section Books Populaires -->
<div id="books" class="container mx-auto px-4 py-16">
    <h2 class="text-4xl font-bold text-center mb-12 text-blue-600">Nos Meilleurs Books</h2>

    <!-- Filter Bar -->
    <div class="w-1/3 mb-6">
        <input type="text" id="search" class="w-full p-2 bg-white rounded-lg border border-gray-300" placeholder="Rechercher un book...">
        <div class="w-full relative hidden" id="results">
            <div class="absolute bg-white shadow-lg shadow-gray-400 mt-2 w-full z-10">
                <ul id="search-results" class="max-h-60 overflow-y-auto">
                </ul>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

        @if ($books->count() > 0)
            @foreach ($books as $book)
                <div id="book-{{ $book->id }}" class="bg-white rounded-lg shadow-lg p-6 book-card">
                    <a href="{{ route('books.show', $book) }}">
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}" class="rounded-md mb-4 w-full h-48 object-cover">
                        <h3 class="text-xl font-bold mb-2 text-blue-600">{{ $book->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($book->description, 15) }}</p>
                        <p class="text-lg font-semibold text-green-500">${{ $book->price }}</p>
                    </a>
                    @auth('client')
                        <div >
                            <div id="actions" class="mt-4 flex items-end">
                                @if ($book->isInCart)
                                    <button id="removeFromCartBtn-{{ $book->id }}" class="w-1/5 bg-blue-500 hover:bg-blue-600 disabled:bg-blue-300 text-white font-bold py-2 px-4 rounded-s-lg" onclick="removeFromCart({{ $book->id }})" {{ $book->bookQuantity === 1 ? "disabled" : "" }}>-</button>
                                    <input type="text" id="quantity-{{ $book->id }}" name="quantity" value="{{ $book->bookQuantity }}" class="w-3/5 text-center p-2 bg-gray-100 text-gray-900" readonly disabled>
                                    <button id="addOneToCartBtn-{{ $book->id }}" class="w-1/5 bg-blue-500 hover:bg-blue-600 disabled:bg-blue-300 text-white font-bold py-2 px-4" onclick="addOneToCart({{ $book->id }}, {{ $book->stock }})">+</button>
                                @else
                                    <div id="cart-actions" class="w-4/5">
                                        <label for="quantity-{{ $book->id }}" class="text-gray-600 block mr-2">Quantité:</label>
                                        <div class="w-full flex">
                                            <input type="number" id="quantity-{{ $book->id }}" name="quantity" min="1" max="{{ $book->stock }}" value="1" class="w-1/5 p-2 bg-gray-100 text-gray-900 rounded-s-lg">
                                            <button class="w-4/5 bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 disabled:bg-purple-300" @if ($book->stock > 0) onclick="addToCart({{ $book->id }}, {{ $book->stock }})" @else disabled @endif>Add to cart</button>
                                        </div>
                                    </div>
                                @endif
                                @if ($book->isInWishlist)
                                    <button id="toggleWishlistBtn-{{ $book->id }}" class="w-1/5 bg-blue-500 hover:bg-blue-600 disabled:bg-blue-300 text-white font-bold py-2 px-4 rounded-e-lg border-s border-black" onclick="removeFromWishlist({{ $book->id }})">
                                        <svg class="w-6 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
                                    </button>
                                @else
                                    <button id="toggleWishlistBtn-{{ $book->id }}" class="w-1/5 bg-blue-500 hover:bg-blue-600 disabled:bg-blue-300 text-white font-bold py-2 px-4 rounded-e-lg border-s border-black" onclick="addToWishlist({{ $book->id }})">
                                        <svg class="w-6 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8l0-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5l0 3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20-.1-.1s0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5l0 3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2l0-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"/></svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endauth
                </div>
            @endforeach
        @else
            <div class="col-span-1 md:col-span-2 lg:col-span-4">
                <p class="text-red-500 text-4xl font-bold text-center py-32">No Book Yet</p>
            </div>
        @endif

    </div>
</div>

<!-- Pourquoi nous choisir -->
<section class="bg-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-8 text-blue-600">Pourquoi nous choisir ?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6 bg-gray-100 rounded-lg shadow-lg">
                <i class="fas fa-truck text-blue-600 text-4xl mb-4"></i>
                <h3 class="text-xl font-bold mb-2">Livraison rapide</h3>
                <p class="text-gray-600">Recevez vos commandes en un temps record.</p>
            </div>
            <div class="p-6 bg-gray-100 rounded-lg shadow-lg">
                <i class="fas fa-lock text-blue-600 text-4xl mb-4"></i>
                <h3 class="text-xl font-bold mb-2">Paiement sécurisé</h3>
                <p class="text-gray-600">Transactions sécurisées et protection des données.</p>
            </div>
            <div class="p-6 bg-gray-100 rounded-lg shadow-lg">
                <i class="fas fa-star text-blue-600 text-4xl mb-4"></i>
                <h3 class="text-xl font-bold mb-2">Qualité garantie</h3>
                <p class="text-gray-600">Des books de qualité sélectionnés avec soin.</p>
            </div>
        </div>
    </div>
</section>

<!-- Témoignages Clients -->
<section class="bg-gray-900 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold mb-8">Ce que disent nos clients</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <p class="text-lg italic">"Super service ! Livraison rapide et books de qualité."</p>
                <h4 class="mt-4 font-bold">- Alice D.</h4>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <p class="text-lg italic">"Je recommande à 100%. Meilleure expérience d'achat en ligne."</p>
                <h4 class="mt-4 font-bold">- Marc L.</h4>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        $('#search').on('input', function() {
            var query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: '/client/filter/searchTerms',
                    method: 'GET',
                    data: { query },
                    success: function(res) {
                        $('#search-results').empty();
                        if (res.data.searchTerms.length === 0) {
                            $('#search-results').append('<li class="py-2 px-4 text-gray-500">Aucun résultat trouvé</li>');
                        } else {
                            $.each(res.data.searchTerms, function(index, searchTerm) {
                                $('#search-results').append(`<li><a class="block py-2 px-4 border-b border-gray-200 hover:bg-gray-100" href="/books?query=${searchTerm}">${searchTerm}</a></li>`);
                            });
                        }
                        $('#results').removeClass('hidden');
                    }
                });
            } else {
                $('#search-results').empty();
                $('#results').addClass('hidden');
            }
        });
    })
</script>

@endsection
