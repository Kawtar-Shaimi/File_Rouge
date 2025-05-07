@extends('layouts.front-office')

@section('title', 'Change Password')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/users/changePasswordInputValidation.js'])
@endsection

@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
            <!-- Formulaire d'adresse -->
            <h3 class="text-xl font-semibold mb-4">Change Your Password</h3>
            <form id="update-form" action="{{ route('users.change-password.update', $user->uuid) }}" method="POST">
                <div class="space-y-4">
                    @csrf

                    <div>
                        <label for="old_password" class="block text-sm font-medium text-gray-700">Old Password:</label>
                        <div class="relative">
                            <input type="password" id="old_password" name="old_password"
                                class="w-full p-3 border rounded-md" value="{{ old('old_password') }}" required>
                            <i class="fa-solid fa-eye absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer"
                                id="toggleOldPassword"></i>
                        </div>
                    </div>
                    <p id="old_passwordErr" class="text-red-500 text-xs mt-1"></p>
                    @error('old_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700">New Password:</label>
                        <div class="relative">
                            <input type="password" id="new_password" name="new_password"
                                class="w-full p-3 border rounded-md" value="{{ old('new_password') }}" required>
                            <i class="fa-solid fa-eye absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer"
                                id="toggleNewPassword"></i>
                        </div>
                    </div>
                    <p id="new_passwordErr" class="text-red-500 text-xs mt-1"></p>
                    @error('new_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New
                            Password:</label>
                        <div class="relative">
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                class="w-full p-3 border rounded-md" required>
                            <i class="fa-solid fa-eye absolute top-1/2 right-3 transform -translate-y-1/2 cursor-pointer"
                                id="toggleConfirmNewPassword"></i>
                        </div>
                    </div>
                    <p id="new_password_confirmationErr" class="text-red-500 text-xs mt-1"></p>
                    @error('new_password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <button id="change-password" type="submit"
                        class="w-full bg-teal-400 text-white font-bold py-3 rounded-lg hover:bg-blue-600">
                        Change Password
                    </button>

                </div>
            </form>
        </div>
    </div>
@endsection
