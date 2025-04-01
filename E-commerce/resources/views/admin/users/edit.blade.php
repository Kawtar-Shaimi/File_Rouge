@extends('layouts.back-office')

@section('content')

@include('layouts.admin-sidebar')

<div class="container w-5/6 ms-auto p-6">
    <div class="max-w-lg mx-auto">
        <div class="mt-10">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-4 text-center">Update User Role</h2>

                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Role -->
                    <div class="mb-4">
                        <label for="role" class="block text-lg font-semibold">Role</label>
                        <select name="role" id="role"
                            class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                            <option value="">Select Role</option>
                            <option @if ($user->role == 'admin') selected @endif value="admin">Admin</option>
                            <option @if ($user->role == 'publisher') selected @endif value="publisher">Publisher</option>
                        </select>
                    </div>

                    <!-- Bouton de soumission -->
                    <button type="submit"
                        class="w-full bg-purple-400 text-white p-3 rounded-lg hover:bg-blue-700 transition">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
