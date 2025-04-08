$(document).ready(function() {

    function fetchReviews(query, page = 1, sort = 'id', order = 'asc') {
        $.ajax({
            url: "/admin/filter/reviews?page=" + page,
            method: 'GET',
            data: {
                query,
                sort,
                order
            },
            success: function(response) {
                $('#reviews-table').html(response.data.html);
            }
        });
    }

    $('#search').on('keyup', function() {
        let query = $(this).val();
        let sort = $('#sort').val();
        let order = $('#order').val();
        fetchReviews(query, 1, sort, order);
    });

    $('#sort, #order').on('change', function() {
        let order = $('#order').val();
        let query = $('#search').val();
        let sort = $('#sort').val();
        fetchReviews(query, 1, sort, order);
    });

    $(document).on('click', '#pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let query = $('#search').val();
        let sort = $('#sort').val();
        let order = $('#order').val();
        fetchReviews(query, page, sort, order);
    });
})
