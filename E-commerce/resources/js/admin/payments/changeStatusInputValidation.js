$(document).ready(function () {
    $('#status').on('change', function () {
        var selectedStatus = $(this).val();
        if (selectedStatus === 'in shipping' || selectedStatus === 'completed' || selectedStatus === 'cancelled') {
            $('#status-error').text('Cannot change status to "In Shipping", "Completed", or "Cancelled".');
            $('#status').removeClass('border-green-500  focus:ring focus:ring-green-300').addClass('border-red-500  focus:ring focus:ring-red-300');
            $('#update-status').prop('disabled', true);
        } else {
            $('#status-error').text('');
            $('#status').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#update-status').prop('disabled', false);
        }
    });

    $('#update-status').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to change this payment status?',
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
