@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16">
    <h1 class="text-3xl font-bold text-white mb-8">Products</h1>
    <div class="mt-8 bg-gray-800 p-6 rounded-lg">
        <table class="w-full text-white">
            <thead>
                <tr>
                    <th class="border-b border-gray-700 p-4 text-left">Name</th>
                    <th class="border-b border-gray-700 p-4 text-left">Description</th>
                    <th class="border-b border-gray-700 p-4 text-left">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td class="border-b border-gray-700 p-4">{{ $product->name }}</td>
                    <td class="border-b border-gray-700 p-4">{{ $product->description }}</td>
                    <td class="border-b border-gray-700 p-4">{{ $product->price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection