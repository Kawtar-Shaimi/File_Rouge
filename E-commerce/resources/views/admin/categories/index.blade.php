@extends('layouts.back-office')

@section('content')

@include('layouts.admin-sidebar')

<!-- Contenu principal -->
<main class="ml-64 p-6">



    <!-- Tableau des Catégories -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold mt-8 mb-4">Liste des Catégories</h2>
        <button class="bg-blue-500 text-white px-3 py-2 rounded"><a href="{{ route('admin.categories.create') }}">Ajouter un Catégorie</a></button>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 border">ID</th>
                    <th class="p-3 border">Nom</th>
                    <th class="p-3 border">Description</th>
                    <th class="p-3 border">Created By</th>
                    <th class="p-3 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($categories->count() > 0)
                    @foreach ($categories as $category)
                        <tr class="text-center">
                            <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.categories.show', $category) }}">#{{ $category->id }}</a></td>
                            <td class="p-3 border">{{ $category->name }}</td>
                            <td class="p-3 border">{{ Str::limit($category->description, 15) }}</td>
                            <td class="p-3 border">{{ $category->admin->name }}</td>
                            <td class="p-3 border">
                                <button class="bg-blue-500 text-white px-3 py-1 rounded"><a href="{{ route('admin.categories.edit', $category) }}">Modifier</a></button>
                                <form action="{{ route('admin.categories.delete', $category) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No Categories Yet</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</main>

@endsection
