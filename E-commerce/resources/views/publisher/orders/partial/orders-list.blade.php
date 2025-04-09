<table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-3 border">Order Number</th>
            <th class="p-3 border">Client</th>
            <th class="p-3 border">Email</th>
            <th class="p-3 border">Total Amount</th>
            <th class="p-3 border">Status</th>
            <th class="p-3 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($orders->count() > 0)
            @foreach ($orders as $order)
                <tr class="text-center border">
                    <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('publisher.orders.show', $order->order->uuid) }}">#{{ $order->order->order_number }}</a></td>
                    <td class="p-3 border">{{ $order->order->client->name }}</td>
                    <td class="p-3 border">{{ $order->order->client->email }}</td>
                    <td class="p-3 border font-bold {{ $order->order->payment->status === 'paid' ? 'text-green-600' : ($order->order->payment->status === 'failed' ? 'text-red-600' : 'text-black') }}">${{ $order->order->total_amount }}</td>
                    <td class="p-3 border">
                        @if (!$order->is_cancelled)
                            @if ($order->order->status == 'pending')
                                <span class="bg-yellow-400 text-white px-3 py-1 rounded">{{ $order->order->status }}</span>
                            @elseif ($order->order->status == 'in shipping')
                                <span class="bg-blue-400 text-white px-3 py-1 rounded">{{ $order->order->status }}</span>
                            @elseif ($order->order->status == 'completed')
                                <span class="bg-green-400 text-white px-3 py-1 rounded">{{ $order->order->status }}</span>
                            @else
                                <span class="bg-red-400 text-white px-3 py-1 rounded">{{ $order->order->status }}</span>
                            @endif
                        @else
                            <span class="bg-red-400 text-white px-3 py-1 rounded">Cancelled</span>
                        @endif
                    </td>
                    <td class="p-3 flex gap-x-2 justify-center items-center">
                        <a href="{{ route('publisher.orders.show', $order->order->uuid) }}"
                            class="px-4 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition duration-300">Show</a>
                        @if (!$order->is_cancelled)
                            <button id="show-modal-{{ $order->order->uuid }}" type="button" onclick="showCancelModal('{{ $order->order->uuid }}')"
                                class="px-4 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition duration-300">Cancel</button>
                        @endif
                    </td>
                </tr>
                <!-- Cancel Modal -->
                <div id="cancel-modal-{{ $order->order->uuid }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center hidden">
                    <div class="w-2/4 bg-white px-14 py-16 rounded-lg shadow-lg">
                        <form action="{{ route('publisher.orders.cancel', $order->order->uuid) }}" method="post">
                            @csrf
                            <h3 class="text-2xl text-center font-semibold text-gray-800">Cancel Order</h3>
                            <div class="mb-4">
                                <label for="reason" class="text-sm font-medium text-gray-700">Reason:</label>
                                <input type="text" id="reason" name="reason"
                                    class="w-full p-3 border rounded-lg mt-1" required>
                            </div>
                            <p id="reason-error" class="text-red-500 text-xs mt-1"></p>
                            @error('reason')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <div class="mt-4 flex justify-center items-center space-x-2">
                                <button id="close-modal-{{ $order->order->uuid }}" type="button" onclick="closeCancelModal('{{ $order->order->uuid }}')"
                                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-700 transition">Close</button>
                                <button id="cancel-order" type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700 transition">Cancel Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No Orders Yet</td>
            </tr>
        @endif
    </tbody>
</table>
<div id="pagination" class="mt-4">
    {{ $orders->links() }}
</div>
