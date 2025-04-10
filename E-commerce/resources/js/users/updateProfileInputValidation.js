import Swal from "sweetalert2";

$(document).ready(function() {

    $('#name').on('input', function() {
        var name = $(this).val();
        if (name.length < 3) {
            $('#nameErr').text('Name must be at least 3 characters');
            $('#name').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#update-user').prop('disabled', true);
        } else if (name.length > 60) {
            $('#nameErr').text('Name must be less than 60 characters');
            $('#name').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#update-user').prop('disabled', true);
        } else if (!/^[a-zA-Z\s]+$/.test(name)) {
            $('#nameErr').text('Name must only contain letters and spaces');
            $('#name').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#update-user').prop('disabled', true);
        } else if (name.trim() === '') {
            $('#nameErr').text('Name cannot be empty');
            $('#name').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#update-user').prop('disabled', true);
        } else {
            $('#nameErr').text('');
            $('#name').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#update-user').prop('disabled', false);
        }
    });

    $('#email').on('input', function() {
        var email = $(this).val();
        if (email.length < 3) {
            $('#emailErr').text('Email must be at least 3 characters');
            $('#email').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#update-user').prop('disabled', true);
        } else if (email.length > 150) {
            $('#emailErr').text('Email must be less than 150 characters');
            $('#email').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#update-user').prop('disabled', true);
        } else if (!/^\S+@\S+\.\S+$/.test(email)) {
            $('#emailErr').text('Email must be a valid email address');
            $('#email').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#update-user').prop('disabled', true);
        } else {
            $('#emailErr').text('');
            $('#email').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#update-user').prop('disabled', false);
        }
    });

    $('#phone').on('input', function() {
        var phone = $(this).val();
        if (phone.length < 6) {
            $('#phoneErr').text('Phone must be at least 6 characters');
            $('#phone').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#update-user').prop('disabled', true);
        } else if (phone.length > 20) {
            $('#phoneErr').text('Phone must be less than 20 characters');
            $('#phone').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#update-user').prop('disabled', true);
        } else {
            $('#phoneErr').text('');
            $('#phone').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#update-user').prop('disabled', false);
        }
    });

    $('#update-user').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to update your profile?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#6366f1',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, update it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#update-form`).submit();
            }
        });
    });
})
