@extends('layouts.back-office')

@section('title', 'Create User')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin/users/createInputValidation.js'])
@endsection

@section('content')
    @include('layouts.admin-sidebar')

    <div class="container w-5/6 ms-auto p-6">
        <div class="max-w-lg mx-auto">
            <div class="mt-10">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold mb-4 text-center">Create New User</h2>

                    <form id="create-form" action="{{ route('admin.users.store') }}" method="POST">
                        @csrf

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-lg font-semibold">Name:</label>
                            <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                class="w-full mt-2 p-2 border rounded-lg">
                        </div>
                        <p id="nameErr" class="text-red-500 text-sm mt-1"></p>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-lg font-semibold">Email:</label>
                            <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                class="w-full mt-2 p-2 border rounded-lg">
                        </div>
                        <p id="emailErr" class="text-red-500 text-sm mt-1"></p>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Phone -->
                        <div class="mb-4">
                            <label for="phone" class="block text-lg font-semibold">Phone:</label>
                            <input type="text" id="phone" name="phone" required value="{{ old('phone') }}"
                                class="w-full mt-2 p-2 border rounded-lg">
                        </div>
                        <p id="phoneErr" class="text-red-500 text-sm mt-1"></p>
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Role -->
                        <div class="mb-4">
                            <label for="role" class="block text-lg font-semibold">Role:</label>
                            <select name="role" id="role" class="w-full mt-2 p-2 border rounded-lg">
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="publisher">Publisher</option>
                            </select>
                        </div>
                        <p id="roleErr" class="text-red-500 text-sm mt-1"></p>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Password -->
                        <div class="mb-4">
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

                        <div class="mb-4">
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

                        <!-- Submit -->
                        <button id="create-user" type="submit"
                            class="w-full bg-purple-400 text-white p-3 rounded-lg hover:bg-blue-700 transition">Create
                            User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
