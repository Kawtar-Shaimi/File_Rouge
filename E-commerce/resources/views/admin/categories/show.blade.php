@extends('layouts.back-office')

@section('content')

@include('layouts.admin-sidebar')

<div class="container w-5/6 ms-auto p-6">
    <div class=" max-w-4xl mx-auto">
        <div class="mt-10">
            <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Category Informations</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <table class="w-full border-collapse">
                    <tr>
                        <td class="p-3 border">Category ID</td>
                        <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.categories.show', $category) }}">#{{ $category->id }}</a></td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Category Name</td>
                        <td class="p-3 border">{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Category Description</td>
                        <td class="p-3 border">{{ $category->description }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Created By</td>
                        <td class="p-3 border">{{ $category->admin->name }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Creationt Date</td>
                        <td class="p-3 border">{{ $category->created_at }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Update Date</td>
                        <td class="p-3 border">{{ $category->updated_at }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Actions</td>
                        <td class="p-3 border">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded"><a href="{{ route('admin.categories.edit', $category) }}">Update</a></button>
                            <form action="{{ route('admin.categories.delete', $category) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
