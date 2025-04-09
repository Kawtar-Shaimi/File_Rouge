$(document).ready(function () {
    $('#status').on('change', function () {
        var selectedStatus = $(this).val();
        if (selectedStatus === 'in shipping' || selectedStatus === 'completed' || selectedStatus === 'cancelled') {
            $('#status-error').text('Cannot change status to "In Shipping", "Completed", or "Cancelled".');
            $('#status').addClass('border-red-500');
            $('#update-status').prop('disabled', true);
        } else {
            $('#status-error').text('');
            $('#status').removeClass('border-red-500  focus:ring focus:ring-red-300').addClass('border-green-500  focus:ring focus:ring-green-300');
            $('#update-status').prop('disabled', false);
        }
    });
})
