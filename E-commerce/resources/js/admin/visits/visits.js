$(document).ready(function() {

    function fetchVisits(query, page = 1, sort = 'id', order = 'asc') {
        $.ajax({
            url: "/admin/filter/visits?page=" + page,
            method: 'GET',
            data: {
                query,
                sort,
                order
            },
            success: function(response) {
                $('#visits-table').html(response.data.html);
            }
        });
    }

    $('#search').on('keyup', function() {
        let query = $(this).val();
        let sort = $('#sort').val();
        let order = $('#order').val();
        fetchVisits(query, 1, sort, order);
    });

    $('#sort, #order').on('change', function() {
        let query = $('#search').val();
        let sort = $('#sort').val();
        let order = $('#order').val();
        fetchVisits(query, 1, sort, order);
    });

    $(document).on('click', '#pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let query = $('#search').val();
        let sort = $('#sort').val();
        let order = $('#order').val();
        fetchVisits(query, page, sort, order);
    });
});
