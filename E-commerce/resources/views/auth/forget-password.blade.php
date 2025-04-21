@extends('layouts.front-office')

@section('title', 'Forgot Password')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/auth/forgetPasswordInputValidation.js'])
@endsection

@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
            <!-- Formulaire d'adresse -->
            <h3 class="text-xl font-semibold mb-4">Forgot Password</h3>
            <form action="{{ route('reset.send-token') }}" method="POST">
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

                    <button id="send-reset-link" type="submit"
                        class="w-full py-3 px-4 bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white font-medium rounded-lg transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        Send Password Reset Link
                    </button>

                </div>
            </form>
        </div>
    </div>
@endsection
