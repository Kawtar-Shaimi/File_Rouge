@extends('layouts.front-office')

@section('head')
    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
])
@endsection

@section('content')

    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <h2 class="text-3xl font-bold text-red-600 mb-6">Payment Failed</h2>
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-16 h-16 mx-auto text-red-500">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v4a1 1 0 102 0V7zm-1 8a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-xl font-semibold text-gray-700 mb-6">Unfortunately, your payment could not be processed.</p>
            <p class="text-xl text-gray-600 mb-6">Please try again or use a different payment method.</p>
            <div class="flex justify-center items-center space-x-4">
                <a href="{{ route('client.payment.online.try-again') }}">
                    <button class="bg-purple-400 text-white font-bold py-3 px-6 rounded-lg hover:bg-purple-600">
                        Try Again
                    </button>
                </a>
                <a href="{{ route('client.payment.online.cancel') }}">
                    <button class="bg-red-400 text-white font-bold py-3 px-6 rounded-lg hover:bg-red-600">
                        Cancel
                    </button>
                </a>
            </div>
        </div>
    </div>

@endsection