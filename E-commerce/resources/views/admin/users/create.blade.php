@extends('layouts.back-office')

@section('content')

@include('layouts.admin-sidebar')

<div class="container w-5/6 ms-auto p-6">
    <div class="max-w-lg mx-auto">
        <div class="mt-10">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-4 text-center">Create New User</h2>

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-lg font-semibold">Name</label>
                        <input type="text" id="name" name="name" required value="{{ old('name') }}"
                            class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300" >
                    </div>
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-lg font-semibold">Email</label>
                        <input type="email" id="email" name="email" required value="{{ old('email') }}"
                            class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                    <!-- Phone -->
                    <div class="mb-4">
                        <label for="phone" class="block text-lg font-semibold">Phone</label>
                        <input type="text" id="phone" name="phone" required value="{{ old('phone') }}"
                            class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>

                    <!-- Role -->
                    <div class="mb-4">
                        <label for="role" class="block text-lg font-semibold">Role</label>
                        <select name="role" id="role"
                            class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="publisher">Publisher</option>
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-lg font-semibold">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-lg font-semibold">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full bg-purple-400 text-white p-3 rounded-lg hover:bg-blue-700 transition">Create User</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
