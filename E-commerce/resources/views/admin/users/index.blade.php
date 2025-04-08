@extends('layouts.back-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/admin/users/users.js',
    ])
@endsection

@section('content')

@include('layouts.admin-sidebar')

<main class="ml-64 p-6">
    <!-- Users List -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold mt-8 mb-4">Users Table</h2>
        <button class="bg-blue-500 text-white px-3 py-2 rounded"><a href="{{ route('admin.users.create') }}">Add User</a></button>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="mb-4 flex items-center space-x-5">
            <input type="text" id="search" placeholder="Search by name, email, or role" class="border border-gray-300 rounded-lg p-2 w-1/3">
            <div>
                <label for="sort" class="ml-2 text-gray-600">Sort By:</label>
                <select id="sort" class="border border-gray-300 rounded-lg p-2">
                    <option value="id" selected>ID</option>
                    <option value="name">Name</option>
                    <option value="email">Email</option>
                    <option value="role">Role</option>
                    <option value="created_at">Creation Date</option>
                    <option value="updated_at">Last Update</option>
                </select>
            </div>
            <div>
                <label for="order" class="ml-2 text-gray-600">Order:</label>
                <select id="order" class="border border-gray-300 rounded-lg p-2">
                    <option value="asc" selected>Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
        </div>
        <div id="users-table">
            @include('admin.users.partial.users-list', ['users' => $users])
        </div>
    </div>
</main>
@endsection
