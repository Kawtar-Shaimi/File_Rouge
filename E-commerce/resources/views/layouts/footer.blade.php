<footer class="bg-gradient-to-br from-slate-800 to-slate-900 text-gray-100 pt-16 pb-8 mt-12 relative overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
    <div class="absolute -bottom-32 -left-32 w-64 h-64 bg-emerald-600/10 rounded-full blur-3xl"></div>
    <div class="absolute top-32 right-32 w-48 h-48 bg-teal-500/10 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
            <div class="space-y-6">
                <a href="{{ route('home') }}" class="inline-block">
                    <span class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-500 tracking-tight">{{ config('app.name') }}</span>
                </a>
                <p class="text-gray-400 text-sm leading-relaxed">Your one-stop destination for books from different publishers, with a wide range of genres and authors. Discover your next favorite read today.</p>
                <div class="flex space-x-4">
                    <a href="#" class="w-9 h-9 rounded-full bg-slate-700/50 flex items-center justify-center text-slate-300 hover:bg-emerald-500/20 hover:text-white transition-all duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-full bg-slate-700/50 flex items-center justify-center text-slate-300 hover:bg-emerald-500/20 hover:text-white transition-all duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-full bg-slate-700/50 flex items-center justify-center text-slate-300 hover:bg-emerald-500/20 hover:text-white transition-all duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            
            <div class="md:mx-auto">
                <h3 class="text-lg font-semibold mb-6 relative inline-block">
                    <span class="relative z-10">Quick Links</span>
                    <span class="absolute -bottom-1 left-0 w-1/2 h-1 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full"></span>
                </h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-emerald-400 transition-colors duration-300 text-sm inline-flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-emerald-500/70"></i> Home</a></li>
                    <li><a href="{{ route('books') }}" class="text-gray-400 hover:text-emerald-400 transition-colors duration-300 text-sm inline-flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-emerald-500/70"></i> Shop</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors duration-300 text-sm inline-flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-emerald-500/70"></i> About Us</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors duration-300 text-sm inline-flex items-center"><i class="fas fa-chevron-right text-xs mr-2 text-emerald-500/70"></i> Contact</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-6 relative inline-block">
                    <span class="relative z-10">Newsletter</span>
                    <span class="absolute -bottom-1 left-0 w-1/2 h-1 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full"></span>
                </h3>
                <p class="text-gray-400 text-sm mb-4">Subscribe to our newsletter for the latest updates and book releases.</p>
                <div class="flex">
                    <input type="email" placeholder="Your email address" class="bg-slate-700/30 border border-slate-600 rounded-l-lg py-2 px-4 text-sm w-full focus:outline-none focus:ring-2 focus:ring-emerald-500/50 focus:border-transparent text-white">
                    <button class="bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white px-4 rounded-r-lg text-sm font-medium transition-all duration-300">Subscribe</button>
                </div>
            </div>
        </div>
        
        <div class="mt-12 pt-8 border-t border-slate-700/50 text-center">
            <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</footer>
