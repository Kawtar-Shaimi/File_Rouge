@extends('layouts.front-office')

@section('title', 'Payment succeed')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <h2 class="text-3xl font-bold text-green-600 mb-6">Payment succeed !</h2>
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-16 h-16 mx-auto text-green-500">
                    <path fill-rule="evenodd"
                        d="M16.293 5.293a1 1 0 00-1.414 0L8 11.586 4.121 7.707a1 1 0 10-1.414 1.414l4.5 4.5a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-xl font-semibold text-gray-700 mb-6">Thank you for your purchase ! Your payment has been
                successfully processed.</p>
            <p class="text-xl font-semibold text-gray-700 mb-6">Your order code is {{ $order->order_number }}</p>
            <a href="{{ route('home') }}">
                <button class="bg-purple-400 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-600">
                    Return to the home page
                </button>
            </a>
        </div>
    </div>
@endsection
