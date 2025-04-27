@extends('layouts.front-office')

@section('title', 'Book Details')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/client/cart/addToCart.js', 'resources/js/client/cart/addOneToCart.js', 'resources/js/client/cart/removeFromCart.js', 'resources/js/client/wishlist/addToWishlist.js', 'resources/js/client/wishlist/removeFromWishlist.js', 'resources/js/client/reviews/bookReviewScript.js'])
@endsection

@section('content')
    <div class="bg-gradient-to-b from-green-50 to-white py-10">
        <!-- Book Details -->
        <div class="container mx-auto px-4 sm:px-6 max-w-5xl">
            <h2 class="text-2xl font-bold text-teal-500 mb-6">Book Details</h2>
            <div id="book-{{ $book->uuid }}" class="bg-white p-6 rounded-xl shadow-lg flex flex-col md:flex-row">

                <!-- Book Image -->
                <div class="w-full md:w-1/2 md:pr-6">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}"
                            class="w-full h-auto rounded-lg shadow-md object-cover">
                        <div class="absolute inset-0 bg-gradient-to-tr from-green-400/10 to-teal-400/10 rounded-lg"></div>
                    </div>
                </div>

                <!-- Book information -->
                <div class="w-full md:w-1/2 mt-6 md:mt-0">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $book->name }}</h2>
                    <p class="text-gray-600 text-lg mb-6">{{ $book->description }}</p>

                    <!-- Price -->
                    <div class="mb-6 flex items-center">
                        <span class="text-teal-500 font-bold text-2xl">${{ $book->price }}</span>
                        @if ($book->stock > 0)
                            <span class="text-green-500 font-semibold ml-4 flex items-center">
                                <i class="fas fa-check-circle mr-1"></i> {{ $book->stock }} In stock
                            </span>
                        @else
                            <span class="text-red-500 font-semibold ml-4 flex items-center">
                                <i class="fas fa-times-circle mr-1"></i> Out of stock
                            </span>
                        @endif
                    </div>

                    <!-- Reviews -->
                    <div class="flex items-center mb-6">
                        <div id="book_reviews_stars">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $book->reviews_avg_rate)
                                    <i class="fa-solid fa-star ms-2 cursor-pointer text-yellow-400"></i>
                                @else
                                    <i class="fa-regular fa-star ms-2 cursor-pointer"></i>
                                @endif
                            @endfor
                        </div>
                        <span id="book_reviews_count" class="ml-2 text-gray-600">({{ $book->reviews_count }} reviews)</span>
                    </div>

                    @auth('client')
                        <div>
                            <div id="actions" class="mt-4 flex items-end space-x-2">
                                @if ($book->isInCart)
                                    <div class="flex w-4/5 border border-gray-200 rounded-lg overflow-hidden">
                                        <button id="removeFromCartBtn-{{ $book->uuid }}"
                                            class="w-1/5 bg-green-50 hover:bg-green-100 text-teal-600 font-bold py-3 px-0"
                                            onclick="removeFromCart('{{ $book->uuid }}')"
                                            {{ $book->bookQuantity === 1 ? 'disabled' : '' }}>
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="text" id="quantity-{{ $book->uuid }}" name="quantity"
                                            value="{{ $book->bookQuantity }}"
                                            class="w-3/5 text-center p-2 bg-white text-gray-900 border-x border-gray-200" readonly disabled>
                                        <button id="addOneToCartBtn-{{ $book->uuid }}"
                                            class="w-1/5 bg-green-50 hover:bg-green-100 text-teal-600 font-bold py-3 px-0"
                                            onclick="addOneToCart('{{ $book->uuid }}', {{ $book->stock }})">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                @else
                                    <div id="cart-actions" class="w-4/5">
                                        <div class="flex items-center">
                                            <label for="quantity-{{ $book->uuid }}"
                                                class="text-gray-600 font-medium mr-3">Quantity:</label>
                                            <div class="flex flex-1">
                                                <input type="number" id="quantity-{{ $book->uuid }}" name="quantity" min="1"
                                                    max="{{ $book->stock }}" value="1"
                                                    class="w-1/5 p-3 bg-white text-gray-900 border border-r-0 border-gray-200 rounded-l-lg">
                                                <button
                                                    class="w-4/5 bg-gradient-to-r from-green-400 to-teal-500 hover:from-green-500 hover:to-teal-600 text-white font-medium py-3 px-4 rounded-r-lg flex items-center justify-center"
                                                    @if ($book->stock > 0) onclick="addToCart('{{ $book->uuid }}', {{ $book->stock }})" @else disabled @endif>
                                                    <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <button id="toggleWishlistBtn-{{ $book->uuid }}"
                                    class="w-1/5 bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 font-bold py-3 px-0 rounded-lg"
                                    onclick="{{ $book->isInWishlist ? "removeFromWishlist('".$book->uuid."')" : "addToWishlist('".$book->uuid."')" }}">
                                    <svg class="w-6 h-6 mx-auto {{ $book->isInWishlist ? 'fill-red-500' : 'fill-gray-400' }}" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="{{ $book->isInWishlist ? 'M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z' : 'M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8l0-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5l0 3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20-.1-.1s0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5l0 3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2l0-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z' }}" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>

            <h2 class="text-2xl font-bold text-teal-500 mt-12 mb-6">
                Reviews
                <span class="ms-2" id="reviews_avg">{{ number_format($book->reviews_avg_rate, 1) }}</span>
                <i class="fa-solid fa-star me-1 cursor-pointer text-yellow-400"></i>
                (<span id="reviews_count">{{ $book->reviews_count }}</span>)
            </h2>
            
            <div id="reviews" class="w-full bg-white p-6 rounded-xl shadow-lg mb-12">
                @auth('client')
                    <div id="review-form" @if (!$book->isReviewed) class="border-b border-gray-200 pb-6 mb-6" @endif>
                        @if (!$book->isReviewed)
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Leave a Review:</h3>

                            <div class="flex items-center mb-4 space-x-1" id="review-rating">
                                <i class="fa-regular fa-star text-3xl cursor-pointer text-gray-400" data-value="1"></i>
                                <i class="fa-regular fa-star text-3xl cursor-pointer text-gray-400" data-value="2"></i>
                                <i class="fa-regular fa-star text-3xl cursor-pointer text-gray-400" data-value="3"></i>
                                <i class="fa-regular fa-star text-3xl cursor-pointer text-gray-400" data-value="4"></i>
                                <i class="fa-regular fa-star text-3xl cursor-pointer text-gray-400" data-value="5"></i>
                                <p class="text-center text-lg font-semibold text-gray-700 !ml-5"><span id="rating-value">0</span> / 5</p>
                            </div>

                            <div class="mb-4">
                                <div class="flex">
                                    <input id="review-content" type="text"
                                        class="w-4/5 p-3 border border-gray-200 rounded-l-lg focus:ring-2 focus:ring-teal-400 focus:border-transparent"
                                        placeholder="Write your review here...">
                                    <button id="submit-review"
                                        class="w-1/5 bg-gradient-to-r from-green-400 to-teal-500 hover:from-green-500 hover:to-teal-600 text-white font-bold py-3 rounded-r-lg transition duration-200"
                                        onclick="addReview('{{ $book->uuid }}')">
                                        <i class="fas fa-paper-plane mr-2"></i> Send
                                    </button>
                                </div>
                                <p id="review-err" class="text-red-500 text-xs mt-1"></p>
                            </div>
                        @endif
                    </div>
                @endauth
                
                <div id="reviews-container">
                    @if ($book->reviews->count() > 0)
                        @foreach ($book->reviews as $review)
                            <div id="review-{{ $review->uuid }}" class="border-b border-gray-100 pb-4 mb-4">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <div class="flex items-center mb-2">
                                            <h4 class="text-lg font-semibold text-gray-800">{{ $review->client->name }}</h4>
                                            <div class="flex items-center space-x-1 ml-3">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $review->rate)
                                                        <i class="fa-solid fa-star cursor-pointer text-yellow-400"></i>
                                                    @else
                                                        <i class="fa-regular fa-star cursor-pointer text-gray-300"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-gray-600">{{ $review->content }}</p>
                                    </div>
                                    
                                    @auth('client')
                                        @if ($review->client_id === Auth::guard('client')->id())
                                            <div id="actions">
                                                <div class="flex items-center">
                                                    <button id="showUpdateReviewFormBtn-{{ $review->uuid }}"
                                                        class="bg-teal-50 hover:bg-teal-100 text-teal-600 font-medium py-2 px-4 rounded-l-lg border border-r-0 border-gray-200"
                                                        onclick="showUpdateReviewForm('{{ $book->uuid }}', '{{ $review->uuid }}', '{{ $review->content }}', {{ $review->rate }})">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button id="deleteReviewBtn-{{ $review->uuid }}"
                                                        class="bg-red-50 hover:bg-red-100 text-red-500 font-medium py-2 px-4 rounded-r-lg border border-gray-200"
                                                        onclick="deleteReview('{{ $review->uuid }}', '{{ $book->uuid }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div id="no-reviews-msg-div" class="py-10 flex flex-col items-center justify-center">
                            <i class="fas fa-comment-slash text-gray-300 text-5xl mb-4"></i>
                            <p id="no-reviews-msg" class="text-gray-400 text-xl font-medium text-center">No reviews yet. Be the first to share your thoughts!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
