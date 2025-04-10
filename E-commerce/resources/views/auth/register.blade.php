@extends('layouts.front-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/auth/registerInputValidation.js',
    ])
@endsection

@section('content')

    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
            <h3 class="text-xl font-semibold mb-4">Register</h3>
            <form action="{{ route('register') }}" method="POST">
                <div class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                        <input type="text" id="name" name="name" class="w-full p-3 border rounded-md" value="{{ old('name') }}" required>
                    </div>
                    <p id="nameErr" class="text-red-500 text-sm mt-1"></p>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                        <input type="email" id="email" name="email" class="w-full p-3 border rounded-md" value="{{ old('email') }}" required>
                    </div>
                    <p id="emailErr" class="text-red-500 text-sm mt-1"></p>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone:</label>
                        <input type="text" id="phone" name="phone" class="w-full p-3 border rounded-md" value="{{ old('phone') }}" required>
                    </div>
                    <p id="phoneErr" class="text-red-500 text-sm mt-1"></p>
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Role:</label>
                        <select id="role" name="role" class="w-full p-3 border rounded-md" required>
                            <option value="">Select Role</option>
                            <option value="client">Client</option>
                            <option value="publisher">Publisher</option>
                        </select>
                    </div>
                    <p id="roleErr" class="text-red-500 text-sm mt-1"></p>
                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="w-full p-3 border rounded-md" value="{{ old('password') }}" required>
                            <i class="fa-solid fa-eye absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer" id="togglePassword"></i>
                        </div>
                    </div>
                    <p id="passwordErr" class="text-red-500 text-sm mt-1"></p>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password:</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-3 border rounded-md" required>
                            <i class="fa-solid fa-eye absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer" id="toggleConfirmPassword"></i>
                        </div>
                    </div>
                    <p id="password_confirmationErr" class="text-red-500 text-sm mt-1"></p>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="mr-2">
                        <label for="remember" class="text-sm text-gray-700">Remember me</label>
                    </div>

                    <button id="register" type="submit" class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg hover:bg-blue-600">
                        Register
                    </button>

                    <div class="text-center mt-4">
                        <span class="text-gray-700">Already have an account? </span>
                        <a href="{{ route('loginView') }}" class="text-blue-600 hover:underline">Login</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
