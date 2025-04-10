import Swal from "sweetalert2";

$(document).ready(function() {

    function fetchUsers(query, page = 1, sort = 'id', order = 'asc') {
        $.ajax({
            url: "/admin/filter/users?page=" + page,
            method: 'GET',
            data: {
                query,
                sort,
                order
            },
            success: function(response) {
                $('#users-table').html(response.data.html);
            }
        });
    }

    $('#search').on('keyup', function() {
        let query = $(this).val();
        let sort = $('#sort').val();
        let order = $('#order').val();

        fetchUsers(query, 1, sort, order);
    });

    $('#sort, #order').on('change', function() {
        let query = $('#search').val();
        let order = $('#order').val();
        let sort = $('#sort').val();
        fetchUsers(query, 1, sort, order);
    });

    $(document).on('click', '#pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let query = $('#search').val();
        let sort = $('#sort').val();
        let order = $('#order').val();
        fetchUsers(query, page, sort, order);
    });
});

function showDeleteConfirmation(e, uuid) {
    e.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action will permanently delete this user!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.isConfirmed) {
            $(`#delete-form-${uuid}`).submit();
        }
    });
}

window.showDeleteConfirmation = showDeleteConfirmation;
