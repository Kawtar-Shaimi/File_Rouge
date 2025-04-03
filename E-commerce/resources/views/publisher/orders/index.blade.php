@extends('layouts.back-office')

@section('content')

@include('layouts.publisher-sidebar')

<!-- Contenu principal -->
<main class="ml-64 p-6">



    <!-- Tableau des Commandes -->
    <h2 class="text-2xl font-bold mt-8 mb-4">Liste des Commandes</h2>
    <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 border">ID</th>
                    <th class="py-3 px-6 text-left">ID Book</th>
                    <th class="p-3 border">Client</th>
                    <th class="p-3 border">Email</th>
                    <th class="p-3 border">Montant Total</th>
                    <th class="p-3 border">Statut</th>
                    <th class="p-3 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($orders->count() > 0)
                    @foreach ($orders as $order)
                        <tr class="text-center">
                            <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('publisher.orders.show', $order->order->order_number) }}">#{{ $order->order->order_number }}</a></td>
                            <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('publisher.books.show', $order->book) }}">#{{ $order->book->id }}</a></td>
                            <td class="p-3 border">{{ $order->order->client->name }}</td>
                            <td class="p-3 border">{{ $order->order->client->email }}</td>
                            <td class="p-3 border font-bold {{ $order->order->payment->status === 'paid' ? 'text-green-600' : ($order->order->payment->status === 'failed' ? 'text-red-600': 'text-black') }}">${{ $order->total }}</td>
                            <td class="p-3 border">
                                @if ($order->order->status == 'pending')
                                    <span class="bg-yellow-400 text-white px-3 py-1 rounded">{{ $order->order->status }}</span>
                                @elseif ($order->order->status == 'in shipping')
                                    <span class="bg-blue-400 text-white px-3 py-1 rounded">{{ $order->order->status }}</span>
                                @elseif ($order->order->status == 'completed')
                                    <span class="bg-green-400 text-white px-3 py-1 rounded">{{ $order->order->status }}</span>
                                @else
                                    <span class="bg-red-400 text-white px-3 py-1 rounded">{{ $order->order->status }}</span>
                                @endif
                            </td>
                            <td class="p-3 border text-center">
                                <a href="{{ route('publisher.books.show', $order->book) }}" class="text-blue-500 hover:underline">Show</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No Orders Yet</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</main>

@endsection
