@extends('layouts.front-office')

@section('title', 'Update Profile')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/users/updateProfileInputValidation.js'])
@endsection

@section('content')
    <div class="container mx-auto p-8">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-xl space-y-6">
            <h2 class="text-2xl font-bold mb-4 text-center">Update Your Profile</h2>
            <form id="update-form" action="{{ route('users.update', $user->uuid) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-lg font-semibold">Name:</label>
                    <input type="text" id="name" name="name" required value="{{ old('name', $user->name) }}"
                        class="w-full mt-2 p-2 border rounded-lg">
                </div>
                <p id="nameErr" class="text-red-500 text-sm mt-1"></p>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-lg font-semibold">Email:</label>
                    <input type="email" id="email" name="email" required value="{{ old('email', $user->email) }}"
                        class="w-full mt-2 p-2 border rounded-lg">
                </div>
                <p id="emailErr" class="text-red-500 text-sm mt-1"></p>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Phone -->
                <div class="mb-4">
                    <label for="phone" class="block text-lg font-semibold">Phone:</label>
                    <input type="text" id="phone" name="phone" required value="{{ old('phone', $user->phone) }}"
                        class="w-full mt-2 p-2 border rounded-lg">
                </div>
                <p id="phoneErr" class="text-red-500 text-sm mt-1"></p>
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Submit -->
                <button id="update-user" type="submit"
                    class="w-full bg-teal-400 text-white p-3 rounded-lg hover:bg-blue-700 transition">Update</button>
            </form>
        </div>
    </div>
@endsection
