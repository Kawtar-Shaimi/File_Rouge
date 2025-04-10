import Swal from "sweetalert2";

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

    $('#cancel-order').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'This action will permanently cancel this order!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, cancel it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#cancel-form`).submit();
            }
        });
    });
});

function showCancelModal(uuid) {
    $('#cancel-modal-' + uuid).removeClass('hidden').addClass('flex');
    $('#show-modal-' + uuid).addClass('hidden');
}

function closeCancelModal(uuid) {
    $('#cancel-modal-' + uuid).addClass('hidden').removeClass('flex');
    $('#show-modal-' + uuid).removeClass('hidden');
}

window.showCancelModal = showCancelModal;
window.closeCancelModal = closeCancelModal;
