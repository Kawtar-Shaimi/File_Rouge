@extends('layouts.back-office')

@section('content')

@include('layouts.admin-sidebar')

<!-- Contenu principal -->
<main class="ml-64 p-6">



    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold mt-8 mb-4">Liste des Utilisateurs</h2>
        <button class="bg-blue-500 text-white px-3 py-2 rounded"><a href="{{ route('admin.users.create') }}">Ajouter un Utilisateur</a></button>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 border">ID</th>
                    <th class="p-3 border">Nom</th>
                    <th class="p-3 border">Email</th>
                    <th class="p-3 border">Rôle</th>
                    <th class="p-3 border">Mot de passe</th>
                    <th class="p-3 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($users->count() > 0)
                    @foreach ($users as $user)
                        <tr class="text-center">
                            <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.users.show', $user) }}">#{{ $user->id }}</a></td>
                            <td class="p-3 border">{{ $user->name }}</td>
                            <td class="p-3 border">{{ $user->email }}</td>
                            <td class="p-3 border text-blue-500 font-semibold">{{ $user->role }}</td>
                            <td class="p-3 border text-gray-500 italic">{{ Str::limit($user->password,15) }}</td>
                            <td class="p-3 border">
                                <button class="bg-blue-500 text-white px-3 py-1 rounded"><a href="{{ route('admin.users.edit', $user) }}">Modifier</a></button>
                                <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No Users Yet</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</main>

@endsection
