@extends('layouts.app')

@section('content')

@include('layouts.publisher-sidebar')

<div class="container w-5/6 ms-auto p-6">

    <!-- Statistiques -->
    <div class="grid md:grid-cols-2 gap-6 mb-8">
        <!-- Total Produits -->
        <div class="bg-white p-6 rounded-lg shadow-lg flex items-center">
            <div class="p-4 bg-blue-500 text-white rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 3h18v18H3z"></path>
                    <path d="M16 3v18"></path>
                    <path d="M8 3v18"></path>
                    <path d="M3 10h18"></path>
                    <path d="M3 16h18"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold">Total Produits Publiés</h3>
                <p class="text-2xl font-bold text-gray-700">{{ $products_count }}</p> <!-- Valeur dynamique -->
            </div>
        </div>

        <!-- Total Commandes -->
        <div class="bg-white p-6 rounded-lg shadow-lg flex items-center">
            <div class="p-4 bg-green-500 text-white rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 9l7 7 7-7"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold">Total Commandes Reçues</h3>
                <p class="text-2xl font-bold text-gray-700">{{ $orders_count }}</p> <!-- Valeur dynamique -->
            </div>
        </div>
    </div>

    <!-- Tableau des Commandes -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-semibold mb-4">Commandes Passées</h3>
        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID Commande</th>
                    <th class="py-3 px-6 text-left">Client</th>
                    <th class="py-3 px-6 text-left">Total</th>
                    <th class="py-3 px-6 text-left">Statut</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @if ($orders_count > 0)
                    @foreach ($orders as $order)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 hover:underline">#{{ $order->order->order_number }}</td>
                            <td class="py-3 px-6">{{ $order->order->user->name }}</td>
                            <td class="py-3 px-6">{{ $order->order->total_amount }} DH</td>
                            <td class="py-3 px-6">
                                <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">{{ $order->order->status }}</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <a href="" class="text-blue-500 hover:underline">Voir</a> |
                                <a href="" class="text-red-500 hover:underline">Annuler</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No Commands Yet</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection
