@extends('layouts.front-office')

@section('title', 'Order Confirmed')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <h2 class="text-3xl font-bold text-teal-600 mb-6">Order Confirmed!</h2>
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-16 h-16 mx-auto text-teal-500">
                    <path fill-rule="evenodd"
                        d="M16.293 5.293a1 1 0 00-1.414 0L8 11.586 4.121 7.707a1 1 0 10-1.414 1.414l4.5 4.5a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-xl font-semibold text-gray-700 mb-6">Thank you for your purchase! Your order has been
                successfully processed.</p>
            <p class="text-lg font-semibold text-gray-700 mb-2">Your order code:</p>
            <p class="text-xl font-bold text-teal-600 mb-8 p-2 bg-teal-50 rounded-lg inline-block">{{ $order_number }}</p>
            <div>
                <a href="{{ route('home') }}">
                    <button class="bg-gradient-to-r from-teal-500 to-teal-600 text-white font-bold py-3 px-6 rounded-lg hover:from-teal-600 hover:to-teal-700 transition duration-150 shadow-md mr-4">
                        Return to Home
                    </button>
                </a>
                <a href="{{ route('client.orders.show', ['uuid' => session('last_order_uuid') ?? '']) }}">
                    <button class="bg-white border border-teal-500 text-teal-600 font-bold py-3 px-6 rounded-lg hover:bg-teal-50 transition duration-150 shadow-sm">
                        View Order Details
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection
