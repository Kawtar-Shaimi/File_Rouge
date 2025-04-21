<footer class="bg-gradient-to-r from-blue-900 to-teal-800 text-white py-16 mt-16 shadow-inner">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            <!-- Brand Column -->
            <div class="col-span-1 md:col-span-1">
                <div class="mb-6">
                    <a href="{{ route('home') }}" class="text-2xl font-bold">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-teal-200 to-blue-200">{{ config('app.name') }}</span>
                    </a>
                </div>
                <p class="text-gray-300 mb-6 leading-relaxed">Your one-stop destination for quality books and literary treasures.</p>
                <div class="flex space-x-5">
                    <a href="#" class="text-gray-300 hover:text-teal-300 transition-colors duration-200 transform hover:scale-110">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-teal-300 transition-colors duration-200 transform hover:scale-110">
                        <i class="fab fa-twitter text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-teal-300 transition-colors duration-200 transform hover:scale-110">
                        <i class="fab fa-instagram text-lg"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-teal-300 transition-colors duration-200 transform hover:scale-110">
                        <i class="fab fa-pinterest text-lg"></i>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-bold mb-5 relative pb-2 inline-block after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-12 after:bg-teal-400">Quick Links</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs text-teal-400 mr-2"></i>Home</a></li>
                    <li><a href="{{ route('books') }}" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs text-teal-400 mr-2"></i>Shop</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs text-teal-400 mr-2"></i>About Us</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs text-teal-400 mr-2"></i>Contact</a></li>
                </ul>
            </div>
            
            <!-- Customer Service -->
            <div>
                <h3 class="text-lg font-bold mb-5 relative pb-2 inline-block after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-12 after:bg-teal-400">Customer Service</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs text-teal-400 mr-2"></i>FAQ</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs text-teal-400 mr-2"></i>Shipping</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs text-teal-400 mr-2"></i>Returns</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white transition-colors flex items-center"><i class="fas fa-chevron-right text-xs text-teal-400 mr-2"></i>Terms & Conditions</a></li>
                </ul>
            </div>
            
            <!-- Newsletter -->
            <div>
                <h3 class="text-lg font-bold mb-5 relative pb-2 inline-block after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-12 after:bg-teal-400">Newsletter</h3>
                <p class="text-gray-300 mb-5 leading-relaxed">Subscribe to receive updates on new arrivals and special promotions.</p>
                <div class="relative">
                    <input type="email" placeholder="Your email" class="px-5 py-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 text-gray-800 bg-white/95 backdrop-blur-sm">
                    <button class="absolute right-1.5 top-1.5 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 px-4 py-1.5 rounded-lg transition-colors text-sm font-medium">
                        Subscribe
                    </button>
                </div>
        </div>
        </div>
        
        <!-- Copyright -->
        <div class="border-t border-blue-800/50 mt-12 pt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</footer>
