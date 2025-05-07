@extends('layouts.front-office')

@section('title', 'Reset Password')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
            <!-- Reset Password -->
            <h3 class="text-xl font-semibold mb-4">Reset Password</h3>
            <form action="{{ route('reset.auth.reset-password', $user->uuid) }}" method="POST">
                <div class="space-y-4">
                    @csrf

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="w-full p-3 border rounded-md"
                                value="{{ old('password') }}" required>
                            <i class="fa-solid fa-eye absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer"
                                id="togglePassword"></i>
                        </div>
                    </div>
                    <p id="passwordErr" class="text-red-500 text-sm mt-1"></p>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                            Password:</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full p-3 border rounded-md" required>
                            <i class="fa-solid fa-eye absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer"
                                id="toggleConfirmPassword"></i>
                        </div>
                    </div>
                    <p id="password_confirmationErr" class="text-red-500 text-sm mt-1"></p>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <button id="auth.reset-password" type="submit"
                        class="w-full bg-teal-400 text-white font-bold py-3 rounded-lg hover:bg-blue-600">
                        Reset Password
                    </button>

                </div>
            </form>
        </div>
    </div>
@endsection
