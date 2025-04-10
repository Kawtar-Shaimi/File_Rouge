@extends('layouts.back-office')

@section('title', 'Order Informations')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/publisher/orders/cancelOrder.js'])
@endsection

@section('content')
    @include('layouts.publisher-sidebar')

    <div class="container w-5/6 ms-auto p-6">
        <div class="w-11/12 mx-auto">
            <div class="mt-10 flex justify-between">
                <div class="max-w-lg mx-auto">
                    <h2 class="text-4xl font-bold text-center mb-6 text-gray-800">Order Informations</h2>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <table class="w-full border-collapse">
                            <tr>
                                <td class="p-3 border">Order Number:</td>
                                <td class="p-3 border underline italic hover:text-blue-400"><a
                                        href="{{ route('publisher.orders.show', $order->order->uuid) }}">#{{ $order->order->order_number }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-3 border">Order Total:</td>
                                <td class="p-3 border">${{ $order->total }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 border">Order Status:</td>
                                <td class="p-3 border">{{ $order->is_cancelled ? 'Cancelled' : $order->order->status }}</td>
                            </tr>
                            @if ($order->is_cancelled)
                                <tr>
                                    <td class="p-3 border">Cancellation Reason:</td>
                                    <td class="p-3 border">{{ $order->cancellation_reason }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="p-3 border">Order Payment Status:</td>
                                <td class="p-3 border">{{ $order->order->payment->status }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 border">Order Date:</td>
                                <td class="p-3 border">{{ $order->order->created_at }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 border">Last Update:</td>
                                <td class="p-3 border">{{ $order->order->updated_at }}</td>
                            </tr>
                            @if (!$order->is_cancelled)
                                <tr>
                                    <td class="p-3 border">Action:</td>
                                    <td class="p-3 border flex gap-x-2 justify-center items-center">
                                        <button id="show-modal-{{ $order->order->uuid }}" type="button"
                                            onclick="showCancelModal('{{ $order->order->uuid }}')"
                                            class="px-4 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition duration-300">Cancel</button>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
                <div class="max-w-lg mx-auto">
                    <h2 class="text-4xl font-bold text-center mb-6 text-gray-800">Shipping Informations</h2>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <table class="w-full border-collapse">
                            <tr>
                                <td class="p-3 border">Client Name:</td>
                                <td class="p-3 border">{{ $order->order->client->name }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 border">Shipping Email:</td>
                                <td class="p-3 border">{{ $order->order->shipping_email }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 border">Shipping Phone:</td>
                                <td class="p-3 border">{{ $order->order->shipping_phone }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 border">Shipping Address:</td>
                                <td class="p-3 border">{{ $order->order->shipping_address }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 border">Shipping Postal Code:</td>
                                <td class="p-3 border">{{ $order->order->shipping_postal_code }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 border">Shipping City:</td>
                                <td class="p-3 border">{{ $order->order->shipping_city }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 border">Shipping Country:</td>
                                <td class="p-3 border">{{ $order->order->shipping_country }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 border">Payment Method:</td>
                                <td class="p-3 border">{{ $order->order->payment_method }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-10">
                <div class="w-full">
                    <h2 class="text-4xl font-bold text-center mb-6 text-gray-800">Order Book:</h2>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="p-3 border">Name</th>
                                    <th class="p-3 border">Description</th>
                                    <th class="p-3 border">Price</th>
                                    <th class="p-3 border">Category</th>
                                    <th class="p-3 border">Quantity</th>
                                    <th class="p-3 border">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td class="p-3 border underline italic hover:text-blue-400"><a
                                            href="{{ route('publisher.books.show', $order->book->uuid) }}">#{{ $order->book->name }}</a>
                                    </td>
                                    <td class="p-3 border truncate w-40">{{ Str::limit($order->book->description, 15) }}
                                    </td>
                                    <td class="p-3 border text-green-600 font-bold">${{ $order->book->price }}</td>
                                    <td class="p-3 border">{{ $order->book->category->name }}</td>
                                    <td class="p-3 border">{{ $order->quantity }}</td>
                                    <td class="p-3 border text-green-600 font-bold">${{ $order->total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Modal -->
    <div id="cancel-modal-{{ $order->order->uuid }}"
        class="fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center hidden">
        <div class="w-2/4 bg-white px-14 py-16 rounded-lg shadow-lg">
            <form id="cancel-form" action="{{ route('publisher.orders.cancel', $order->order->uuid) }}" method="post">
                @csrf
                <h3 class="text-2xl text-center font-semibold text-gray-800">Cancel Order</h3>
                <div class="mb-4">
                    <label for="reason" class="text-sm font-medium text-gray-700">Reason:</label>
                    <input type="text" id="reason" name="cancellation_reason"
                        class="w-full p-3 border rounded-lg mt-1" required>
                </div>
                <p id="reason-error" class="text-red-500 text-xs mt-1"></p>
                @error('cancellation_reason')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <div class="mt-4 flex justify-center items-center space-x-2">
                    <button id="close-modal-{{ $order->order->uuid }}" type="button"
                        onclick="closeCancelModal('{{ $order->order->uuid }}')"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-700 transition">Close</button>
                    <button id="cancel-order" type="submit"
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700 transition">Cancel Order</button>
                </div>
            </form>
        </div>
    </div>
@endsection
