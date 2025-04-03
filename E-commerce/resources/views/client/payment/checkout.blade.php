@extends('layouts.front-office')

@section('head')
    @vite([
        'resources/css/app.css'
    ])
@endsection

@section('content')

<div class="container mx-auto p-6">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold mb-6 text-center">Finalisez votre commande</h2>

        <!-- Récapitulatif de la commande -->
        <div class="border-b pb-4 mb-4">
            <h3 class="text-xl font-semibold mb-4">Récapitulatif de la commande</h3>
            @if ($cart)
                @foreach ( $cart->cartBooks as $cartBook)
                    <div class="flex justify-between mb-2">
                        <span>{{ $cartBook->book->name }}:</span>
                        <span class="text-green-500">${{ number_format($cartBook->book->price * $cartBook->quantity, 2) }}</span>
                    </div>
                @endforeach
                <div class="flex justify-between font-bold text-lg">
                    <span>Total à payer:</span>
                    <span>${{ $cart->total_price }}</span>
                </div>
            @else
                <div class="flex justify-between font-bold text-lg">
                    <span>Total à payer:</span>
                    <span>0</span>
                </div>
            @endif
        </div>

        <!-- Formulaire d'adresse -->
        <h3 class="text-xl font-semibold mb-4">Adresse de livraison</h3>
        <form action="{{ route('client.makeOrder') }}" method="POST">
            <div class="space-y-4">
                @csrf
                <div>
                    <label for="shipping_name" class="block text-sm font-medium text-gray-700">Name:</label>
                    <input type="text" id="shipping_name" name="shipping_name" class="w-full p-3 border rounded-md" value="{{ old('shipping_name', Auth::guard('client')->user()->name) }}" required>
                </div>
                @error('shipping_name')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <label for="shipping_email" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" id="shipping_email" name="shipping_email" class="w-full p-3 border rounded-md" value="{{ old('shipping_email', Auth::guard('client')->user()->email) }}" required>
                </div>
                @error('shipping_email')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <label for="shipping_phone" class="block text-sm font-medium text-gray-700">Phone:</label>
                    <input type="tel" id="shipping_phone" name="shipping_phone" class="w-full p-3 border rounded-md" value="{{ old('shipping_phone', Auth::guard('client')->user()->phone) }}" required>
                </div>
                @error('shipping_phone')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <label for="shipping_address" class="block text-sm font-medium text-gray-700">Address:</label>
                    <textarea id="shipping_address" name="shipping_address" class="w-full p-3 border rounded-md" required>{{ old('shipping_address') }}</textarea>
                </div>
                @error('shipping_address')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <label for="shipping_country" class="block text-sm font-medium text-gray-700">Country:</label>
                    <select id="shipping_country" name="shipping_country" class="w-full p-3 border rounded-md" required>
                        <option selected value="">Select a country</option>
                    </select>
                </div>
                @error('shipping_country')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <label for="shipping_city" class="block text-sm font-medium text-gray-700">City:</label>
                    <select id="shipping_city" name="shipping_city" class="w-full p-3 border rounded-md" required>
                        <option selected value="">Select a city</option>
                    </select>
                </div>
                @error('shipping_city')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700">Postal Code:</label>
                    <input type="text" id="shipping_postal_code" name="shipping_postal_code" class="w-full p-3 border rounded-md" value="{{ old('shipping_postal_code') }}" required>
                </div>
                @error('shipping_postal_code')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sélection du mode de paiement -->
            <div class="mt-6">
                <h3 class="text-xl font-semibold mb-4">Payment Method:</h3>

                <div class="space-y-4">
                    <!-- PayPal -->
                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-100">
                        <input type="radio" name="payment_method" value="paypal" class="mr-3">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/PayPal_logo_2014.svg/200px-PayPal_logo_2014.svg.png" alt="PayPal" class="w-16">
                        <span class="ml-auto text-gray-600">PayPal</span>
                    </label>

                    <!-- Paiement à la livraison -->
                    <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-100">
                        <input type="radio" name="payment_method" value="in shipping" class="mr-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/2331/2331940.png" alt="In Shipping" class="w-10">
                        <span class="ml-auto text-gray-600">In Shipping</span>
                    </label>
                </div>
            </div>

            <!-- Formulaire Carte Bancaire (affiché seulement si l'option carte est sélectionnée) -->
            <div id="card-form" class="mt-6 hidden">
                <h3 class="text-lg font-semibold mb-3">Informations de votre carte</h3>
                <div class="space-y-4">
                    <input type="text" placeholder="Nom sur la carte" class="w-full p-3 border rounded-md">
                    <input type="text" placeholder="Numéro de carte" class="w-full p-3 border rounded-md">
                    <div class="flex space-x-3">
                        <input type="text" placeholder="MM/AA" class="w-1/2 p-3 border rounded-md">
                        <input type="text" placeholder="CVV" class="w-1/2 p-3 border rounded-md">
                    </div>
                </div>
            </div>

            <!-- Bouton de paiement -->
            <button type="submit" class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg mt-6 hover:bg-blue-600">
                Passer la commande
            </button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "https://countriesnow.space/api/v0.1/countries/flag/unicode",
            method: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data.data);
                var countries = [];
                $.each(data.data, function(index, country) {
                    countries.push({
                        id: country.name,
                        text: country.name
                    });
                });
                countries.sort(function(a, b) {
                    return a.text.localeCompare(b.text);
                });
                $('#shipping_country').select2({
                    placeholder: "Select a country",
                    data: countries,
                    allowClear: true
                });
                $('.select2-selection').addClass('!w-full !p-3 !border !rounded-md !h-12 !border-gray-300');
            },
            error: function() {
                console.error("Error fetching countries");
            }
        });

        var cities = [];
        $('#shipping_country').on('change', function() {
            var countryCode = $(this).val();
            console.log(countryCode);
            $('#shipping_city').empty().trigger('change');
            if (countryCode) {
                $.ajax({
                    url: "https://countriesnow.space/api/v0.1/countries/cities",
                    method: "POST",
                    data: { country: countryCode },
                    success: function(data) {
                        cities = data.data;

                        let chunkSize = 10;
                        let currentIndex = 0;
                        let lastSearchCity = "";

                        $('#shipping_city').select2({
                            placeholder: "Search for your city",
                            minimumInputLength: 1,
                            allowClear: true,
                            data: [],
                            ajax: {
                                transport: function(params, success, failure) {
                                let searchCity = params.data.term || "";

                                if (searchCity !== lastSearchCity) {
                                    currentIndex = 0;
                                }

                                lastSearchCity = searchCity;

                                let filteredCities = cities
                                    .filter(city => city.toLowerCase().includes(searchCity.toLowerCase()))
                                    .slice(currentIndex, currentIndex + chunkSize);

                                if (filteredCities.length === 0) {

                                    if (currentIndex + chunkSize > cities.length) {
                                        currentIndex = cities.length - chunkSize;
                                    } else {
                                        currentIndex += chunkSize;
                                    }

                                    filteredCities = cities
                                    .filter(city => city.toLowerCase().includes(searchCity.toLowerCase()))
                                    .slice(currentIndex, currentIndex + chunkSize);
                                }

                                success({ results: filteredCities.map(city => ({ id: city, text: city })) });
                                },
                                delay: 300
                            },

                        });
                        $('.select2-selection').addClass('!w-full !p-3 !border !rounded-md !h-12 !border-gray-300');
                    },
                    error: function() {
                        console.error("Error fetching cities");
                    }
                });
            }
        });

    });
</script>

@endsection
