<footer class="bg-gray-900 text-gray-200 py-6 mt-12">
    <div class="container mx-auto px-4 text-center">
        <div class="mb-4">
            <a href="" class="text-2xl font-bold text-green-500">{{ config('app.name') }}</a>
        </div>
        <div class="mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors mx-2">Home</a>
            <a href="{{ route('books') }}" class="hover:text-white transition-colors mx-2">Shop</a>
            <a href="#" class="hover:text-white transition-colors mx-2">About Us</a>
            <a href="#" class="hover:text-white transition-colors mx-2">Contact</a>
        </div>
        <div>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</footer>
