@extends('layouts.app')

@section('content')

@include('layouts.admin-sidebar')

<!-- Contenu principal -->
<main class="ml-64 p-6">

    @if (session()->has('success'))
        <x-alert type="success" :message="session('success')" />
    @elseif (session()->has('error'))
        <x-alert type="error" :message="session('error')" />
    @endif

    <!-- Tableau des Commandes -->
    <h2 class="text-2xl font-bold mt-8 mb-4">Liste des Commandes</h2>
    <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 border">ID</th>
                    <th class="p-3 border">Client</th>
                    <th class="p-3 border">Email</th>
                    <th class="p-3 border">Montant Total</th>
                    <th class="p-3 border">Statut</th>
                    <th class="p-3 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($orders->count())
                    @foreach ($orders as $order)
                        <tr class="text-center">
                            <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.orders.show', $order) }}">#{{ $order->id }}</a></td>
                            <td class="p-3 border">{{ $order->user->name }}</td>
                            <td class="p-3 border">{{ $order->user->email }}</td>
                            <td class="p-3 border {{ $order->payment->status === 'paid' ? 'text-green-600 font-bold' : 'text-red-600 font-bold' }}">${{ $order->total_amount }}</td>
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
                                <a href="{{ route('admin.orders.edit', $order) }}" class="bg-blue-500 text-white px-3 py-1 rounded">Modifier</a>
                                <form action="{{ route('admin.orders.delete', $order) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                                </form>
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
