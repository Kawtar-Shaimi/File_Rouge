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

    <!-- Dashboard -->
    <h1 class="text-3xl font-bold mb-6">Tableau de Bord</h1>
    <div class="grid grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h3 class="text-xl font-bold">Utilisateurs</h3>
            <p class="text-3xl text-blue-500 font-bold">{{ $user_count }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h3 class="text-xl font-bold">Produits</h3>
            <p class="text-3xl text-green-500 font-bold">{{ $product_count }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h3 class="text-xl font-bold">Commandes</h3>
            <p class="text-3xl text-red-500 font-bold">{{ $order_count }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h3 class="text-xl font-bold">Catégories</h3>
            <p class="text-3xl text-yellow-500 font-bold">{{ $category_count }}</p>
        </div>
    </div>

    <!-- Tableau des Payments -->
    <h2 class="text-2xl font-bold mt-8 mb-4">Liste des Payments</h2>
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
                @if ($payments->count() > 0)
                    @foreach ($payments as $payment)
                        <tr class="text-center">
                            <td class="p-3 border underline italic hover:text-blue-400"><a href="{{ route('admin.payments.show', $payment) }}">#{{ $payment->id }}</a></td>
                            <td class="p-3 border">{{ $payment->order->user->name }}</td>
                            <td class="p-3 border">{{ $payment->order->user->email }}</td>
                            <td class="p-3 border text-green-600 font-bold">${{ $payment->amount }}</td>
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
                                <button class="bg-blue-500 text-white px-3 py-1 rounded"><a href="{{ route('admin.payments.edit', $payment) }}">Modifier</a></button>
                                <form action="{{ route('admin.payments.delete', $payment) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                                </form>
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
    </div>

</main>

@endsection
