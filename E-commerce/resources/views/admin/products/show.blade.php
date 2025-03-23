@extends('layouts.app')

@section('content')

@include('layouts.admin-sidebar')

<div class="container w-5/6 ms-auto p-6">
    <div class=" max-w-4xl mx-auto">
        <div class="mt-10">
            <h2 class="text-4xl font-bold text-center mb-6 text-gray-800">Product Informations</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <table class="w-full border-collapse">
                    <tr>
                        <td class="p-3 border">Product ID</td>
                        <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.products.show', $product) }}">#{{ $product->id }}</a></td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Product Name</td>
                        <td class="p-3 border">{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Product Description</td>
                        <td class="p-3 border">{{ $product->description }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Product Category ID</td>
                        <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.categories.show', $product->category) }}">#{{ $product->category->id }}</a></td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Product Category Name</td>
                        <td class="p-3 border">{{ $product->category->name }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Product Price</td>
                        <td class="p-3 border">{{ $product->price }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Product Stock</td>
                        <td class="p-3 border">{{ $product->stock }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Product Image URL</td>
                        <td class="p-3 border">{{ $product->image }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Product Image Preview</td>
                        <td class="p-3 border"><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"></td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Product Publisher ID</td>
                        <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.users.show', $product->publisher) }}">#{{ $product->publisher->id }}</a></td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Product Publisher Name</td>
                        <td class="p-3 border">{{ $product->publisher->name }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Creationt Date</td>
                        <td class="p-3 border">{{ $product->created_at }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Update Date</td>
                        <td class="p-3 border">{{ $product->updated_at }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Actions</td>
                        <td class="p-3 border">
                            <form action="{{ route('admin.products.delete', $product) }}" method="POST" class="inline">
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
