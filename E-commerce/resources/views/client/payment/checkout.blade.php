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
                    @foreach ($cart->cartBooks as $cartBook)
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
            <form id="checkout-form" action="{{ route('client.order.makeOrder') }}" method="POST">
                <div class="space-y-4">
                    @csrf
                    <div>
                        <label for="shipping_name" class="block text-sm font-medium text-gray-700">Name:</label>
                        <input type="text" id="shipping_name" name="shipping_name" class="w-full p-3 border rounded-md" value="{{ old('shipping_name', Auth::guard('client')->user()->name) }}" required>
                    </div>
                    <p id="shipping_nameErr" class="text-red-500 text-sm mt-1"></p>
                    @error('shipping_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="shipping_email" class="block text-sm font-medium text-gray-700">Email:</label>
                        <input type="email" id="shipping_email" name="shipping_email" class="w-full p-3 border rounded-md" value="{{ old('shipping_email', Auth::guard('client')->user()->email) }}" required>
                    </div>
                    <p id="shipping_emailErr" class="text-red-500 text-sm mt-1"></p>
                    @error('shipping_email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="shipping_phone" class="block text-sm font-medium text-gray-700">Phone:</label>
                        <input type="tel" id="shipping_phone" name="shipping_phone" class="w-full p-3 border rounded-md" value="{{ old('shipping_phone', Auth::guard('client')->user()->phone) }}" required>
                    </div>
                    <p id="shipping_phoneErr" class="text-red-500 text-sm mt-1"></p>
                    @error('shipping_phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="shipping_address" class="block text-sm font-medium text-gray-700">Address:</label>
                        <textarea id="shipping_address" name="shipping_address" class="w-full p-3 border rounded-md" required>{{ old('shipping_address') }}</textarea>
                    </div>
                    <p id="shipping_addressErr" class="text-red-500 text-sm mt-1"></p>
                    @error('shipping_address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="shipping_country" class="block text-sm font-medium text-gray-700">Country:</label>
                        <select id="shipping_country" name="shipping_country" class="w-full p-3 border rounded-md" required>
                            <option selected value="">Select a country</option>
                        </select>
                    </div>
                    <p id="shipping_countryErr" class="text-red-500 text-sm mt-1"></p>
                    @error('shipping_country')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="shipping_city" class="block text-sm font-medium text-gray-700">City:</label>
                        <select id="shipping_city" name="shipping_city" class="w-full p-3 border rounded-md" required>
                            <option selected value="">Select a city</option>
                        </select>
                    </div>
                    <p id="shipping_cityErr" class="text-red-500 text-sm mt-1"></p>
                    @error('shipping_city')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700">Postal Code:</label>
                        <input type="text" id="shipping_postal_code" name="shipping_postal_code" class="w-full p-3 border rounded-md" value="{{ old('shipping_postal_code') }}" required>
                    </div>
                    <p id="shipping_postal_codeErr" class="text-red-500 text-sm mt-1"></p>
                    @error('shipping_postal_code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sélection du mode de paiement -->
                <div class="mt-6">
                    <h3 class="text-xl font-semibold mb-4">Payment Method:</h3>

                    <div class="space-y-4">
                        <!-- Credit Card -->
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-100">
                            <input type="radio" id="credit_card" name="payment_method" value="credit_card" class="mr-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/PayPal_logo_2014.svg/200px-PayPal_logo_2014.svg.png" alt="Credit Card" class="w-16">
                            <span class="ml-auto text-gray-600">Credit Card</span>
                        </label>

                        <!-- PayPal -->
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-100">
                            <input type="radio" name="payment_method" value="paypal" class="mr-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5f/PayPal_logo_2014.svg/200px-PayPal_logo_2014.svg.png" alt="PayPal" class="w-16">
                            <span class="ml-auto text-gray-600">PayPal</span>
                        </label>

                        <!-- Cash on Delivery -->
                        <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-100">
                            <input type="radio" name="payment_method" value="cash_on_delivery" class="mr-3" checked>
                            <img src="https://cdn-icons-png.flaticon.com/512/2331/2331940.png" alt="Cash on Delivery" class="w-10">
                            <span class="ml-auto text-gray-600">Cash on Delivery</span>
                        </label>
                    </div>
                    <p id="payment_methodErr" class="text-red-500 text-sm mt-1"></p>
                    @error('payment_method')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bouton de paiement -->
                <button id="checkout-btn" type="submit" class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg mt-6 hover:bg-blue-600">
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

<script>
    $(document).ready(function() {

        $('#shipping_name').on('input', function() {
            var shippingName = $(this).val();
            if (shippingName.length < 3) {
                $('#shippingNameError').text('Shipping name must be at least 3 characters.');
                $('#shipping_name').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else if (shippingName.length > 60) {
                $('#shippingNameError').text('Shipping name must be less than 60 characters.');
                $('#shipping_name').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else if (!/^[a-zA-Z\s]+$/.test(shippingName)) {
                $('#shippingNameError').text('Shipping name must only contain letters and spaces.');
                $('#shipping_name').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else if (shippingName.trim() === '') {
                $('#shippingNameError').text('Shipping name cannot be empty.');
                $('#shipping_name').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else {
                $('#shippingNameError').text('');
                $('#shipping_name').removeClass('border-red-500').addClass('border-green-500');
                $('#place-order').prop('disabled', false);
            }
        })

        $('#shipping_email').on('input', function() {
            var shippingEmail = $(this).val();
            if (shippingEmail.length < 3) {
                $('#shippingEmailError').text('Shipping email must be at least 3 characters.');
                $('#shipping_email').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else if (shippingEmail.length > 150) {
                $('#shippingEmailError').text('Shipping email must be less than 150 characters.');
                $('#shipping_email').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else if (!/^\S+@\S+\.\S+$/.test(shippingEmail)) {
                $('#shippingEmailError').text('Invalid shipping email format.');
                $('#shipping_email').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else if (shippingEmail.trim() === '') {
                $('#shippingEmailError').text('Shipping email cannot be empty.');
                $('#shipping_email').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else {
                $('#shippingEmailError').text('');
                $('#shipping_email').removeClass('border-red-500').addClass('border-green-500');
                $('#place-order').prop('disabled', false);
            }
        })

        $('#shipping_phone').on('input', function() {
            var shippingPhone = $(this).val();
            if (shippingPhone.length < 6) {
                $('#shippingPhoneError').text('Shipping phone must be at least 6 characters.');
                $('#shipping_phone').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else if (shippingPhone.length > 20) {
                $('#shippingPhoneError').text('Shipping phone must be less than 20 characters.');
                $('#shipping_phone').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else if (shippingPhone.trim() === '') {
                $('#shippingPhoneError').text('Shipping phone cannot be empty.');
                $('#shipping_phone').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else {
                $('#shippingPhoneError').text('');
                $('#shipping_phone').removeClass('border-red-500').addClass('border-green-500');
                $('#place-order').prop('disabled', false);
            }
        })

        $('#shipping_address').on('input', function() {
            var shippingAddress = $(this).val();
            if (shippingAddress.length < 3) {
                $('#shippingAddressError').text('Shipping address must be at least 3 characters.');
                $('#shipping_address').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else if (shippingAddress.trim() === '') {
                $('#shippingAddressError').text('Shipping address cannot be empty.');
                $('#shipping_address').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else {
                $('#shippingAddressError').text('');
                $('#shipping_address').removeClass('border-red-500').addClass('border-green-500');
                $('#place-order').prop('disabled', false);
            }
        })

        $('#shipping_country').on('input', function() {
            var shippingCountry = $(this).val();
            if (shippingCountry.length < 3) {
                $('#shippingCountryError').text('Shipping country must be at least 3 characters.');
                $('#shipping_country').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else if (shippingCountry.length > 100) {
                $('#shippingCountryError').text('Shipping country must be less than 100 characters.');
                $('#shipping_country').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else if (!/^[a-zA-Z\s]+$/.test(shippingCountry)) {
                $('#shippingCountryError').text('Shipping country must only contain letters and spaces.');
                $('#shipping_country').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            }
            else if (shippingCountry.trim() === '') {
                $('#shippingCountryError').text('Shipping country cannot be empty.');
                $('#shipping_country').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else {
                $('#shippingCountryError').text('');
                $('#shipping_country').removeClass('border-red-500').addClass('border-green-500');
                $('#place-order').prop('disabled', false);
            }
        })

        $('#shipping_city').on('input', function() {
            var shippingCity = $(this).val();
            if (shippingCity.length < 3) {
                $('#shippingCityError').text('Shipping city must be at least 3 characters.');
                $('#shipping_city').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else if (shippingCity.length > 100) {
                $('#shippingCityError').text('Shipping city must be less than 100 characters.');
                $('#shipping_city').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else if (!/^[a-zA-Z\s]+$/.test(shippingCity)) {
                $('#shippingCityError').text('Shipping city must only contain letters and spaces.');
                $('#shipping_city').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else if (shippingCity.trim() === '') {
                $('#shippingCityError').text('Shipping city cannot be empty.');
                $('#shipping_city').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else {
                $('#shippingCityError').text('');
                $('#shipping_city').removeClass('border-red-500').addClass('border-green-500');
                $('#place-order').prop('disabled', false);
            }
        })

        $('#shipping_postal_code').on('input', function() {
            var shippingPostalCode = $(this).val();
            if (shippingPostalCode.length < 3) {
                $('#shippingPostalCodeError').text('Shipping postal code must be at least 3 characters.');
                $('#shipping_postal_code').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else if (shippingPostalCode.length > 20) {
                $('#shippingPostalCodeError').text('Shipping postal code must be less than 20 characters.');
                $('#shipping_postal_code').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else if (shippingPostalCode.trim() === '') {
                $('#shippingPostalCodeError').text('Shipping postal code cannot be empty.');
                $('#shipping_postal_code').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } else {
                $('#shippingPostalCodeError').text('');
                $('#shipping_postal_code').removeClass('border-red-500').addClass('border-green-500');
                $('#place-order').prop('disabled', false);
            }
        })

        $('#payment_method').on('input', function() {
            var paymentMethod = $(this).val();
            if (paymentMethod === 'credit_card' || paymentMethod === 'paypal' || paymentMethod === 'cash_on_delivery') {
                $('#paymentMethodError').text('');
                $('#payment_method').removeClass('border-red-500').addClass('border-green-500');
                $('#place-order').prop('disabled', false);
            } else {
                $('#paymentMethodError').text('Please select a valid payment method.');
                $('#payment_method').removeClass('border-green-500').addClass('border-red-500');
                $('#place-order').prop('disabled', true);
            } 
        })
    })
</script>

@endsection
