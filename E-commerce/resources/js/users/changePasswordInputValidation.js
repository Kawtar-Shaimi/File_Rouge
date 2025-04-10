import Swal from "sweetalert2";

$(document).ready(function() {
    $('#old_password').on('input', function() {
        var password = $(this).val();
        if (password.length < 8) {
            $('#old_passwordErr').text('Password must be at least 8 characters');
            $('#old_password').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#change-password').prop('disabled', true);
        } else if (password.length > 20) {
            $('#old_passwordErr').text('Password must be less than 20 characters');
            $('#old_password').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#change-password').prop('disabled', true);
        } else if (password.trim() === '') {
            $('#old_passwordErr').text('Password cannot be empty');
            $('#old_password').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#change-password').prop('disabled', true);
        } else {
            $('#old_passwordErr').text('');
            $('#old_password').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#change-password').prop('disabled', false);
        }
    });

    $('#new_password').on('input', function() {
        var password = $(this).val();
        if (password.length < 8) {
            $('#new_passwordErr').text('Password must be at least 8 characters');
            $('#new_password').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#change-password').prop('disabled', true);
        } else if (password.length > 20) {
            $('#new_passwordErr').text('Password must be less than 20 characters');
            $('#new_password').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#change-password').prop('disabled', true);
        } else if (password.trim() === '') {
            $('#new_passwordErr').text('Password cannot be empty');
            $('#new_password').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#change-password').prop('disabled', true);
        } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])/.test(password)) {
            $('#new_passwordErr').text('Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character');
            $('#new_password').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#change-password').prop('disabled', true);
        } else {
            $('#new_passwordErr').text('');
            $('#new_password').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#change-password').prop('disabled', false);
        }
    });

    $('#new_password_confirmation').on('input', function() {
        var password = $('#new_password').val();
        var confirmPassword = $(this).val();
        if (confirmPassword.length < 8) {
            $('#new_password_confirmationErr').text('Password must be at least 8 characters');
            $('#new_password_confirmation').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#change-password').prop('disabled', true);
        } else if (confirmPassword.length > 20) {
            $('#new_password_confirmationErr').text('Password must be less than 20 characters');
            $('#new_password_confirmation').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#change-password').prop('disabled', true);
        } else if (confirmPassword.trim() === '') {
            $('#new_password_confirmationErr').text('Password cannot be empty');
            $('#new_password_confirmation').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#change-password').prop('disabled', true);
        } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])/.test(confirmPassword)) {
            $('#new_password_confirmationErr').text('Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character');
            $('#new_password_confirmation').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#change-password').prop('disabled', true);
        } else if (password !== confirmPassword) {
            $('#new_password_confirmationErr').text('Passwords do not match');
            $('#new_password_confirmation').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#change-password').prop('disabled', true);
        } else {
            $('#new_password_confirmationErr').text('');
            $('#new_password_confirmation').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#change-password').prop('disabled', false);
        }
    });

    $('#change-password').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to change your password?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6366f1',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, change it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#update-form`).submit();
            }
        });
    });

    $('#toggleOldPassword').on('click', function() {
        $('#old_password').attr('type', $('#old_password').attr('type') === 'password' ? 'text' : 'password');
        $(this).toggleClass('fa-eye fa-eye-slash');
    });

    $('#toggleNewPassword').on('click', function() {
        $('#new_password').attr('type', $('#new_password').attr('type') === 'password' ? 'text' : 'password');
        $(this).toggleClass('fa-eye fa-eye-slash');
    });

    $('#toggleConfirmNewPassword').on('click', function() {
        $('#new_password_confirmation').attr('type', $('#new_password_confirmation').attr('type') === 'password' ? 'text' : 'password');
        $(this).toggleClass('fa-eye fa-eye-slash');
    });
})
