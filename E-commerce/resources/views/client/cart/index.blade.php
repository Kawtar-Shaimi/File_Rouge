@extends('layouts.front-office')

@section('title', 'My Cart')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/client/cart/cartScript.js'
    ])
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Book Container -->
            <div id="book-container" class="lg:col-span-2 bg-white p-8 rounded-xl shadow-xl border-2 border-emerald-500/30">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="p-2 rounded-full bg-emerald-100">
                        <i class="fas fa-shopping-cart text-xl text-emerald-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800">My Cart</h2>
                </div>

                @if ($cart)
                    @foreach ($cart->cartBooks as $cartBook)
                        <div id="book-{{ $cartBook->book->uuid }}" class="border-b border-slate-200 pb-6 mb-6 last:border-0">
                            <div class="flex items-center justify-between">
                                <a href="{{ route('books.show', $cartBook->book->uuid) }}" class="flex items-center space-x-4 hover:opacity-80 transition-opacity">
                                    <img src="{{ asset('storage/' . $cartBook->book->image) }}" 
                                         alt="{{ $cartBook->book->name }}" 
                                         class="w-24 h-24 rounded-lg object-cover shadow-md">
                                    <div>
                                        <h3 class="text-lg font-semibold text-slate-800">{{ $cartBook->book->name }}</h3>
                                        <p class="text-slate-600 text-sm mt-1">{{ Str::limit($cartBook->book->description, 16) }}</p>
                                        <p class="text-emerald-600 font-bold mt-2">${{ number_format($cartBook->book->price, 2) }}</p>
                                    </div>
                                </a>
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center border border-slate-200 rounded-lg overflow-hidden">
                                        <button id="removeFromCartBtn-{{ $cartBook->book->uuid }}" 
                                                class="w-10 h-10 bg-emerald-50 hover:bg-emerald-100 disabled:bg-slate-100 text-emerald-600 flex items-center justify-center transition-colors"
                                                onclick="removeFromCart('{{ $cartBook->book->uuid }}')" 
                                                {{ $cartBook->quantity === 1 ? "disabled" : "" }}>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="text" 
                                               id="quantity-{{ $cartBook->book->uuid }}" 
                                               name="quantity" 
                                               value="{{ $cartBook->quantity }}" 
                                               class="w-12 h-10 text-center bg-white text-slate-800 font-medium focus:outline-none" 
                                               readonly disabled>
                                        <button id="addOneToCartBtn-{{ $cartBook->book->uuid }}" 
                                                class="w-10 h-10 bg-emerald-50 hover:bg-emerald-100 disabled:bg-slate-100 text-emerald-600 flex items-center justify-center transition-colors"
                                                onclick="addOneToCart('{{ $cartBook->book->uuid }}', {{ $cartBook->book->stock }})">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <button id="deleteFromCartBtn-{{ $cartBook->book->uuid }}" 
                                            class="p-2 text-slate-400 hover:text-red-500 transition-colors"
                                            onclick="deleteFromCart('{{ $cartBook->book->uuid }}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="py-12 flex flex-col items-center justify-center space-y-4">
                        <div class="p-4 rounded-full bg-emerald-100">
                            <i class="fas fa-shopping-cart text-4xl text-emerald-600"></i>
                        </div>
                        <p class="text-slate-600 text-xl font-medium">Your Cart Is Empty</p>
                    </div>
                @endif
            </div>

            <!-- Summary -->
            <div class="bg-white p-8 rounded-xl shadow-xl border-2 border-emerald-500/30 h-fit">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="p-2 rounded-full bg-emerald-100">
                        <i class="fas fa-receipt text-xl text-emerald-600"></i>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800">Order Summary</h2>
                </div>

                @if ($cart)
                    <div class="space-y-4 mb-6">
                        @foreach ($cart->cartBooks as $cartBook)
                            <div id="total_book_container_{{ $cartBook->book->uuid }}" class="flex justify-between items-center">
                                <span class="text-slate-600">{{ Str::limit($cartBook->book->name, 20) }}</span>
                                <span id="total_book_price_{{ $cartBook->book->uuid }}" class="text-emerald-600 font-medium">
                                    ${{ number_format($cartBook->book->price * $cartBook->quantity, 2) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-t border-slate-200 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-lg text-slate-800">Total amount:</span>
                            <span id="total_price" class="text-emerald-600 font-bold text-lg">
                                ${{ number_format($cart->total_price, 2) }}
                            </span>
                        </div>
                    </div>
                    <a id="checkout-btn" 
                       href="{{ route('client.checkout') }}" 
                       class="block w-full text-center bg-emerald-600 text-white font-medium py-3 rounded-lg hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-200 transition-all duration-300 flex items-center justify-center space-x-2">
                        <i class="fas fa-lock"></i>
                        <span>Proceed to Checkout</span>
                    </a>
                @else
                    <div class="border-t border-slate-200 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-lg text-slate-800">Total amount:</span>
                            <span class="text-emerald-600 font-bold text-lg">$0.00</span>
                        </div>
                    </div>
                    <button class="w-full bg-slate-200 text-slate-400 font-medium py-3 rounded-lg cursor-not-allowed flex items-center justify-center space-x-2" disabled>
                        <i class="fas fa-lock"></i>
                        <span>Proceed to Checkout</span>
                    </button>
                @endif
            </div>
        </div>

        <!-- Payment Methods -->
        <div class="mt-8 bg-white p-8 rounded-xl shadow-xl border-2 border-emerald-500/30">
            <div class="flex items-center space-x-3 mb-6">
                <div class="p-2 rounded-full bg-emerald-100">
                    <i class="fas fa-credit-card text-xl text-emerald-600"></i>
                </div>
                <h2 class="text-xl font-bold text-slate-800">Accepted Payment Methods</h2>
            </div>
            <div class="flex flex-wrap gap-6 items-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/PayPal_logo_2014.svg/1024px-PayPal_logo_2014.svg.png" 
                     alt="PayPal" 
                     class="h-12 object-contain opacity-80 hover:opacity-100 transition-opacity">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Visa_2014_logo.svg/1024px-Visa_2014_logo.svg.png" 
                     alt="Visa" 
                     class="h-12 object-contain opacity-80 hover:opacity-100 transition-opacity">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e6/Mastercard-logo.svg/1024px-Mastercard-logo.svg.png" 
                     alt="Mastercard" 
                     class="h-12 object-contain opacity-80 hover:opacity-100 transition-opacity">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/Amex_logo.svg/1024px-Amex_logo.svg.png" 
                     alt="American Express" 
                     class="h-12 object-contain opacity-80 hover:opacity-100 transition-opacity">
            </div>
        </div>
    </div>
</div>
@endsection
