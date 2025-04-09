function showCancelModal(uuid) {
    $('#cancel-modal-' + uuid).removeClass('hidden').addClass('flex');
    $('#show-modal-' + uuid).addClass('hidden');
}

function closeCancelModal(uuid) {
    $('#cancel-modal-' + uuid).addClass('hidden').removeClass('flex');
    $('#show-modal-' + uuid).removeClass('hidden');
}

$(document).ready(function() {
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
});

window.showCancelModal = showCancelModal;
window.closeCancelModal = closeCancelModal;
