import Swal from "sweetalert2";

$(document).ready(function() {

    function fetchOrders(query, page = 1, sort = 'order_number', order = 'asc') {
        $.ajax({
            url: "/publisher/filter/orders?page=" + page,
            method: 'GET',
            data: {
                query,
                sort,
                order
            },
            success: function(response) {
                $('#orders-table').html(response.data.html);
            }
        });
    }

    $('#search').on('keyup', function() {
        let query = $(this).val();
        let sort = $('#sort').val();
        let order = $('#order').val();

        fetchOrders(query, 1, sort, order);
    });

    $('#sort, #order').on('change', function() {
        let query = $('#search').val();
        let order = $('#order').val();
        let sort = $('#sort').val();
        fetchOrders(query, 1, sort, order);
    });

    $(document).on('click', '#pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let query = $('#search').val();
        let sort = $('#sort').val();
        let order = $('#order').val();
        fetchOrders(query, page, sort, order);
    });
});

function showCancelConfirmation(e, uuid){
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
            $(`#cancel-form-${uuid}`).submit();
        }
    });
}

window.showCancelConfirmation = showCancelConfirmation;
