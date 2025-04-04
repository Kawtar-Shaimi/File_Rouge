@extends('layouts.front-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/addToCart.js',
        'resources/js/addOneToCart.js',
        'resources/js/removeFromCart.js',
        'resources/js/addToWishlist.js',
        'resources/js/removeFromWishlist.js'
    ])
@endsection

@section('content')

<!-- Section Recherche et Filtrage -->
<div class="container mx-auto px-4 py-10">
    <h1 class="text-4xl font-bold text-center mb-8 text-blue-600">Nos Books</h1>
    <div class="mb-10 flex items-center space-x-5">
        <div class="w-1/3">
            <input type="text" id="search" class="w-full p-2 bg-white rounded-lg border border-gray-300" placeholder="Rechercher un book...">
            <div class="w-full relative hidden" id="results">
                <div class="absolute bg-white shadow-lg shadow-gray-400 mt-2 w-full z-10">
                    <ul id="search-results" class="max-h-60 overflow-y-auto">
                    </ul>
                </div>
            </div>
        </div>
        <div>
            <label for="sort" class="ml-2 text-gray-600">Sort By:</label>
            <select id="sort" class="border bg-white border-gray-300 rounded-lg p-2">
                <option value="" selected>Sort By</option>
                <option value="name">Name</option>
                <option value="price">Price</option>
                <option value="category_name">Category</option>
            </select>
        </div>
        <div>
            <label for="order" class="ml-2 text-gray-600">Order:</label>
            <select id="order" class="border bg-white border-gray-300 rounded-lg p-2">
                <option value="" selected>Order By</option>
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
        </div>
        @php
            if (!isset($categories)) {
                $categories = \App\Models\Category::all();
            }
        @endphp
        <div>
            <label for="category" class="ml-2 text-gray-600">Category:</label>
            <select id="category" class="border bg-white border-gray-300 rounded-lg p-2">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if(isset($search))
        <div class="mb-4">
            <p class="text-lg font-semibold text-blue-600">Résultats pour : "<span id="search-term">{{ $search }}</span>"</p>
        </div>
    @endif

    <!-- Books Grid -->
    <div id="bookGrid">
        @include('books.partial.books-grid', ['books' => $books])
    </div>
</div>

<script>
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
            console.log(query, page, sort, order, category);
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
</script>

@endsection
