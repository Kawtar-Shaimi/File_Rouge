@extends('layouts.front-office')

@section('title', 'My Wishlist')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/client/cart/addOneToCart.js', 'resources/js/client/cart/removeFromCart.js', 'resources/js/client/wishlist/deleteFromWishlist.js'])
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div id="book-container" class="bg-white p-8 rounded-xl shadow-xl border-2 border-emerald-500/30">
            <div class="flex items-center space-x-3 mb-6">
                <div class="p-2 rounded-full bg-emerald-100">
                    <i class="fas fa-heart text-xl text-emerald-600"></i>
                </div>
                <h2 class="text-2xl font-bold text-slate-800">My Wishlist</h2>
            </div>

            @if ($wishlist)
                @php
                    $cart = \App\Models\Cart::where('client_id', Auth::guard('client')->id())->first();
                @endphp
                @foreach ($wishlist->wishlistBooks as $wishlistBook)
                    <div id="book-{{ $wishlistBook->book->uuid }}" class="border-b border-slate-200 pb-6 mb-6 last:border-0">
                        <div class="flex items-center justify-between">
                            <a href="{{ route('books.show', $wishlistBook->book->uuid) }}" class="flex items-center space-x-4 hover:opacity-80 transition-opacity">
                                <img src="{{ asset('storage/' . $wishlistBook->book->image) }}" 
                                     alt="{{ $wishlistBook->book->name }}" 
                                     class="w-24 h-24 rounded-lg object-cover shadow-md">
                                <div>
                                    <h3 class="text-lg font-semibold text-slate-800">{{ $wishlistBook->book->name }}</h3>
                                    <p class="text-slate-600 text-sm mt-1">{{ Str::limit($wishlistBook->book->description, 16) }}</p>
                                    <p class="text-emerald-600 font-bold mt-2">${{ number_format($wishlistBook->book->price, 2) }}</p>
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
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center border border-slate-200 rounded-lg overflow-hidden">
                                    <button id="removeFromCartBtn-{{ $wishlistBook->book->uuid }}" 
                                            class="w-10 h-10 bg-emerald-50 hover:bg-emerald-100 disabled:bg-slate-100 text-emerald-600 flex items-center justify-center transition-colors"
                                            onclick="removeFromCart('{{ $wishlistBook->book->uuid }}')" 
                                            {{ $quantity === 1 ? 'disabled' : '' }}>
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="text" 
                                           id="quantity-{{ $wishlistBook->book->uuid }}" 
                                           name="quantity" 
                                           value="{{ $quantity }}" 
                                           class="w-12 h-10 text-center bg-white text-slate-800 font-medium focus:outline-none" 
                                           readonly disabled>
                                    <button id="addOneToCartBtn-{{ $wishlistBook->book->uuid }}" 
                                            class="w-10 h-10 bg-emerald-50 hover:bg-emerald-100 disabled:bg-slate-100 text-emerald-600 flex items-center justify-center transition-colors"
                                            onclick="addOneToCart('{{ $wishlistBook->book->uuid }}', {{ $wishlistBook->book->stock }})">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <button id="toggleWishlistBtn-{{ $wishlistBook->book->uuid }}" 
                                        class="p-2 text-slate-400 hover:text-red-500 transition-colors"
                                        onclick="deleteFromWishlist('{{ $wishlistBook->book->uuid }}')">
                                    <i class="fas fa-heart text-xl"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="py-12 flex flex-col items-center justify-center space-y-4">
                    <div class="p-4 rounded-full bg-emerald-100">
                        <i class="fas fa-heart text-4xl text-emerald-600"></i>
                    </div>
                    <p class="text-slate-600 text-xl font-medium">Your Wishlist Is Empty</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
