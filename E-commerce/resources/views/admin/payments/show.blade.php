@extends('layouts.back-office')

@section('content')

@include('layouts.admin-sidebar')

<div class="container w-5/6 ms-auto p-6">
    <div class="max-w-lg mx-auto">
        <div class="mt-10">
            <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Payment Informations</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <table class="w-full border-collapse">
                    <tr>
                        <td class="p-3 border">Payment ID</td>
                        <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.payments.show', $payment) }}">#{{ $payment->id }}</a></td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Order ID</td>
                        <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.orders.show', $payment->order) }}">#{{ $payment->order->id }}</a></td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Order Number</td>
                        <td class="p-3 border">#{{ $payment->order->order_number }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Order Status</td>
                        <td class="p-3 border">
                            @if ($payment->order->status == 'pending')
                                <span class="bg-yellow-400 text-white px-3 py-1 rounded">{{ $payment->order->status }}</span>
                            @elseif ($payment->order->status == 'in shipping')
                                <span class="bg-blue-400 text-white px-3 py-1 rounded">{{ $payment->order->status }}</span>
                            @elseif ($payment->order->status == 'completed')
                                <span class="bg-green-400 text-white px-3 py-1 rounded">{{ $payment->order->status }}</span>
                            @else
                                <span class="bg-red-400 text-white px-3 py-1 rounded">{{ $payment->order->status }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Client ID</td>
                        <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.users.show', $payment->order->client) }}">#{{ $payment->order->client->id }}</a></td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Client Name</td>
                        <td class="p-3 border">{{ $payment->order->client->name }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Client Email</td>
                        <td class="p-3 border">{{ $payment->order->client->email }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Client Phone</td>
                        <td class="p-3 border">{{ $payment->order->client->phone }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Payment Amount</td>
                        <td class="p-3 border text-green-600 font-bold">${{ $payment->amount }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Payment Method</td>
                        <td class="p-3 border">{{ $payment->method }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Payment Status</td>
                        <td class="p-3 border">
                            @if ($payment->status == 'pending')
                                <span class="bg-yellow-400 text-white px-3 py-1 rounded">{{ $payment->status }}</span>
                            @elseif ($payment->status == 'paid')
                                <span class="bg-green-400 text-white px-3 py-1 rounded">{{ $payment->status }}</span>
                            @else
                                <span class="bg-red-400 text-white px-3 py-1 rounded">{{ $payment->status }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Creationt Date</td>
                        <td class="p-3 border">{{ $payment->created_at }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Update Date</td>
                        <td class="p-3 border">{{ $payment->updated_at }}</td>
                    </tr>
                    <tr>
                        <td class="p-3 border">Actions</td>
                        <td class="p-3 border">
                            <button class="bg-blue-500 text-white px-3 py-1 rounded"><a href="{{ route('admin.payments.edit', $payment) }}">Update</a></button>
                            <form action="{{ route('admin.payments.delete', $payment) }}" method="POST" class="inline">
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
