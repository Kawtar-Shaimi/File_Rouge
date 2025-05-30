@extends('layouts.back-office')

@section('title', 'User Informations')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin/users/user.js'])
@endsection

@section('content')
    @include('layouts.admin-sidebar')

    <div class="container w-5/6 ms-auto p-6">
        <div class=" max-w-4xl mx-auto">
            <div class="mt-10">
                <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">User Informations</h2>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <table class="w-full border-collapse">
                        <tr>
                            <td class="p-3 border">User ID:</td>
                            <td class="p-3 border underline italic hover:text-blue-400"><a
                                    href="{{ route('admin.users.show', $user->uuid) }}">#{{ $user->uuid }}</a></td>
                        </tr>
                        <tr>
                            <td class="p-3 border">User Name:</td>
                            <td class="p-3 border">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">User Role:</td>
                            <td class="p-3 border">{{ $user->role }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">User Email:</td>
                            <td class="p-3 border">{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">User Phone:</td>
                            <td class="p-3 border">{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Email Verified At:</td>
                            <td class="p-3 border">{{ $user->email_verified_at ?? 'Not Verified' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Creation Date:</td>
                            <td class="p-3 border">{{ $user->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Last Update:</td>
                            <td class="p-3 border">{{ $user->updated_at }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Actions</td>
                            <td class="p-3 border">
                                <button class="bg-blue-500 text-white px-3 py-1 rounded"><a
                                        href="{{ route('admin.users.edit', $user->uuid) }}">Update</a></button>
                                <form id="delete-form" action="{{ route('admin.users.delete', $user->uuid) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete" type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
