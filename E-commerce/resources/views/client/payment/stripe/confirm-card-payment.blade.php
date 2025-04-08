@extends('layouts.front-office')

@section('head')
    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
])
@endsection

@section('content')

<div class="container mx-auto p-6">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold mb-6 text-center">Complete Payment</h2>
        <div id="card-section" class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Credit Card Info</label>
            <div id="card-element" class="border p-3 rounded-md shadow-sm bg-white"></div>
            <div id="card-errors" class="text-red-500 mt-2"></div>
        </div>
        <!-- Bouton de paiement -->
        <button id="pay-button" class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg mt-6 hover:bg-blue-600">
            Pay
        </button>
    </div>
</div>
@php
    $paymentIntent = session('payment_intent');
    $order = session('order');
@endphp
<script src="https://js.stripe.com/v3/"></script>
<script>
    $(document).ready(async function() {
        const stripe = await Stripe('{{ env('STRIPE_KEY') }}'); // Your Stripe public key
        const elements = await stripe.elements();
        const card = await elements.create('card');
        await card.mount('#card-element');

        const paymentIntentClientSecret = '{{ $paymentIntent->client_secret }}';

        $('#pay-button').on('click', async (event) => {
            event.preventDefault();

            const { error, paymentIntent } = await stripe.confirmCardPayment(paymentIntentClientSecret, {
                payment_method: {
                    card: card,
                    billing_details: {
                        name: "{{ $order['shipping_name'] }}",
                        email: "{{ $order['shipping_email'] }}",
                        phone: "{{ $order['shipping_phone'] }}",
                        address: {
                            line1: "{{ $order['shipping_address']}}",
                            city: "{{ $order['shipping_city'] }}",
                            country: "{{ substr($order['shipping_country'], 0, 2) }}",
                            postal_code: "{{ $order['shipping_postal_code'] }}"
                        }
                    }
                },
            });

            if (error) {
                window.location.href = "{{ route('client.payment.online.failed') }}";
            } else if (paymentIntent.status === 'succeeded') {
                window.location.href = "{{ route('client.payment.online.success') }}";
            }
        });
    })
</script>

@endsection
