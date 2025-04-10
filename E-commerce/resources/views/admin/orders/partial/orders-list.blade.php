<table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-3 border">ID</th>
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
                <tr class="text-center">
                    <td class="p-3 border underline italic hover:text-blue-400"><a
                            href="{{ route('admin.orders.show', $order->uuid) }}">#{{ $order->uuid }}</a></td>
                    <td class="p-3 border underline italic hover:text-blue-400"><a
                            href="{{ route('admin.orders.show', $order->uuid) }}">#{{ $order->order_number }}</a></td>
                    <td class="p-3 border">{{ $order->client->name }}</td>
                    <td class="p-3 border">{{ $order->client->email }}</td>
                    <td
                        class="p-3 border font-bold {{ $order->payment->status === 'paid' ? 'text-green-600' : ($order->payment->status === 'failed' ? 'text-red-600' : 'text-black') }}">
                        ${{ $order->total_amount }}</td>
                    <td class="p-3 border">
                        @if ($order->status == 'pending')
                            <span class="bg-yellow-400 text-white px-3 py-1 rounded">{{ $order->status }}</span>
                        @elseif ($order->status == 'in shipping')
                            <span class="bg-blue-400 text-white px-3 py-1 rounded">{{ $order->status }}</span>
                        @elseif ($order->status == 'completed')
                            <span class="bg-green-400 text-white px-3 py-1 rounded">{{ $order->status }}</span>
                        @else
                            <span class="bg-red-400 text-white px-3 py-1 rounded">{{ $order->status }}</span>
                        @endif
                    </td>
                    <td class="p-3 border">
                        <div class="flex justify-center items-center space-x-2">
                            @if ($order->status !== 'completed' && $order->status !== 'cancelled')
                                <a href="{{ route('admin.orders.edit', $order->uuid) }}"
                                    class="bg-blue-500 text-white px-3 py-1 rounded">Update</a>
                            @endif
                            <form id="delete-form-{{ $order->uuid }}"
                                action="{{ route('admin.orders.delete', $order->uuid) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button id="delete-{{ $order->uuid }}" type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded"
                                    onclick="showDeleteConfirmation(event, '{{ $order->uuid }}')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No Orders Yet</td>
            </tr>
        @endif
    </tbody>
</table>
<div id="pagination" class="mt-4">
    {{ $orders->links() }}
</div>
