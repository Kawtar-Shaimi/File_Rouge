@extends('layouts.app')

@section('content')

@include('layouts.admin-sidebar')

<div class="container w-5/6 ms-auto p-6">
    <div class="w-11/12 mx-auto">
        <div class="mt-10 flex justify-between">
            <div class="max-w-lg mx-auto">
                <h2 class="text-4xl font-bold text-center mb-6 text-gray-800">Order Informations</h2>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <table class="w-full border-collapse">
                        <tr>
                            <td class="p-3 border">Order ID</td>
                            <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.orders.show', $order) }}">#{{ $order->id }}</a></td>
                        </tr>
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
                            <td class="p-3 border">Order Payment ID</td>
                            <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.payments.show', $order->payment) }}">#{{ $order->payment->id }}</td>
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
                        <tr>
                            <td class="p-3 border">Actions</td>
                            <td class="p-3 border">
                                <form action="{{ route('admin.orders.delete', $order) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="max-w-lg mx-auto">
                <h2 class="text-4xl font-bold text-center mb-6 text-gray-800">Shipping Informations</h2>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <table class="w-full border-collapse">
                        <tr>
                            <td class="p-3 border">User ID</td>
                            <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.users.show', $order->user) }}">#{{ $order->user->id }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 border">User Name</td>
                            <td class="p-3 border">{{ $order->user->name }}</td>
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
                <h2 class="text-4xl font-bold text-center mb-6 text-gray-800">Order Products</h2>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-3 border">ID</th>
                                <th class="p-3 border">Nom</th>
                                <th class="p-3 border">Description</th>
                                <th class="p-3 border">Prix</th>
                                <th class="p-3 border">Catégorie</th>
                                <th class="p-3 border">Quantity</th>
                                <th class="p-3 border">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($order->orderProducts->count() > 0)
                                @foreach ($order->orderProducts as $orderProduct)
                                    <tr class="text-center">
                                        <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.products.show', $orderProduct->product) }}">#{{ $orderProduct->product->id }}</a></td>
                                        <td class="p-3 border">{{ $orderProduct->product->name }}</td>
                                        <td class="p-3 border truncate w-40">{{ Str::limit($orderProduct->product->description, 15) }}</td>
                                        <td class="p-3 border text-green-600 font-bold">${{ $orderProduct->product->price }}</td>
                                        <td class="p-3 border">{{ $orderProduct->product->category->name }}</td>
                                        <td class="p-3 border">{{ $orderProduct->quantity }}</td>
                                        <td class="p-3 border text-green-600 font-bold">${{ $orderProduct->total }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No Products In This Order</td>
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
