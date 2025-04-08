@extends('layouts.front-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/client/cart/addOneToCart.js',
        'resources/js/client/cart/removeFromCart.js',
        'resources/js/client/wishlist/deleteFromWishlist.js'
    ])
@endsection

@section('content')

<div class="container mx-auto p-6">
    <div id="book-container" class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Ma Wishlist</h2>

        @if ($wishlist)
            @php
                $cart = \App\Models\Cart::where('client_id' , Auth::guard('client')->id())->first();
            @endphp
            @foreach ( $wishlist->wishlistBooks as $wishlistBook)
                <div id="book-{{ $wishlistBook->book->uuid }}" class="border-b pb-4 mb-4 flex items-center justify-between">
                    <a href="{{ route('books.show', $wishlistBook->book->uuid) }}">
                        <div class="flex items-center">
                            <img src="{{ asset('storage/' . $wishlistBook->book->image) }}" alt="{{ $wishlistBook->book->name }}" class="w-24 h-24 rounded-md mr-4">
                            <div>
                                <h3 class="text-lg font-semibold">{{ $wishlistBook->book->name }}</h3>
                                <p class="text-gray-600">{{ Str::limit($wishlistBook->book->description, 16) }}</p>
                                <p class="text-green-500 font-bold">{{ $wishlistBook->book->price }}</p>
                            </div>
                        </div>
                    </a>
                    @php
                        $query = \App\Models\CartBook::where('book_id',$wishlistBook->book->id)
                        ->where('cart_id',$cart->id);

                        $quantity =  $query->exists() ?
                            \App\Models\CartBook::where('book_id',$wishlistBook->book->id)
                            ->where('cart_id',$cart->id)
                            ->first()->quantity
                            : 0;
                    @endphp
                    <div id="actions">
                        <div class="mt-4 flex items-center justify-end">
                            <button id="removeFromCartBtn-{{ $wishlistBook->book->uuid }}" class="w-1/5 bg-blue-500 hover:bg-blue-600 disabled:bg-blue-300 text-white font-bold py-2 px-4 rounded-s-lg" onclick="removeFromCart('{{ $wishlistBook->book->uuid }}')" {{ $quantity === 1 ? "disabled" : "" }}>-</button>
                            <input type="text" id="quantity-{{ $wishlistBook->book->uuid }}" name="quantity" value="{{ $quantity }}" class="w-1/5 text-center p-2 bg-gray-100 text-gray-900" readonly disabled>
                            <button id="addOneToCartBtn-{{ $wishlistBook->book->uuid }}" class="w-1/5 bg-blue-500 hover:bg-blue-600 disabled:bg-blue-300 text-white font-bold py-2 px-4" onclick="addOneToCart('{{ $wishlistBook->book->uuid }}', {{ $wishlistBook->book->stock }})">+</button>
                            <button id="toggleWishlistBtn-{{ $wishlistBook->book->uuid }}" class="w-1/5 bg-blue-500 hover:bg-blue-600 disabled:bg-blue-300 text-white font-bold py-2 px-4 rounded-e-lg border-s border-black" onclick="deleteFromWishlist('{{ $wishlistBook->book->uuid }}')">
                                <svg class="w-6 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="py-10 flex items-center justify-center">
                <p class="text-red-500 text-4xl font-bold text-center">Your Wishlist Is Empty</p>
            </div>
        @endif
    </div>
</div>

@endsection
