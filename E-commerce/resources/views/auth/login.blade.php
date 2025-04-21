@extends('layouts.front-office')

@section('title', 'Login')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/auth/loginInputValidation.js'])
@endsection

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
                        <input type="email" id="email" name="email" class="w-full p-3 border rounded-md"
                            value="{{ old('email') }}" required>
                    </div>
                    <p id="emailErr" class="text-red-500 text-sm mt-1"></p>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="w-full p-3 border rounded-md"
                                required>
                            <i class="fa-solid fa-eye absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer"
                                id="togglePassword"></i>
                        </div>
                    </div>
                    <p id="passwordErr" class="text-red-500 text-sm mt-1"></p>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="mr-2">
                        <label for="remember" class="text-sm text-gray-700">Remember me</label>
                    </div>

                    <button id="login" type="submit"
                        class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700">
                        Login
                    </button>

                    <div class="text-center mt-4">
                        <p class="text-sm text-gray-700">Don't have an account? <a href="{{ route('register') }}"
                                class="text-blue-500">Register</a></p>
                    </div>

                    <div class="text-center mt-4">
                        <p class="text-sm text-gray-700">Forgot your password? <a
                                href="{{ route('reset.forget-password') }}" class="text-blue-500">Reset Password</a></p>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
