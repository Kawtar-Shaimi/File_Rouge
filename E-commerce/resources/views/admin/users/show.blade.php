@extends('layouts.app')

@section('content')

@include('layouts.admin-sidebar')

<div class="container w-5/6 ms-auto p-6">
    <div class=" max-w-4xl mx-auto">
        <div class="mt-10">
            <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">User Informations</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <table class="w-full border-collapse">
                    <tr>
                        <td class="p-3 border">User ID</td>
                        <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.users.show', $user) }}">#{{ $user->id }}</a></td>
                    </tr>
                    <tr>
                        <td class="p-3 border">User Name</td>
                        <td class="p-3 border">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">User Role</td>
                        <td class="p-3 border">{{ $user->role }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">User Email</td>
                        <td class="p-3 border">{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">User Phone</td>
                        <td class="p-3 border">{{ $user->phone}}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Email Verified At</td>
                        <td class="p-3 border">{{ $user->email_verified_at ?? "Not Verified"}}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Remember Token</td>
                        <td class="p-3 border">{{ $user->remember_token }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">User Password</td>
                        <td class="p-3 border">{{ $user->password }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Creationt Date</td>
                        <td class="p-3 border">{{ $user->created_at }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Update Date</td>
                        <td class="p-3 border">{{ $user->updated_at }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Actions</td>
                        <td class="p-3 border">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded"><a href="{{ route('admin.users.edit', $user) }}">Modifier</a></button>
                            <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
