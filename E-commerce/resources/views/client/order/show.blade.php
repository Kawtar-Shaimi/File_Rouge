@extends('layouts.front-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
@endsection

@section('content')

<div class="container mx-auto p-8">
    <div class="w-11/12 mx-auto">
        <div class="mt-10 flex justify-between">
            <div class="max-w-lg mx-auto">
                <h2 class="text-4xl font-bold text-center mb-6 text-gray-800">Order Informations</h2>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <table class="w-full border-collapse">
                        <tr>
                            <td class="p-3 border">Order Number</td>
                            <td class="p-3 border">#{{ $order->order_number }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Order Total</td>
                            <td class="p-3 border">{{ $order->total_amount }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Order Status</td>
                            <td class="p-3 border">{{ $order->status }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Order Payment Status</td>
                            <td class="p-3 border">{{ $order->payment->status }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Order Date</td>
                            <td class="p-3 border">{{ $order->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Last Update</td>
                            <td class="p-3 border">{{ $order->updated_at }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="max-w-lg mx-auto">
                <h2 class="text-4xl font-bold text-center mb-6 text-gray-800">Shipping Informations</h2>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <table class="w-full border-collapse">
                        <tr>
                            <td class="p-3 border">Shipping Name</td>
                            <td class="p-3 border">{{ $order->client->name }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Shipping Email</td>
                            <td class="p-3 border">{{ $order->shipping_email }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Shipping Phone</td>
                            <td class="p-3 border">{{ $order->shipping_phone }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Shipping Address</td>
                            <td class="p-3 border">{{ $order->shipping_address}}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Shipping Postal Code</td>
                            <td class="p-3 border">{{ $order->shipping_postal_code}}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Shipping City</td>
                            <td class="p-3 border">{{ $order->shipping_city}}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Shipping Country</td>
                            <td class="p-3 border">{{ $order->shipping_country}}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">Payment Method</td>
                            <td class="p-3 border">{{ $order->payment_method }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-10">
            <div class="w-full">
                <h2 class="text-4xl font-bold text-center mb-6 text-gray-800">Order Books</h2>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-3 border">Nom</th>
                                <th class="p-3 border">Description</th>
                                <th class="p-3 border">Prix</th>
                                <th class="p-3 border">Catégorie</th>
                                <th class="p-3 border">Quantity</th>
                                <th class="p-3 border">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($order->orderBooks->count() > 0)
                                @foreach ($order->orderBooks as $orderBook)
                                    <tr class="text-center">
                                        <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('books.show', $orderBook->book->uuid) }}">{{ $orderBook->book->name }}</a></td>
                                        <td class="p-3 border truncate w-40">{{ Str::limit($orderBook->book->description, 15) }}</td>
                                        <td class="p-3 border text-green-600 font-bold">${{ $orderBook->book->price }}</td>
                                        <td class="p-3 border">{{ $orderBook->book->category->name }}</td>
                                        <td class="p-3 border">{{ $orderBook->quantity }}</td>
                                        <td class="p-3 border text-green-600 font-bold">${{ $orderBook->total }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No Books In This Order</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
