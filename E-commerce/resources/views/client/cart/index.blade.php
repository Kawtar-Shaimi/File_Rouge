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

<div class="container mx-auto px-4 py-8 max-w-7xl">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-2">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Shopping Cart</h1>
            <a href="{{ route('books') }}" class="text-teal-600 hover:text-teal-800 text-sm font-medium flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                Continue Shopping
            </a>
        </div>
        <p class="text-sm text-gray-500">Review your items and proceed to checkout</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2 space-y-5">
            @if ($cart && $cart->cartBooks->count() > 0)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <!-- Cart Items Container -->
                    <div class="divide-y divide-gray-100">
                        @foreach ($cart->cartBooks as $cartBook)
                            <div id="book-{{ $cartBook->book->uuid }}" class="p-6 transition-all duration-200 hover:bg-gray-50">
                                <div class="flex flex-col sm:flex-row items-start sm:items-center">
                                    <!-- Book Image -->
                                    <a href="{{ route('books.show', $cartBook->book->uuid) }}" class="flex-shrink-0 mb-4 sm:mb-0 sm:mr-6">
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $cartBook->book->image) }}" alt="{{ $cartBook->book->name }}" 
                                                class="w-24 h-32 object-cover rounded-lg shadow-sm border border-gray-200">
                                            <div class="absolute -bottom-2 -right-2 bg-teal-500 text-white text-xs font-bold py-1 px-2 rounded-full">
                                                ${{ $cartBook->book->price }}
                                            </div>
                                        </div>
                                    </a>
                                    
                                    <!-- Book Details -->
                                    <div class="flex-grow space-y-1">
                                        <a href="{{ route('books.show', $cartBook->book->uuid) }}" class="block">
                                            <h3 class="text-lg font-bold text-gray-800 hover:text-teal-600 transition-colors">{{ $cartBook->book->name }}</h3>
                                        </a>
                                        <p class="text-sm text-gray-500 leading-relaxed">{{ Str::limit($cartBook->book->description, 120) }}</p>
                                        
                                        <!-- Interactive Elements -->
                                        <div class="flex flex-wrap items-center justify-between mt-4 pt-3 border-t border-gray-100">
                                            <!-- Quantity Controls -->
                                            <div class="flex items-center space-x-1 bg-gray-50 rounded-lg p-1 border border-gray-200">
                                                <button id="removeFromCartBtn-{{ $cartBook->book->uuid }}" 
                                                    class="w-8 h-8 flex items-center justify-center bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 disabled:from-gray-300 disabled:to-gray-400 text-white font-bold rounded-l-md transition-all duration-200" 
                                                    onclick="removeFromCart('{{ $cartBook->book->uuid }}')" 
                                                    {{ $cartBook->quantity === 1 ? "disabled" : "" }}>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                    </svg>
                                                </button>
                                                <input type="text" id="quantity-{{ $cartBook->book->uuid }}" name="quantity" 
                                                    value="{{ $cartBook->quantity }}" 
                                                    class="w-10 h-8 text-center bg-white border-0 font-medium text-gray-700" 
                                                    readonly disabled>
                                                <button id="addOneToCartBtn-{{ $cartBook->book->uuid }}" 
                                                    class="w-8 h-8 flex items-center justify-center bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 disabled:from-gray-300 disabled:to-gray-400 text-white font-bold rounded-r-md transition-all duration-200" 
                                                    onclick="addOneToCart('{{ $cartBook->book->uuid }}', {{ $cartBook->book->stock }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                </button>
                                            </div>
                                            
                                            <!-- Item Subtotal -->
                                            <div class="flex items-center mt-3 sm:mt-0">
                                                <span id="total_book_price_{{ $cartBook->book->uuid }}" class="font-bold text-navy-700 mr-3">
                                                    ${{ number_format($cartBook->book->price * $cartBook->quantity, 2) }}
                                                </span>
                                                <button id="deleteFromCartBtn-{{ $cartBook->book->uuid }}" 
                                                    class="group p-1.5 rounded-full bg-gray-100 hover:bg-red-50 transition-colors duration-200" 
                                                    onclick="deleteFromCart('{{ $cartBook->book->uuid }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-red-500 transition-colors duration-200" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                            </div>
            @else
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Your Cart Is Empty</h3>
                        <p class="text-gray-500 mb-6">Looks like you haven't added any books to your cart yet.</p>
                        <a href="{{ route('books') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                            Browse Books
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1 space-y-5">
            <!-- Order Summary Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-navy-600 to-navy-700 px-6 py-4">
                    <h2 class="text-lg font-bold text-white">Order Summary</h2>
                </div>
                
                <div class="p-6">
                    <!-- Items Summary -->
                    @if ($cart && $cart->cartBooks->count() > 0)
                        <div class="space-y-3 mb-6">
                            @foreach ($cart->cartBooks as $cartBook)
                                <div id="total_book_container_{{ $cartBook->book->uuid }}" class="flex justify-between text-sm">
                                    <span class="text-gray-600">{{ $cartBook->book->name }} (×{{ $cartBook->quantity }})</span>
                                    <span id="total_book_price_{{ $cartBook->book->uuid }}" class="font-medium text-gray-800">
                                        ${{ number_format($cartBook->book->price * $cartBook->quantity, 2) }}
                                    </span>
                    </div>
                @endforeach
                        </div>
                        
                        <!-- Totals -->
                        <div class="border-t border-gray-100 pt-4 space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium text-gray-800">${{ $cart->total_price }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-medium text-gray-800">Free</span>
                            </div>
                            <div class="flex justify-between pt-3 border-t border-gray-100">
                                <span class="text-lg font-bold text-gray-800">Total</span>
                                <span id="total_price" class="text-lg font-bold text-teal-600">${{ $cart->total_price }}</span>
                            </div>
                        </div>
                        
                        <!-- Checkout Button -->
                        <div class="mt-6">
                            <a id="checkout-btn" href="{{ route('client.checkout') }}" 
                                class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-all duration-200">
                                Proceed to Checkout
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <p class="text-gray-500 mb-4">Add books to your cart to see the order summary</p>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-200 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <button class="w-full mt-6 px-6 py-3 bg-gray-200 text-gray-400 font-medium rounded-lg cursor-not-allowed" disabled>
                                Checkout
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Payment Methods Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-sm font-semibold text-gray-600 uppercase tracking-wider mb-4">Accepted Payment Methods</h3>
                <div class="grid grid-cols-4 gap-4">
                    <div class="flex items-center justify-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/PayPal_logo_2014.svg/1024px-PayPal_logo_2014.svg.png" alt="PayPal" class="h-5 object-contain">
                    </div>
                    <div class="flex items-center justify-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Visa_2014_logo.svg/1024px-Visa_2014_logo.svg.png" alt="Visa" class="h-5 object-contain">
                    </div>
                    <div class="flex items-center justify-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e6/Mastercard-logo.svg/1024px-Mastercard-logo.svg.png" alt="Mastercard" class="h-5 object-contain">
                    </div>
                    <div class="flex items-center justify-center p-3 bg-gray-50 rounded-lg border border-gray-100">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/f4/Amex_logo.svg/1024px-Amex_logo.svg.png" alt="American Express" class="h-5 object-contain">
                    </div>
                </div>
                <div class="mt-4 text-xs text-center text-gray-500">All transactions are secure and encrypted</div>
    </div>
        </div>
    </div>
</div>

@endsection