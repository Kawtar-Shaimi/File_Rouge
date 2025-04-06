@extends('layouts.front-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
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
                @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" class="w-full p-3 border rounded-md" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone:</label>
                    <input type="text" id="phone" name="phone" class="w-full p-3 border rounded-md" value="{{ old('phone') }}" required>
                </div>
                @error('phone')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700">Role:</label>
                    <select id="role" name="role" class="w-full p-3 border rounded-md" required>
                        <option value="">Select Role</option>
                        <option value="client">Client</option>
                        <option value="publisher">Publisher</option>
                    </select>
                </div>
                @error('role')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                    <input type="password" id="password" name="password" class="w-full p-3 border rounded-md" value="{{ old('password') }}" required>
                </div>
                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-3 border rounded-md" required>
                </div>
                @error('password_confirmation')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit" class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg hover:bg-blue-600">
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
