$(document).ready(function() {

    $('#shipping_name').on('input', function() {
        var shippingName = $(this).val();
        if (shippingName.length < 3) {
            $('#shippingNameError').text('Shipping name must be at least 3 characters.');
            $('#shipping_name').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else if (shippingName.length > 60) {
            $('#shippingNameError').text('Shipping name must be less than 60 characters.');
            $('#shipping_name').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else if (!/^[a-zA-Z\s]+$/.test(shippingName)) {
            $('#shippingNameError').text('Shipping name must only contain letters and spaces.');
            $('#shipping_name').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else if (shippingName.trim() === '') {
            $('#shippingNameError').text('Shipping name cannot be empty.');
            $('#shipping_name').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else {
            $('#shippingNameError').text('');
            $('#shipping_name').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#place-order').prop('disabled', false);
        }
    })

    $('#shipping_email').on('input', function() {
        var shippingEmail = $(this).val();
        if (shippingEmail.length < 3) {
            $('#shippingEmailError').text('Shipping email must be at least 3 characters.');
            $('#shipping_email').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else if (shippingEmail.length > 150) {
            $('#shippingEmailError').text('Shipping email must be less than 150 characters.');
            $('#shipping_email').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else if (!/^\S+@\S+\.\S+$/.test(shippingEmail)) {
            $('#shippingEmailError').text('Invalid shipping email format.');
            $('#shipping_email').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else if (shippingEmail.trim() === '') {
            $('#shippingEmailError').text('Shipping email cannot be empty.');
            $('#shipping_email').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else {
            $('#shippingEmailError').text('');
            $('#shipping_email').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#place-order').prop('disabled', false);
        }
    })

    $('#shipping_phone').on('input', function() {
        var shippingPhone = $(this).val();
        if (shippingPhone.length < 6) {
            $('#shippingPhoneError').text('Shipping phone must be at least 6 characters.');
            $('#shipping_phone').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else if (shippingPhone.length > 20) {
            $('#shippingPhoneError').text('Shipping phone must be less than 20 characters.');
            $('#shipping_phone').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else if (shippingPhone.trim() === '') {
            $('#shippingPhoneError').text('Shipping phone cannot be empty.');
            $('#shipping_phone').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else {
            $('#shippingPhoneError').text('');
            $('#shipping_phone').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#place-order').prop('disabled', false);
        }
    })

    $('#shipping_address').on('input', function() {
        var shippingAddress = $(this).val();
        if (shippingAddress.length < 3) {
            $('#shippingAddressError').text('Shipping address must be at least 3 characters.');
            $('#shipping_address').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else if (shippingAddress.trim() === '') {
            $('#shippingAddressError').text('Shipping address cannot be empty.');
            $('#shipping_address').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else {
            $('#shippingAddressError').text('');
            $('#shipping_address').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#place-order').prop('disabled', false);
        }
    })

    $('#shipping_country').on('input', function() {
        var shippingCountry = $(this).val();
        if (shippingCountry.length < 3) {
            $('#shippingCountryError').text('Shipping country must be at least 3 characters.');
            $('#shipping_country').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else if (shippingCountry.length > 100) {
            $('#shippingCountryError').text('Shipping country must be less than 100 characters.');
            $('#shipping_country').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else if (!/^[a-zA-Z\s]+$/.test(shippingCountry)) {
            $('#shippingCountryError').text('Shipping country must only contain letters and spaces.');
            $('#shipping_country').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        }
        else if (shippingCountry.trim() === '') {
            $('#shippingCountryError').text('Shipping country cannot be empty.');
            $('#shipping_country').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else {
            $('#shippingCountryError').text('');
            $('#shipping_country').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#place-order').prop('disabled', false);
        }
    })

    $('#shipping_city').on('input', function() {
        var shippingCity = $(this).val();
        if (shippingCity.length < 3) {
            $('#shippingCityError').text('Shipping city must be at least 3 characters.');
            $('#shipping_city').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else if (shippingCity.length > 100) {
            $('#shippingCityError').text('Shipping city must be less than 100 characters.');
            $('#shipping_city').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else if (!/^[a-zA-Z\s]+$/.test(shippingCity)) {
            $('#shippingCityError').text('Shipping city must only contain letters and spaces.');
            $('#shipping_city').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else if (shippingCity.trim() === '') {
            $('#shippingCityError').text('Shipping city cannot be empty.');
            $('#shipping_city').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else {
            $('#shippingCityError').text('');
            $('#shipping_city').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#place-order').prop('disabled', false);
        }
    })

    $('#shipping_postal_code').on('input', function() {
        var shippingPostalCode = $(this).val();
        if (shippingPostalCode.length < 3) {
            $('#shippingPostalCodeError').text('Shipping postal code must be at least 3 characters.');
            $('#shipping_postal_code').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else if (shippingPostalCode.length > 20) {
            $('#shippingPostalCodeError').text('Shipping postal code must be less than 20 characters.');
            $('#shipping_postal_code').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else if (shippingPostalCode.trim() === '') {
            $('#shippingPostalCodeError').text('Shipping postal code cannot be empty.');
            $('#shipping_postal_code').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        } else {
            $('#shippingPostalCodeError').text('');
            $('#shipping_postal_code').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#place-order').prop('disabled', false);
        }
    })

    $('#payment_method').on('input', function() {
        var paymentMethod = $(this).val();
        if (paymentMethod === 'credit_card' || paymentMethod === 'paypal' || paymentMethod === 'cash_on_delivery') {
            $('#paymentMethodError').text('');
            $('#payment_method').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#place-order').prop('disabled', false);
        } else {
            $('#paymentMethodError').text('Please select a valid payment method.');
            $('#payment_method').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#place-order').prop('disabled', true);
        }
    })
})
