<table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-3 border">ID</th>
            <th class="p-3 border">Order Number</th>
            <th class="p-3 border">Client</th>
            <th class="p-3 border">Email</th>
            <th class="p-3 border">Total Amount</th>
            <th class="p-3 border">Statut</th>
            <th class="p-3 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if ($payments->count() > 0)
            @foreach ($payments as $payment)
                <tr class="text-center">
                    <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.payments.show', $payment->uuid) }}">#{{ $payment->uuid }}</a></td>
                    <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.orders.show', $payment->order->uuid) }}">#{{ $payment->order->order_number }}</a></td>
                    <td class="p-3 border">{{ $payment->order->client->name }}</td>
                    <td class="p-3 border">{{ $payment->order->client->email }}</td>
                    <td class="p-3 border font-bold {{ $payment->status == "paid" ? "text-green-600" : ($payment->status == "failed" ? "text-red-600" : "text-black") }}">${{ $payment->amount }}</td>
                    <td class="p-3 border">
                        @if ($payment->status == 'pending')
                            <span class="bg-yellow-400 text-white px-3 py-1 rounded">{{ $payment->status }}</span>
                        @elseif ($payment->status == 'paid')
                            <span class="bg-green-400 text-white px-3 py-1 rounded">{{ $payment->status }}</span>
                        @else
                            <span class="bg-red-400 text-white px-3 py-1 rounded">{{ $payment->status }}</span>
                        @endif
                    </td>
                    <td class="p-3 border">
                        <div class="flex justify-center items-center space-x-2">
                            @if ($payment->status === 'pending')
                                <button class="bg-blue-500 text-white px-3 py-1 rounded"><a href="{{ route('admin.payments.edit', $payment->uuid) }}">Update</a></button>
                            @endif
                            <form id="delete-form-{{ $payment->uuid }}" action="{{ route('admin.payments.delete', $payment->uuid) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button id="delete-{{ $payment->uuid }}" type="submit" class="bg-red-500 text-white px-3 py-1 rounded" onclick="showDeleteConfirmation(event, '{{ $payment->uuid }}')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No Payments Yet</td>
            </tr>
        @endif
    </tbody>
</table>
<div id="pagination" class="mt-4">
    {{ $payments->links() }}
</div>
