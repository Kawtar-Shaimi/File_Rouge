@extends('layouts.front-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/auth/forgetPasswordInputValidation.js',
    ])
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
                        <input type="email" id="email" name="email" class="w-full p-3 border rounded-md" value="{{ old('email') }}" required>
                    </div>
                    <p id="emailErr" class="text-red-500 text-sm mt-1"></p>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <button id="send-reset-link" type="submit" class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg hover:bg-blue-600">
                        Send Password Reset Link
                    </button>

                </div>
            </form>
        </div>
    </div>
@endsection
