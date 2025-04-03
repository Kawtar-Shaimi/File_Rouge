@extends('layouts.back-office')

@section('content')

@include('layouts.admin-sidebar')

<div class="container w-5/6 ms-auto p-6">
    <div class=" max-w-4xl mx-auto">
        <div class="mt-10">
            <h2 class="text-4xl font-bold text-center mb-6 text-gray-800">Book Informations</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <table class="w-full border-collapse">
                    <tr>
                        <td class="p-3 border">Book ID</td>
                        <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.books.show', $book) }}">#{{ $book->id }}</a></td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Book Name</td>
                        <td class="p-3 border">{{ $book->name }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Book Description</td>
                        <td class="p-3 border">{{ $book->description }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Book Category ID</td>
                        <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.categories.show', $book->category) }}">#{{ $book->category->id }}</a></td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Book Category Name</td>
                        <td class="p-3 border">{{ $book->category->name }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Book Price</td>
                        <td class="p-3 border">{{ $book->price }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Book Stock</td>
                        <td class="p-3 border">{{ $book->stock }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Book Image URL</td>
                        <td class="p-3 border">{{ $book->image }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Book Image Preview</td>
                        <td class="p-3 border"><img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}"></td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Book Publisher ID</td>
                        <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.users.show', $book->publisher) }}">#{{ $book->publisher->id }}</a></td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Book Publisher Name</td>
                        <td class="p-3 border">{{ $book->publisher->name }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Creationt Date</td>
                        <td class="p-3 border">{{ $book->created_at }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Update Date</td>
                        <td class="p-3 border">{{ $book->updated_at }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Actions</td>
                        <td class="p-3 border">
                            <form action="{{ route('admin.books.delete', $book) }}" method="POST" class="inline">
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
