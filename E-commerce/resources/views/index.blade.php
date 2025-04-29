@extends('layouts.front-office')

@section('title', 'Home')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/client/cart/addToCart.js', 'resources/js/client/cart/addOneToCart.js', 'resources/js/client/cart/removeFromCart.js', 'resources/js/client/wishlist/addToWishlist.js', 'resources/js/client/wishlist/removeFromWishlist.js', 'resources/js/client/book/searchTerms.js'])
@endsection

@section('content')
    <!-- Hero Section with Modern Design -->
    <section class="relative py-24 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 bg-gradient-to-br from-teal-400 via-green-400 to-teal-500 opacity-90"></div>
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="absolute bottom-0 left-0 w-full h-24 bg-white" style="clip-path: polygon(0 100%, 100% 100%, 100% 0);"></div>
        
        <!-- Decorative Elements -->
        <div class="absolute top-20 right-10 w-64 h-64 bg-green-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-40 left-10 w-72 h-72 bg-teal-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 text-center md:text-left text-white">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                        Discover Your <span class="text-green-100">Next Great</span> Read
                    </h1>
                    <p class="text-lg md:text-xl mb-8 text-white max-w-lg">
                        Immerse yourself in our vast collection of carefully curated books spanning every genre imaginable.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <a href="{{ route('books') }}" 
                           class="px-8 py-3 bg-white text-teal-500 rounded-full font-semibold text-lg shadow-lg transform transition hover:scale-105 hover:shadow-xl">
                            <i class="fas fa-shopping-bag mr-2"></i>Shop Now
                        </a>
                        <a href="#books" 
                           class="px-8 py-3 bg-transparent border-2 border-white text-white rounded-full font-semibold text-lg hover:bg-white/10 transition">
                            <i class="fas fa-arrow-down mr-2"></i>Explore
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 mt-12 md:mt-0">
                    <div class="relative">
                        <img src="{{ asset('images/hero-books.png') }}" alt="Book Collection" class="mx-auto rounded-lg shadow-2xl transform -rotate-3 relative z-10" onerror="this.src='https://images.unsplash.com/photo-1495446815901-a7297e633e8d?q=80&w=2070'">
                        <div class="absolute inset-0 bg-gradient-to-tr from-green-400 to-teal-400 rounded-lg transform rotate-3 -z-0 blur-sm"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Books Section -->
    <section id="books" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold relative inline-block">
                    <span class="relative z-10">Bestselling Books</span>
                    <span class="absolute -bottom-3 left-0 w-full h-1 bg-gradient-to-r from-green-400 to-teal-400 rounded-full"></span>
                </h2>
                <p class="text-gray-600 mt-6 max-w-2xl mx-auto">Discover the books that readers can't put down, from thrilling mysteries to heartwarming romances.</p>
            </div>

            <!-- Search Bar -->
            <div class="max-w-md mx-auto mb-12">
                <div class="relative">
                    <input type="text" id="search" 
                           class="w-full px-5 py-4 bg-white rounded-full border-none shadow-lg focus:ring-2 focus:ring-teal-400 transition-all"
                           placeholder="Search for a book...">
                    <span class="absolute right-4 top-4 text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <div class="w-full relative hidden" id="results">
                        <div class="absolute bg-white shadow-2xl mt-2 w-full z-10 rounded-lg border border-gray-100">
                            <ul id="search-results" class="max-h-60 overflow-y-auto rounded-lg divide-y divide-gray-100"></ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Books Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @if ($books->count() > 0)
                    @foreach ($books as $book)
                        <div id="book-{{ $book->uuid }}" class="bg-white rounded-xl shadow-lg overflow-hidden transition-all hover:shadow-2xl hover:-translate-y-1 group">
                            <a href="{{ route('books.show', $book->uuid) }}" class="block">
                                <div class="relative h-60 overflow-hidden">
                                    <img src="@bookImage($book->image)" alt="{{ $book->name }}"
                                         class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    
                                    <!-- View Book Button Overlay -->
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <span class="text-white text-lg font-medium">
                                            View Book
                                        </span>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <h3 class="text-xl font-bold mb-2 text-gray-800 group-hover:text-teal-500 transition-colors">{{ $book->name }}</h3>
                                    <p class="text-gray-600 mb-3 text-sm">{{ Str::limit($book->description, 60) }}</p>
                                    <div class="flex justify-between items-center">
                                        <p class="text-lg font-bold text-teal-500">${{ $book->price }}</p>
                                        <span class="text-xs text-gray-500">{{ $book->stock > 0 ? 'In Stock' : 'Out of Stock' }}</span>
                                    </div>
                                </div>
                            </a>
                            @auth('client')
                                <div class="px-5 pb-5 pt-0">
                                    <div id="actions" class="flex items-end space-x-1">
                                        @if ($book->isInCart)
                                            <div class="flex w-3/4 border border-gray-200 rounded-lg overflow-hidden">
                                                <button id="removeFromCartBtn-{{ $book->uuid }}"
                                                    class="w-1/4 bg-green-50 hover:bg-green-100 text-teal-600 font-bold py-2 px-0"
                                                    onclick="removeFromCart('{{ $book->uuid }}')"
                                                    {{ $book->bookQuantity === 1 ? 'disabled' : '' }}>
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="text" id="quantity-{{ $book->uuid }}" name="quantity"
                                                    value="{{ $book->bookQuantity }}"
                                                    class="w-2/4 text-center p-2 bg-white text-gray-900 border-x border-gray-200" readonly disabled>
                                                <button id="addOneToCartBtn-{{ $book->uuid }}"
                                                    class="w-1/4 bg-green-50 hover:bg-green-100 text-teal-600 font-bold py-2 px-0"
                                                    onclick="addOneToCart('{{ $book->uuid }}', {{ $book->stock }})">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        @else
                                            <div id="cart-actions" class="w-3/4">
                                                <div class="flex rounded-lg overflow-hidden">
                                                    <input type="number" id="quantity-{{ $book->uuid }}" name="quantity"
                                                        min="1" max="{{ $book->stock }}" value="1"
                                                        class="w-1/3 p-2 bg-white text-gray-900 border border-r-0 border-gray-200 rounded-l-lg">
                                                    <button
                                                        class="w-2/3 bg-gradient-to-r from-green-400 to-teal-500 hover:from-green-500 hover:to-teal-600 text-white font-medium py-2 px-3 rounded-r-lg flex items-center justify-center disabled:from-gray-400 disabled:to-gray-500"
                                                        @if ($book->stock > 0) onclick="addToCart('{{ $book->uuid }}', {{ $book->stock }})" @else disabled @endif>
                                                        <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        <button id="toggleWishlistBtn-{{ $book->uuid }}"
                                            class="w-1/4 bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 font-bold py-2 px-0 rounded-lg"
                                            onclick="{{ $book->isInWishlist ? "removeFromWishlist('".$book->uuid."')" : "addToWishlist('".$book->uuid."')" }}">
                                            <svg class="w-5 h-5 mx-auto {{ $book->isInWishlist ? 'fill-red-500' : 'fill-gray-400' }}" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 512 512">
                                                <path
                                                    d="{{ $book->isInWishlist ? 'M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z' : 'M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8l0-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5l0 3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20-.1-.1s0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5l0 3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2l0-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z' }}" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endauth
                        </div>
                    @endforeach
                @else
                    <div class="col-span-1 sm:col-span-2 lg:col-span-4 py-20">
                        <div class="text-center">
                            <i class="fas fa-book-open text-6xl text-gray-300 mb-4"></i>
                            <p class="text-2xl font-semibold text-gray-400">No books available at the moment</p>
                            <p class="text-gray-500 mt-2">Check back later for our upcoming collection</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold relative inline-block">
                    <span class="relative z-10">Why Choose Us</span>
                    <span class="absolute -bottom-3 left-0 w-full h-1 bg-gradient-to-r from-green-400 to-teal-400 rounded-full"></span>
                </h2>
                <p class="text-gray-600 mt-6 max-w-2xl mx-auto">We're dedicated to providing the best book shopping experience possible.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-gray-50 rounded-2xl p-8 text-center shadow-lg transform transition hover:-translate-y-2 hover:shadow-xl">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-teal-400 to-green-400 text-white mb-6">
                        <i class="fas fa-truck text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800">Fast Delivery</h3>
                    <p class="text-gray-600">Get your books delivered to your doorstep quickly and safely. We offer express shipping options.</p>
                </div>
                
                <div class="bg-gray-50 rounded-2xl p-8 text-center shadow-lg transform transition hover:-translate-y-2 hover:shadow-xl">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-teal-400 to-green-400 text-white mb-6">
                        <i class="fas fa-lock text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800">Secure Payments</h3>
                    <p class="text-gray-600">Shop with confidence using our secure payment methods. Your financial information is always protected.</p>
                </div>
                
                <div class="bg-gray-50 rounded-2xl p-8 text-center shadow-lg transform transition hover:-translate-y-2 hover:shadow-xl">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-teal-400 to-green-400 text-white mb-6">
                        <i class="fas fa-star text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-800">Quality Books</h3>
                    <p class="text-gray-600">We carefully curate our selection to ensure you receive only the highest quality books from trusted publishers.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gradient-to-br from-teal-500 to-green-500 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="absolute top-20 right-20 w-64 h-64 bg-teal-300 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>
        <div class="absolute bottom-20 left-20 w-64 h-64 bg-green-300 rounded-full mix-blend-multiply filter blur-3xl opacity-10"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">What Our Readers Say</h2>
                <p class="text-white max-w-2xl mx-auto">Don't just take our word for it - hear from our satisfied customers.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white/10 backdrop-blur-sm p-8 rounded-xl border border-white/20 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-300 flex">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-lg mb-6">"The selection of books is incredible! I found titles I couldn't find anywhere else. Fast shipping and excellent packaging too."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full bg-teal-300 flex items-center justify-center text-xl font-bold mr-3">A</div>
                        <div>
                            <h4 class="font-bold">Alice D.</h4>
                            <p class="text-white text-sm">Book Lover</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/10 backdrop-blur-sm p-8 rounded-xl border border-white/20 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-300 flex">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <p class="text-lg mb-6">"Customer service is top-notch. They helped me track down a rare edition I've been searching for years. Highly recommend!"</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full bg-green-300 flex items-center justify-center text-xl font-bold mr-3">M</div>
                        <div>
                            <h4 class="font-bold">Marc L.</h4>
                            <p class="text-white text-sm">Collector</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white/10 backdrop-blur-sm p-8 rounded-xl border border-white/20 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-300 flex">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-lg mb-6">"I love how easy it is to find new authors and genres to explore. The recommendations are always spot on for my taste."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full bg-teal-300 flex items-center justify-center text-xl font-bold mr-3">J</div>
                        <div>
                            <h4 class="font-bold">James R.</h4>
                            <p class="text-white text-sm">Avid Reader</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-8 md:p-12">
                <div class="text-center">
                    <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
                    <p class="text-gray-600 mb-6">Subscribe to our newsletter for the latest releases, reading recommendations, and exclusive offers.</p>
                    <div class="flex flex-col sm:flex-row sm:items-center justify-center gap-3">
                        <input type="email" placeholder="Your email address" class="flex-grow px-5 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-400 transition-all">
                        <button class="px-6 py-3 bg-gradient-to-r from-green-400 to-teal-500 text-white font-semibold rounded-lg shadow hover:from-green-500 hover:to-teal-600 transition-all whitespace-nowrap">
                            <i class="fas fa-paper-plane mr-2"></i>Subscribe
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }
    </style>
@endsection
