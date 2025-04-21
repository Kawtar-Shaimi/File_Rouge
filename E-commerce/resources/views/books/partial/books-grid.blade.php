<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    @if ($books->count() > 0)
        @foreach ($books as $book)
            <div id="book-{{ $book->uuid }}" class="group relative bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 book-card transform hover:-translate-y-2">
                <!-- Optional Category Tag -->
                <div class="absolute top-4 left-0 bg-gradient-to-r from-indigo-600 to-blue-500 text-white text-xs uppercase font-bold py-1 px-3 rounded-r-full shadow-md z-10">
                    Fiction
                </div>
                
                <a href="{{ route('books.show', $book->uuid) }}" class="block">
                    <div class="relative overflow-hidden h-56">
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}"
                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-0 group-hover:opacity-70 transition-opacity duration-300"></div>
                        
                        <!-- Quick view overlay on hover -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="bg-white bg-opacity-90 text-gray-800 font-medium py-2 px-4 rounded-full shadow-lg transform -translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                                Quick View
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-5">
                        <!-- Ratings -->
                        <div class="flex items-center mb-2">
                            <div class="flex text-yellow-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </div>
                            <span class="text-xs text-gray-500 ml-1">(47)</span>
                        </div>
                        
                        <!-- Title -->
                        <h3 class="text-lg font-bold mb-1 text-gray-800 group-hover:text-blue-600 transition-colors line-clamp-1">{{ $book->name }}</h3>
                        
                        <!-- Author - could be added if available in your data model -->
                        <p class="text-sm text-gray-500 mb-2">by Author Name</p>
                        
                        <!-- Description -->
                        <p class="text-gray-600 mb-3 text-sm line-clamp-2">{{ Str::limit($book->description, 100) }}</p>
                        
                        <!-- Price and Stock -->
                        <div class="flex justify-between items-center mt-4">
                            <p class="text-xl font-bold">
                                <span class="text-green-600">${{ $book->price }}</span>
                                @if(isset($book->original_price))
                                <span class="text-sm text-gray-400 line-through ml-2">${{ $book->original_price }}</span>
                                @endif
                            </p>
                            <span class="text-xs px-2 py-1 bg-gray-100 text-gray-700 rounded-full">
                                {{ $book->stock }} in stock
                            </span>
                        </div>
                    </div>
                </a>
                
                @auth('client')
                    <div class="p-5 pt-0 border-t border-gray-100">
                        <div id="actions" class="mt-2">
                            @if ($book->isInCart)
                                <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                                    <button id="removeFromCartBtn-{{ $book->uuid }}"
                                        class="flex-none w-10 h-10 flex items-center justify-center bg-gradient-to-br from-blue-500 to-indigo-600 text-white text-xl font-bold disabled:opacity-50"
                                        onclick="removeFromCart('{{ $book->uuid }}')"
                                        {{ $book->bookQuantity === 1 ? 'disabled' : '' }}>−</button>
                                    <input type="text" id="quantity-{{ $book->uuid }}" name="quantity"
                                        value="{{ $book->bookQuantity }}"
                                        class="flex-grow h-10 text-center bg-white text-gray-800 border-0" readonly disabled>
                                    <button id="addOneToCartBtn-{{ $book->uuid }}"
                                        class="flex-none w-10 h-10 flex items-center justify-center bg-gradient-to-br from-blue-500 to-indigo-600 text-white text-xl font-bold disabled:opacity-50"
                                        onclick="addOneToCart('{{ $book->uuid }}', {{ $book->stock }})">+</button>
                                </div>
                            @else
                                <div id="cart-actions">
                                    <div class="flex items-center space-x-2">
                                        <div class="relative flex-1">
                                            <input type="number" id="quantity-{{ $book->uuid }}" name="quantity"
                                                min="1" max="{{ $book->stock }}" value="1"
                                                class="w-full h-10 pl-3 pr-8 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                            <span class="absolute inset-y-0 right-0 flex items-center pr-2 text-gray-500 pointer-events-none">
                                                <span class="text-xs">Qty</span>
                                            </span>
                                        </div>
                                        <button class="h-10 px-4 bg-gradient-to-r from-indigo-600 to-purple-700 text-white font-medium rounded-lg hover:shadow-lg transform hover:scale-[1.02] transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                                            @if ($book->stock > 0) onclick="addToCart('{{ $book->uuid }}', {{ $book->stock }})" @else disabled @endif>
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="mt-3">
                                @if ($book->isInWishlist)
                                    <button id="toggleWishlistBtn-{{ $book->uuid }}"
                                        class="w-full flex items-center justify-center py-2 px-4 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors"
                                        onclick="removeFromWishlist('{{ $book->uuid }}')">
                                        <svg class="w-5 h-5 mr-2 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                                        </svg>
                                        Remove from Wishlist
                                    </button>
                                @else
                                    <button id="toggleWishlistBtn-{{ $book->uuid }}"
                                        class="w-full flex items-center justify-center py-2 px-4 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors"
                                        onclick="addToWishlist('{{ $book->uuid }}')">
                                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path class="fill-gray-500" d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8l0-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5l0 3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20-.1-.1s0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5l0 3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2l0-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z" />
                                        </svg>
                                        Add to Wishlist
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        @endforeach
    @else
        <div class="col-span-1 sm:col-span-2 lg:col-span-4">
            <div class="py-20 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <p class="text-3xl font-bold text-gray-400 italic">No Books Available Yet</p>
                <p class="text-gray-500 mt-2">Check back soon for our latest collection!</p>
            </div>
        </div>
    @endif
</div>

<div id="pagination" class="mt-8">
    <div class="flex justify-center">
        {{ $books->links() }}
    </div>
</div>
