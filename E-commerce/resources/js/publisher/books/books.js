$(document).ready(function() {

    function fetchBooks(query, page = 1, sort = 'name', order = 'asc') {
        $.ajax({
            url: "/publisher/filter/books?page=" + page,
            method: 'GET',
            data: {
                query,
                sort,
                order
            },
            success: function(response) {
                $('#books-table').html(response.data.html);
            }
        });
    }

    $('#search').on('keyup', function() {
        let query = $(this).val();
        let sort = $('#sort').val();
        let order = $('#order').val();

        fetchBooks(query, 1, sort, order);
    });

    $('#sort, #order').on('change', function() {
        let query = $('#search').val();
        let order = $('#order').val();
        let sort = $('#sort').val();
        fetchBooks(query, 1, sort, order);
    });

    $(document).on('click', '#pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let query = $('#search').val();
        let sort = $('#sort').val();
        let order = $('#order').val();
        fetchBooks(query, page, sort, order);
    });
});

function showDeleteConfirmation(e, uuid) {
    e.preventDefault();
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action will permanently delete this book!',
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
