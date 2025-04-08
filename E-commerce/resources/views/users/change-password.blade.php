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
            <!-- Formulaire d'adresse -->
            <h3 class="text-xl font-semibold mb-4">Change Password</h3>
            <form action="{{ route('users.change-password.update', $user->uuid) }}" method="POST">
                <div class="space-y-4">
                    @csrf

                    <div>
                        <label for="old_password" class="block text-sm font-medium text-gray-700">Old Password:</label>
                        <input type="password" id="old_password" name="old_password" class="w-full p-3 border rounded-md"
                            value="{{ old('old_password') }}" required>
                    </div>
                    @error('old_password')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700">New Password:</label>
                        <input type="password" id="new_password" name="new_password" class="w-full p-3 border rounded-md"
                            value="{{ old('new_password') }}" required>
                    </div>
                    @error('new_password')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password:</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                            class="w-full p-3 border rounded-md" required>
                    </div>
                    @error('new_password_confirmation')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <button type="submit"
                        class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg hover:bg-blue-600">
                        Change Password
                    </button>

                </div>
            </form>
        </div>
    </div>

@endsection
