<footer class="bg-gradient-to-r from-blue-800 to-teal-700 text-white py-12 mt-16">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            <!-- Brand Column -->
            <div class="col-span-1 md:col-span-1">
                <div class="mb-6">
                    <a href="{{ route('home') }}" class="text-2xl font-bold">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-200 to-teal-100">{{ config('app.name') }}</span>
                    </a>
                </div>
                <p class="text-gray-300 mb-6">Your one-stop destination for quality books and literary treasures.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:text-blue-200 transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-white hover:text-blue-200 transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-white hover:text-blue-200 transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-bold mb-4 border-b border-blue-500 pb-2 inline-block">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-blue-200 transition-colors">Home</a></li>
                    <li><a href="{{ route('books') }}" class="text-gray-300 hover:text-blue-200 transition-colors">Shop</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-blue-200 transition-colors">About Us</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-blue-200 transition-colors">Contact</a></li>
                </ul>
            </div>
            
            <!-- Customer Service -->
            <div>
                <h3 class="text-lg font-bold mb-4 border-b border-blue-500 pb-2 inline-block">Customer Service</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-300 hover:text-blue-200 transition-colors">FAQ</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-blue-200 transition-colors">Shipping</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-blue-200 transition-colors">Returns</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-blue-200 transition-colors">Terms & Conditions</a></li>
                </ul>
            </div>
            
            <!-- Newsletter -->
            <div>
                <h3 class="text-lg font-bold mb-4 border-b border-blue-500 pb-2 inline-block">Newsletter</h3>
                <p class="text-gray-300 mb-4">Subscribe to receive updates on new arrivals and special promotions.</p>
                <div class="flex">
                    <input type="email" placeholder="Your email" class="px-4 py-2 w-full rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-800">
                    <button class="bg-teal-500 hover:bg-teal-600 px-4 py-2 rounded-r-lg transition-colors">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="border-t border-blue-700 mt-12 pt-6 text-center text-gray-300">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</footer>
