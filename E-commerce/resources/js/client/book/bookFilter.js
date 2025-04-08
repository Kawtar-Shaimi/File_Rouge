$(document).ready(function() {
    $('#search').on('input', function() {
        let query = $(this).val();
        if (query.length > 0) {
            $.ajax({
                url: '/client/filter/searchTerms',
                method: 'GET',
                data: { query },
                success: function(res) {
                    $('#search-results').empty();
                    if (res.data.searchTerms.length === 0) {
                        $('#search-results').append('<li class="py-2 px-4 text-gray-500">Aucun résultat trouvé</li>');
                    } else {
                        $.each(res.data.searchTerms, function(index, searchTerm) {
                            $('#search-results').append(`<li><a class="block py-2 px-4 border-b border-gray-200 hover:bg-gray-100" href="/books?query=${searchTerm}">${searchTerm}</a></li>`);
                        });
                    }
                    $('#results').removeClass('hidden');
                }
            });
        } else {
            $('#search-results').empty();
            $('#results').addClass('hidden');
        }
    });

    function fetchBooks(query, page = 1, sort = '', order = '', category = '') {
        $.ajax({
            url: "/client/filter/books?page=" + page,
            method: 'GET',
            data: {
                query,
                sort,
                order,
                category
            },
            success: function(response) {
                $('#bookGrid').html(response.data.html);
            }
        });
    }

    $('#sort, #order, #category').on('change', function() {
        let query = $('#search-term') ? $('#search-term').text() : "";
        let sort = $('#sort').val();
        let order = $('#order').val();
        let category = $('#category').val();
        fetchBooks(query, 1, sort, order, category);
    });

    $(document).on('click', '#pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let query = $('#search-term') ? $('#search-term').text() : "";
        let sort = $('#sort').val();
        let order = $('#order').val();
        let category = $('#category').val();
        fetchBooks(query, page, sort, order, category);
    });

})
