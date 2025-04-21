@extends('layouts.front-office')

@section('title', 'My Wishlist')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/client/cart/addOneToCart.js', 'resources/js/client/cart/removeFromCart.js', 'resources/js/client/wishlist/deleteFromWishlist.js'])
@endsection

@section('content')

    <div class="container mx-auto p-6">
        <div id="book-container" class="bg-gradient-to-b from-gray-50 to-white p-6 rounded-lg shadow-lg border border-gray-200">
            <h2 class="text-2xl font-bold mb-6 text-navy-700 border-b border-teal-200 pb-3">My Wishlist</h2>

            @if ($wishlist)
                @php
                    $cart = \App\Models\Cart::where('client_id', Auth::guard('client')->id())->first();
                @endphp
                @foreach ($wishlist->wishlistBooks as $wishlistBook)
                    <div id="book-{{ $wishlistBook->book->uuid }}"
                        class="border-b border-gray-200 pb-6 mb-6 flex flex-col md:flex-row md:items-center justify-between hover:bg-gray-50 rounded-lg p-3 transition duration-150">
                        <a href="{{ route('books.show', $wishlistBook->book->uuid) }}" class="flex-grow">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/' . $wishlistBook->book->image) }}"
                                    alt="{{ $wishlistBook->book->name }}" class="w-24 h-32 object-cover rounded-md mr-4 shadow-md">
                                <div>
                                    <h3 class="text-lg font-semibold text-navy-800">{{ $wishlistBook->book->name }}</h3>
                                    <p class="text-gray-600">{{ Str::limit($wishlistBook->book->description, 16) }}</p>
                                    <p class="text-teal-600 font-bold">{{ $wishlistBook->book->price }}</p>
                                </div>
                            </div>
                        </a>
                        @php
                            $query = \App\Models\CartBook::where('book_id', $wishlistBook->book->id)->where(
                                'cart_id',
                                $cart->id,
                            );

                            $quantity = $query->exists()
                                ? \App\Models\CartBook::where('book_id', $wishlistBook->book->id)
                                    ->where('cart_id', $cart->id)
                                    ->first()->quantity
                                : 0;
                        @endphp
                        <div id="actions" class="mt-4 md:mt-0">
                            <div class="flex items-center justify-end">
                                <button id="removeFromCartBtn-{{ $wishlistBook->book->uuid }}"
                                    class="w-1/5 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 disabled:from-gray-300 disabled:to-gray-400 text-white font-bold py-2 px-4 rounded-s-lg transition duration-150"
                                    onclick="removeFromCart('{{ $wishlistBook->book->uuid }}')"
                                    {{ $quantity === 1 ? 'disabled' : '' }}>-</button>
                                <input type="text" id="quantity-{{ $wishlistBook->book->uuid }}" name="quantity"
                                    value="{{ $quantity }}" class="w-1/5 text-center p-2 bg-gray-100 text-gray-900 font-medium"
                                    readonly disabled>
                                <button id="addOneToCartBtn-{{ $wishlistBook->book->uuid }}"
                                    class="w-1/5 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 disabled:from-gray-300 disabled:to-gray-400 text-white font-bold py-2 px-4 transition duration-150"
                                    onclick="addOneToCart('{{ $wishlistBook->book->uuid }}', {{ $wishlistBook->book->stock }})">+</button>
                                <button id="toggleWishlistBtn-{{ $wishlistBook->book->uuid }}"
                                    class="w-1/5 bg-gradient-to-r from-navy-600 to-navy-700 hover:from-navy-700 hover:to-navy-800 disabled:from-gray-300 disabled:to-gray-400 text-white font-bold py-2 px-4 rounded-e-lg transition duration-150"
                                    onclick="deleteFromWishlist('{{ $wishlistBook->book->uuid }}')">
                                    <svg class="w-6 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path
                                            d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="py-16 flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        <p class="text-teal-600 text-3xl font-bold text-center mb-2">Your Wishlist Is Empty</p>
                        <p class="text-gray-500">Add books to your wishlist to keep track of items you're interested in</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
