@extends('layouts.front-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/cartScript.js'
    ])
@endsection

@section('content')

<div class="container mx-auto p-6">
    <div class="grid grid-cols-3 gap-6">
        <!-- Section Panier -->
        <div id="book-container" class="col-span-2 bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Mon Panier</h2>
            @if ($cart)
                @foreach ( $cart->cartBooks as $cartBook)
                    <div id="book-{{ $cartBook->book->id }}" class="border-b pb-4 mb-4 flex items-center justify-between">
                        <a href="{{ route('books.show', $cartBook->book) }}">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/' . $cartBook->book->image) }}" alt="{{ $cartBook->book->name }}" class="w-24 h-24 rounded-md mr-4">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $cartBook->book->name }}</h3>
                                    <p class="text-gray-600">{{ Str::limit($cartBook->book->description, 16) }}</p>
                                    <p class="text-green-500 font-bold">{{ $cartBook->book->price }}</p>
                                </div>
                            </div>
                        </a>
                        <div id="actions">
                            <div class="mt-4 flex items-center justify-end">
                                <button id="removeFromCartBtn-{{ $cartBook->book->id }}" class="w-1/5 bg-blue-500 hover:bg-blue-600 disabled:bg-blue-300 text-white font-bold py-2 px-4 rounded-s-lg" onclick="removeFromCart({{ $cartBook->book->id }})" {{ $cartBook->quantity === 1 ? "disabled" : "" }}>-</button>
                                <input type="text" id="quantity-{{ $cartBook->book->id }}" name="quantity" value="{{ $cartBook->quantity }}" class="w-1/5 text-center p-2 bg-gray-100 text-gray-900" readonly disabled>
                                <button id="addOneToCartBtn-{{ $cartBook->book->id }}" class="w-1/5 bg-blue-500 hover:bg-blue-600 disabled:bg-blue-300 text-white font-bold py-2 px-4 rounded-e-lg" onclick="addOneToCart({{ $cartBook->book->id }}, {{ $cartBook->book->stock }})">+</button>
                                <button id="deleteFromCartBtn-{{ $cartBook->book->id }}" class="text-red-500 ml-4" onclick="deleteFromCart({{ $cartBook->book->id }})">🗑</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="py-10 flex items-center justify-center">
                    <p class="text-red-500 text-4xl font-bold text-center">Your Cart Is Empty</p>
                </div>
            @endif

        </div>

        <!-- Récapitulatif -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Récapitulatif</h2>
            @if ($cart)
                @foreach ( $cart->cartBooks as $cartBook)
                    <div id="total_book_container_{{ $cartBook->book->id }}" class="flex justify-between mb-2">
                        <span>{{ $cartBook->book->name }}:</span>
                        <span id="total_book_price_{{ $cartBook->book->id }}" class="text-green-500">${{ number_format($cartBook->book->price * $cartBook->quantity, 2) }}</span>
                    </div>
                @endforeach
                <div class="flex justify-between font-bold text-lg">
                    <span>Total à payer:</span>
                    <span id="total_price">${{ $cart->total_price }}</span>
                </div>
            @else
                <div class="flex justify-between font-bold text-lg">
                    <span>Total à payer:</span>
                    <span>$0</span>
                </div>
            @endif
            @if ($cart)
                <a id="checkout-btn" href="{{ route('client.checkout') }}" class="block w-full text-center bg-purple-500 text-white font-bold py-3 mt-4 rounded-lg hover:bg-blue-600 disabled:bg-purple-300">Passer la commande</a>
            @else
                <button class="w-full bg-purple-500 text-white font-bold py-3 mt-4 rounded-lg disabled:bg-purple-300" disabled > Passer la commande</button>
            @endif
        </div>
    </div>

    <!-- Cartes bancaires -->
    <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold mb-4">Voilà les cartes bancaires que nous acceptons</h2>
        <div class="flex space-x-6">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/PayPal_logo_2014.svg/1024px-PayPal_logo_2014.svg.png" alt="PayPal" class="w-24 h-24">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Visa_2014_logo.svg/1024px-Visa_2014_logo.svg.png" alt="Visa" class="w-24 h-24">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e6/Mastercard-logo.svg/1024px-Mastercard-logo.svg.png" alt="Mastercard" class="w-24 h-24">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/Amex_logo.svg/1024px-Amex_logo.svg.png" alt="American Express" class="w-24 h-24">
        </div>
    </div>
</div>

@endsection
