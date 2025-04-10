@extends('layouts.front-office')

@section('title', 'Pay with PayPal')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')

    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
            <h2 class="text-2xl font-bold mb-6 text-center">Pay with PayPal</h2>
            <div id="paypal-button-container" class="mt-6"></div>
        </div>
    </div>
    @php
        $client_id = session('client_id');
        $order = session('order');
        $amount = $order['total_amount'];
    @endphp


    <script src="https://www.paypal.com/sdk/js?client-id={{ $client_id }}&currency=USD"></script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $amount }}'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    window.location.href = "{{ route('client.payment.online.success') }}";
                });
            },
            onCancel: function() {
                window.location.href = "{{ route('client.payment.online.cancel') }}";
            },
            onError: function() {
                window.location.href = "{{ route('client.payment.online.failed') }}";
            }
        }).render('#paypal-button-container');
    </script>

@endsection
