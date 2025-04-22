@extends('layouts.front-office')

@section('title', 'Book Details')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/client/cart/addToCart.js', 'resources/js/client/cart/addOneToCart.js', 'resources/js/client/cart/removeFromCart.js', 'resources/js/client/wishlist/addToWishlist.js', 'resources/js/client/wishlist/removeFromWishlist.js', 'resources/js/client/reviews/bookReviewScript.js'])
@endsection

@section('content')
    

    <!-- Book Details Main Content -->
    <div class="container mx-auto px-4 py-12 max-w-6xl">
        <!-- Title Section - Clean and Simple -->
        
        
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="flex flex-col lg:flex-row">
                <!-- Left Column - Book Image with Decorative Elements -->
                <div class="w-full lg:w-2/5 relative">
                    <div class="aspect-[3/4] relative overflow-hidden">
                        <!-- Main Image -->
                        <div class="absolute inset-0 z-10">
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}" class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Book Status Badge -->
                        @if ($book->stock > 0)
                            <div class="absolute top-4 left-0 bg-green-500 text-white text-xs uppercase font-bold py-2 px-4 rounded-r-full shadow-md z-20">
                                In Stock
                            </div>
                        @else
                            <div class="absolute top-4 left-0 bg-red-500 text-white text-xs uppercase font-bold py-2 px-4 rounded-r-full shadow-md z-20">
                                Out of Stock
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Right Column - Book Details -->
                <div class="w-full lg:w-3/5 p-8 lg:p-12 flex flex-col">
                    <!-- Book Category -->
                    <div class="mb-6">
                        <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">
                            Fiction
                        </span>
                    </div>
                    
                    <!-- Book Description (moved from the title) -->
                    <p class="text-gray-600 leading-relaxed mb-8">{{ $book->description }}</p>
                    
                    <!-- Book Details -->
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-500">Author</span>
                            <span class="font-medium text-gray-800">Author Name</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-500">Publisher</span>
                            <span class="font-medium text-gray-800">Publisher Name</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-500">Language</span>
                            <span class="font-medium text-gray-800">English</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-500">Pages</span>
                            <span class="font-medium text-gray-800">320</span>
                        </div>
                    </div>
                    
                    <!-- Pricing & Stock -->
                    <div class="mb-8">
                        <div class="flex items-baseline">
                            <span class="text-3xl font-bold text-gray-800">${{ $book->price }}</span>
                            @if (isset($book->original_price))
                                <span class="ml-3 text-lg text-gray-400 line-through">${{ $book->original_price }}</span>
                            @endif
                            @if ($book->stock > 0)
                                <span class="ml-4 text-sm text-green-600 font-medium">{{ $book->stock }} copies available</span>
                            @else
                                <span class="ml-4 text-sm text-red-600 font-medium">Currently unavailable</span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    @auth('client')
                        <div class="mt-auto">
                            <div id="actions" class="flex flex-wrap gap-4">
                                @if ($book->isInCart)
                                    <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden shadow-sm flex-grow">
                                        <button id="removeFromCartBtn-{{ $book->uuid }}"
                                            class="flex-none w-12 h-12 flex items-center justify-center bg-gradient-to-r from-teal-500 to-teal-600 text-white text-xl font-bold hover:from-teal-600 hover:to-teal-700 disabled:opacity-50 transition-all duration-200"
                                            onclick="removeFromCart('{{ $book->uuid }}')"
                                            {{ $book->bookQuantity === 1 ? 'disabled' : '' }}>−</button>
                                        <input type="text" id="quantity-{{ $book->uuid }}" name="quantity"
                                            value="{{ $book->bookQuantity }}"
                                            class="flex-grow h-12 text-center bg-white text-gray-800 border-0" readonly disabled>
                                        <button id="addOneToCartBtn-{{ $book->uuid }}"
                                            class="flex-none w-12 h-12 flex items-center justify-center bg-gradient-to-r from-teal-500 to-teal-600 text-white text-xl font-bold hover:from-teal-600 hover:to-teal-700 disabled:opacity-50 transition-all duration-200"
                                            onclick="addOneToCart('{{ $book->uuid }}', {{ $book->stock }})">+</button>
                                    </div>
                                @else
                                    <div id="cart-actions" class="flex-grow">
                                        <div class="flex items-center space-x-2">
                                            <div class="relative flex-1">
                                                <input type="number" id="quantity-{{ $book->uuid }}" name="quantity"
                                                    min="1" max="{{ $book->stock }}" value="1"
                                                    class="w-full h-12 pl-4 pr-10 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                                <span class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 pointer-events-none">
                                                    <span class="text-xs">Qty</span>
                                                </span>
                                            </div>
                                            <button class="h-12 px-6 bg-gradient-to-r from-teal-500 to-teal-600 text-white font-medium rounded-lg hover:from-teal-600 hover:to-teal-700 hover:shadow-lg transform hover:scale-[1.02] transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                                                @if ($book->stock > 0) onclick="addToCart('{{ $book->uuid }}', {{ $book->stock }})" @else disabled @endif>
                                                Add to cart
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Wishlist Button -->
                                @if ($book->isInWishlist)
                                    <button id="toggleWishlistBtn-{{ $book->uuid }}"
                                        class="h-12 flex items-center justify-center py-2 px-4 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors shadow-sm"
                                        onclick="removeFromWishlist('{{ $book->uuid }}')">
                                        <svg class="w-5 h-5 mr-2 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                                        </svg>
                                        Remove from Wishlist
                                    </button>
                                @else
                                    <button id="toggleWishlistBtn-{{ $book->uuid }}"
                                        class="h-12 flex items-center justify-center py-2 px-4 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors shadow-sm"
                                        onclick="addToWishlist('{{ $book->uuid }}')">
                                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path class="fill-gray-500" d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8l0-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5l0 3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20-.1-.1s0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5l0 3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2l0-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                                        </svg>
                                        Add to Wishlist
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
        
        <!-- Reviews Section -->
        <div class="mt-16 bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">Customer Reviews</h2>
                    <div class="flex items-center">
                        <div class="flex mr-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $book->reviews_avg_rate)
                                    <i class="fa-solid fa-star ms-1 text-yellow-400"></i>
                                @else
                                    <i class="fa-regular fa-star ms-1 text-gray-400"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="text-lg font-semibold text-gray-700">{{ number_format($book->reviews_avg_rate, 1) }}</span>
                        <span class="text-gray-500 text-sm ml-1">({{ $book->reviews_count }})</span>
                    </div>
                </div>
                
                <!-- Review Form -->
                @auth('client')
                    <div id="review-form" class="mb-12 @if (!$book->isReviewed) border-b border-gray-200 pb-10 @endif">
                        @if (!$book->isReviewed)
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Share Your Opinion</h3>
                            
                            <div class="flex items-center mb-4 space-x-1" id="review-rating">
                                <div class="flex gap-1">
                                    <i class="fa-regular fa-star text-3xl cursor-pointer text-gray-400 hover:text-yellow-400 transition-colors" data-value="1"></i>
                                    <i class="fa-regular fa-star text-3xl cursor-pointer text-gray-400 hover:text-yellow-400 transition-colors" data-value="2"></i>
                                    <i class="fa-regular fa-star text-3xl cursor-pointer text-gray-400 hover:text-yellow-400 transition-colors" data-value="3"></i>
                                    <i class="fa-regular fa-star text-3xl cursor-pointer text-gray-400 hover:text-yellow-400 transition-colors" data-value="4"></i>
                                    <i class="fa-regular fa-star text-3xl cursor-pointer text-gray-400 hover:text-yellow-400 transition-colors" data-value="5"></i>
                                </div>
                                <p class="text-center text-lg font-semibold text-gray-700 ml-5">
                                    <span id="rating-value">0</span> / 5
                                </p>
                            </div>
                            
                            <div class="relative">
                                <input id="review-content" type="text"
                                    class="w-full p-4 pr-24 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 shadow-sm"
                                    placeholder="Write your review here...">
                                <button id="submit-review"
                                    class="absolute right-2 top-2 bg-gradient-to-r from-teal-500 to-teal-600 text-white font-medium py-2 px-5 rounded-lg hover:from-teal-600 hover:to-teal-700 hover:shadow-lg transition-all duration-300"
                                    onclick="addReview('{{ $book->uuid }}')">
                                    Post Review
                                </button>
                                <p id="review-err" class="text-red-500 text-sm mt-1"></p>
                            </div>
                        @endif
                    </div>
                @endauth
                
                <!-- Reviews List -->
                <div id="reviews-container" class="space-y-6">
                    @if ($book->reviews->count() > 0)
                        @foreach ($book->reviews as $review)
                            <div id="review-{{ $review->uuid }}" class="bg-gray-50 rounded-xl p-6 hover:shadow-md transition-shadow">
                                <div class="flex justify-between">
                                    <div>
                                        <div class="flex items-center gap-2 mb-2">
                                            <div class="w-10 h-10 bg-gradient-to-r from-teal-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold">
                                                {{ substr($review->client->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <h4 class="text-lg font-semibold text-gray-800">{{ $review->client->name }}</h4>
                                                <div class="flex">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $review->rate)
                                                            <i class="fa-solid fa-star text-yellow-400 text-sm"></i>
                                                        @else
                                                            <i class="fa-regular fa-star text-gray-400 text-sm"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-gray-600 mt-2">{{ $review->content }}</p>
                                    </div>
                                    
                                    @auth('client')
                                        @if ($review->client_id === Auth::guard('client')->id())
                                            <div class="flex items-center space-x-2">
                                                <button id="showUpdateReviewFormBtn-{{ $review->uuid }}"
                                                    class="text-teal-600 hover:text-teal-800 transition-colors"
                                                    onclick="showUpdateReviewForm('{{ $book->uuid }}', '{{ $review->uuid }}', '{{ $review->content }}', {{ $review->rate }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <button id="deleteReviewBtn-{{ $review->uuid }}"
                                                    class="text-red-600 hover:text-red-800 transition-colors"
                                                    onclick="deleteReview('{{ $review->uuid }}', '{{ $book->uuid }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div id="no-reviews-msg-div" class="py-16 flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                </svg>
                                <p id="no-reviews-msg" class="text-2xl font-bold text-gray-400">No Reviews Yet</p>
                                <p class="text-gray-500 mt-2">Be the first to share your thoughts on this book!</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Related Books Section Placeholder -->
        <div class="mt-16">
            <h2 class="text-2xl font-bold text-gray-800 mb-8">You Might Also Like</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- This would be populated with related books -->
                <!-- Placeholder Card -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative h-60 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-60 z-10"></div>
                        <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover" alt="Related Book">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-1">Similar Book Title</h3>
                        <p class="text-gray-500 text-sm mb-2">Author Name</p>
                        <p class="text-green-600 font-bold">$19.99</p>
                    </div>
                </div>
                <!-- More placeholder cards would go here -->
            </div>
        </div>
    </div>
@endsection
