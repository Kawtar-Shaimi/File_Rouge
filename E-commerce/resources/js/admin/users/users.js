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
