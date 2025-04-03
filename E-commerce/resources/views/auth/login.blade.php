@extends('layouts.front-office')

@section('content')

<div class="container mx-auto p-6">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
        <!-- Formulaire d'adresse -->
        <h3 class="text-xl font-semibold mb-4">Login</h3>
        <form action="{{ route('login') }}" method="POST">
            <div class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" class="w-full p-3 border rounded-md" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                    <input type="password" id="password" name="password" class="w-full p-3 border rounded-md" value="{{ old('password') }}" required>
                </div>
                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="mr-2">
                    <label for="remember" class="text-sm text-gray-700">Remember me</label>
                </div>
                
                <button type="submit" class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg hover:bg-blue-600">
                    Login
                </button>

                <div class="text-center mt-4">
                    <p class="text-sm text-gray-700">Don't have an account? <a href="{{ route('register') }}" class="text-blue-500">Register</a></p>
                </div>

                <div class="text-center mt-4">
                    <p class="text-sm text-gray-700">Forgot your password? <a class="text-blue-500">Reset Password</a></p>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection
