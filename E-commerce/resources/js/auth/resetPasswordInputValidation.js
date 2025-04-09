$(document).ready(function() {
    $('#password').on('input', function() {
        var password = $(this).val();
        if (password.length < 8) {
            $('#passwordErr').text('Password must be at least 8 characters');
            $('#password').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#auth.reset-password').prop('disabled', true);
        } else if (password.length > 20) {
            $('#passwordErr').text('Password must be less than 20 characters');
            $('#password').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#auth.reset-password').prop('disabled', true);
        } else if (password.trim() === '') {
            $('#passwordErr').text('Password cannot be empty');
            $('#password').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#auth.reset-password').prop('disabled', true);
        } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])/.test(password)) {
            $('#passwordErr').text('Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character');
            $('#password').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#auth.reset-password').prop('disabled', true);
        } else {
            $('#passwordErr').text('');
            $('#password').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#auth.reset-password').prop('disabled', false);
        }
    });

    $('#password_confirmation').on('input', function() {
        var password = $('#password').val();
        var confirmPassword = $(this).val();
        if (password.length < 8) {
            $('#password_confirmationErr').text('Password must be at least 8 characters');
            $('#password_confirmation').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#auth.reset-password').prop('disabled', true);
        } else if (password.length > 20) {
            $('#password_confirmationErr').text('Password must be less than 20 characters');
            $('#password_confirmation').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#auth.reset-password').prop('disabled', true);
        } else if (password.trim() === '') {
            $('#password_confirmationErr').text('Password cannot be empty');
            $('#password_confirmation').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#auth.reset-password').prop('disabled', true);
        } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])/.test(password)) {
            $('#password_confirmationErr').text('Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character');
            $('#password_confirmation').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#auth.reset-password').prop('disabled', true);
        } else if (password !== confirmPassword) {
            $('#password_confirmationErr').text('Passwords do not match');
            $('#password_confirmation').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#auth.reset-password').prop('disabled', true);
        } else {
            $('#password_confirmationErr').text('');
            $('#password_confirmation').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#auth.reset-password').prop('disabled', false);
        }
    });
});
