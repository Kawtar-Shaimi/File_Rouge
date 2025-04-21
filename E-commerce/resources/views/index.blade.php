@extends('layouts.front-office')

@section('title', 'Home')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/client/cart/addToCart.js', 'resources/js/client/cart/addOneToCart.js', 'resources/js/client/cart/removeFromCart.js', 'resources/js/client/wishlist/addToWishlist.js', 'resources/js/client/wishlist/removeFromWishlist.js', 'resources/js/client/book/searchTerms.js'])
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-900 to-teal-800 text-white py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80')] bg-cover bg-center"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">Discover the World of <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-300 to-blue-200">Books</span></h1>
                <p class="text-lg md:text-xl mb-8 text-teal-100 max-w-2xl mx-auto leading-relaxed">Explore our curated collection and find your next literary adventure. Quality books delivered to your doorstep.</p>
                <a href="{{ route('books') }}" class="inline-block bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white font-semibold py-3 px-8 rounded-lg transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">
                    Explore Collection
                </a>
            </div>
        </div>
        
        <!-- Decorative Elements -->
        <div class="absolute -bottom-6 left-0 w-full h-16 bg-white" style="clip-path: polygon(0 0, 100% 100%, 100% 100%, 0% 100%);"></div>
    </section>

    <!-- Featured Books Section -->
    <div id="books" class="container mx-auto px-6 py-24">
        <div class="flex flex-col items-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-800 relative">
                Our Best Selling Books
                <div class="h-1 w-24 bg-gradient-to-r from-teal-500 to-blue-500 mt-2 mx-auto rounded-full"></div>
            </h2>
            <p class="text-gray-600 text-center max-w-2xl">Discover the most popular titles that readers can't get enough of.</p>
        </div>

        <!-- Search Bar -->
        <div class="w-full max-w-md mx-auto mb-16">
            <div class="relative">
                <input type="text" id="search" class="w-full p-4 pl-12 pr-10 bg-white rounded-lg border border-gray-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" placeholder="Search for a book...">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
            <div class="w-full relative hidden" id="results">
                <div class="absolute bg-white shadow-lg mt-2 w-full z-10 rounded-lg border border-gray-100">
                    <ul id="search-results" class="max-h-60 overflow-y-auto rounded-lg">
                    </ul>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @if ($books->count() > 0)
                @foreach ($books as $book)
                    <div id="book-{{ $book->uuid }}" class="bg-white rounded-xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden group book-card">
                        <a href="{{ route('books.show', $book->uuid) }}" class="block relative">
                            <div class="h-56 overflow-hidden">
                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}"
                                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-6">
                                <div class="flex items-center mb-2">
                                    <span class="px-2 py-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full">Bestseller</span>
                                </div>
                                <h3 class="text-xl font-bold mb-2 text-gray-800 group-hover:text-teal-700 transition-colors">{{ $book->name }}</h3>
                                <p class="text-gray-600 mb-3 text-sm line-clamp-2">{{ Str::limit($book->description, 100) }}</p>
                                <p class="text-xl font-bold text-teal-600">${{ $book->price }}</p>
                            </div>
                        </a>
                        @auth('client')
                            <div class="px-6 pb-6">
                                <div id="actions" class="flex items-center">
                                    @if ($book->isInCart)
                                        <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden flex-1 mr-2">
                                            <button id="removeFromCartBtn-{{ $book->uuid }}"
                                                class="w-10 h-10 bg-gray-100 hover:bg-gray-200 text-gray-700 flex justify-center items-center disabled:opacity-50"
                                                onclick="removeFromCart('{{ $book->uuid }}')"
                                                {{ $book->bookQuantity === 1 ? 'disabled' : '' }}>
                                                <i class="fas fa-minus text-sm"></i>
                                            </button>
                                            <input type="text" id="quantity-{{ $book->uuid }}" name="quantity"
                                                value="{{ $book->bookQuantity }}"
                                                class="w-10 h-10 text-center border-x border-gray-200 bg-white text-gray-700" readonly disabled>
                                            <button id="addOneToCartBtn-{{ $book->uuid }}"
                                                class="w-10 h-10 bg-gray-100 hover:bg-gray-200 text-gray-700 flex justify-center items-center disabled:opacity-50"
                                                onclick="addOneToCart('{{ $book->uuid }}', {{ $book->stock }})">
                                                <i class="fas fa-plus text-sm"></i>
                                            </button>
                                        </div>
                                    @else
                                        <div id="cart-actions" class="flex-1 mr-2">
                                            <div class="flex items-center">
                                                <div class="relative flex-1">
                                                    <input type="number" id="quantity-{{ $book->uuid }}" name="quantity"
                                                        min="1" max="{{ $book->stock }}" value="1"
                                                        class="w-16 h-10 px-2 border border-gray-200 rounded-l-lg text-center bg-white text-gray-700">
                                                </div>
                                                <button
                                                    class="h-10 flex-grow bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white font-medium rounded-r-lg px-4 disabled:opacity-50 disabled:cursor-not-allowed transition-all"
                                                    @if ($book->stock > 0) onclick="addToCart('{{ $book->uuid }}', {{ $book->stock }})" @else disabled @endif>
                                                    <i class="fas fa-shopping-cart mr-1"></i> Add
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($book->isInWishlist)
                                        <button id="toggleWishlistBtn-{{ $book->uuid }}"
                                            class="h-10 w-10 bg-gray-100 hover:bg-gray-200 text-red-500 rounded-lg flex justify-center items-center"
                                            onclick="removeFromWishlist('{{ $book->uuid }}')">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    @else
                                        <button id="toggleWishlistBtn-{{ $book->uuid }}"
                                            class="h-10 w-10 bg-gray-100 hover:bg-gray-200 text-gray-500 hover:text-red-500 rounded-lg flex justify-center items-center transition-colors"
                                            onclick="addToWishlist('{{ $book->uuid }}')">
                                            <i class="far fa-heart"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endauth
                    </div>
                @endforeach
            @else
                <div class="col-span-1 md:col-span-2 lg:col-span-4">
                    <div class="py-16 text-center">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-book-open text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">No Books Available</h3>
                        <p class="text-gray-600">Check back soon for our upcoming collection.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Features Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col items-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-800 relative">
                    Why Choose Us
                    <div class="h-1 w-24 bg-gradient-to-r from-teal-500 to-blue-500 mt-2 mx-auto rounded-full"></div>
                </h2>
                <p class="text-gray-600 text-center max-w-2xl">We're committed to providing the best experience for book lovers.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-white rounded-xl p-8 shadow-md hover:shadow-lg transition-shadow text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-truck text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800">Fast Delivery</h3>
                    <p class="text-gray-600">Your books arrive quickly and safely with our premium shipping options and careful packaging.</p>
                </div>
                
                <div class="bg-white rounded-xl p-8 shadow-md hover:shadow-lg transition-shadow text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-lock text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800">Secure Payments</h3>
                    <p class="text-gray-600">Shop with confidence using our highly secure payment processing system.</p>
                </div>
                
                <div class="bg-white rounded-xl p-8 shadow-md hover:shadow-lg transition-shadow text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-teal-600 to-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-star text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800">Quality Selection</h3>
                    <p class="text-gray-600">We carefully curate our book collection to ensure you receive only the highest quality editions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gradient-to-r from-blue-900 to-teal-800 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-pattern"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col items-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">What Our Clients Say</h2>
                <div class="h-1 w-24 bg-teal-400 mt-2 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                <div class="bg-white/10 backdrop-blur-sm p-8 rounded-xl border border-white/20 shadow-xl">
                    <div class="mb-6">
                        <div class="flex text-teal-300">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-lg italic mb-6">"The book selection is amazing and the delivery was faster than expected. I'm thoroughly impressed with the service and quality!"</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-teal-600 rounded-full flex items-center justify-center font-bold mr-4">AD</div>
                        <div>
                            <h4 class="font-bold">Alice Donovan</h4>
                            <p class="text-sm text-teal-200">Book Enthusiast</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/10 backdrop-blur-sm p-8 rounded-xl border border-white/20 shadow-xl">
                    <div class="mb-6">
                        <div class="flex text-teal-300">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-lg italic mb-6">"I've been a customer for over a year now, and I've never had a bad experience. The website is easy to navigate and the recommendations are spot on!"</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center font-bold mr-4">ML</div>
                        <div>
                            <h4 class="font-bold">Marcus Levi</h4>
                            <p class="text-sm text-teal-200">Avid Reader</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
