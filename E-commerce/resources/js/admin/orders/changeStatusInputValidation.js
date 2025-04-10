import Swal from "sweetalert2";

$(document).ready(function () {
    $('#status').on('change', function () {
        var selectedStatus = $(this).val();
        if (selectedStatus === 'pending' || selectedStatus === 'in shipping' || selectedStatus === 'completed' || selectedStatus === 'cancelled') {
            $('#status-error').text('');
            $('#status').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#update-status').prop('disabled', false);
        } else {
            $('#status-error').text('Status must be "Pending", "In Shipping", "Completed", or "Cancelled".');
            $('#status').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#update-status').prop('disabled', true);
        }

        if (selectedStatus === 'cancelled') {
            $('#cancel_reason').removeClass('hidden').addClass('block');
        } else {
            $('#cancel_reason').removeClass('block').addClass('hidden');
        }

    });

    $('#reason').on('input', function() {
        if ($(this).val().length < 3) {
            $('#reason-error').text('Reason must be at least 3 characters long.');
            $('#reason').removeClass('border-green-500 focus:ring focus:ring-green-500').addClass('border-red-500 focus:ring focus:ring-red-500');
            $('#update-status').prop('disabled', true);
        }else if ($(this).val().trim() === '') {
            $('#reason-error').text('Reason is required.');
            $('#reason').removeClass('border-green-500 focus:ring focus:ring-green-500').addClass('border-red-500 focus:ring focus:ring-red-500');
            $('#update-status').prop('disabled', true);
        }
        else {
            $('#reason-error').text('');
            $('#reason').removeClass('border-red-500 focus:ring focus:ring-red-500').addClass('border-green-500 focus:ring focus:ring-green-500');
            $('#update-status').prop('disabled', false);
        }
    })

    $('#update-status').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to change this order status?',
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
})
