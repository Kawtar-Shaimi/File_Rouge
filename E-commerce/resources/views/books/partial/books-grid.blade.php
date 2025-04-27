<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
    @if ($books->count() > 0)
        @foreach ($books as $book)
            <div id="book-{{ $book->uuid }}" class="bg-white rounded-xl shadow-lg overflow-hidden transition-all hover:shadow-2xl hover:-translate-y-1 group">
                <a href="{{ route('books.show', $book->uuid) }}" class="block">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}" 
                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        
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
        <div class="col-span-1 md:col-span-2 lg:col-span-4 py-20">
            <div class="text-center">
                <i class="fas fa-book-open text-6xl text-gray-300 mb-4"></i>
                <p class="text-2xl font-semibold text-gray-400">No books available at the moment</p>
                <p class="text-gray-500 mt-2">Check back later for our upcoming collection</p>
            </div>
        </div>
    @endif
</div>
<div id="pagination" class="mt-8 flex justify-center">
    {{ $books->links() }}
</div>
