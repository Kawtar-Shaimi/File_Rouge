$(document).ready(function() {
    $('#email').on('input', function() {
        var email = $(this).val();
        if (email.length < 3) {
            $('#emailErr').text('Email must be at least 3 characters');
            $('#email').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#login').prop('disabled', true);
        } else if (email.length > 150) {
            $('#emailErr').text('Email must be less than 150 characters');
            $('#email').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#login').prop('disabled', true);
        } else if (!/^\S+@\S+\.\S+$/.test(email)) {
            $('#emailErr').text('Invalid email format');
            $('#email').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#login').prop('disabled', true);
        } else {
            $('#emailErr').text('');
            $('#email').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#login').prop('disabled', false);
        }
    });

    $('#password').on('input', function() {
        var password = $(this).val();
        if (password.length < 8) {
            $('#passwordErr').text('Password must be at least 8 characters');
            $('#password').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#login').prop('disabled', true);
        } else if (password.length > 20) {
            $('#passwordErr').text('Password must be less than 20 characters');
            $('#password').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#login').prop('disabled', true);
        } else {
            $('#passwordErr').text('');
            $('#password').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#login').prop('disabled', false);
        }
    });

    $('#togglePassword').on('click', function() {
        $('#password').attr('type', $('#password').attr('type') === 'password' ? 'text' : 'password');
        $(this).toggleClass('fa-eye fa-eye-slash');
    });
})
