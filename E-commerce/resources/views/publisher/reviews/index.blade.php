@extends('layouts.back-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/publisher/reviews/reviews.js',
    ])
@endsection

@section('content')

@include('layouts.publisher-sidebar')

<main class="ml-64 p-6">
    <!-- Reviews List -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold mt-8 mb-4">Reviews List</h2>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="mb-4 flex items-center space-x-5">
            <input type="text" id="search" placeholder="Search by content, client name, or book name" class="border border-gray-300 rounded-lg p-2 w-1/3">
            <div>
                <label for="sort" class="ml-2 text-gray-600">Sort By:</label>
                <select id="sort" class="border border-gray-300 rounded-lg p-2">
                    <option value="book_name" selected>Book Name</option>
                    <option value="client_name">Client Name</option>
                    <option value="content">Content</option>
                    <option value="rate">Rating</option>
                    <option value="created_at">Creation Date</option>
                    <option value="updated_at">Last Update</option>
                </select>
            </div>
            <div>
                <label for="order" class="ml-2 text-gray-600">Order:</label>
                <select id="order" class="border border-gray-300 rounded-lg p-2">
                    <option value="asc" selected>Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
        </div>
        <div id="reviews-table">
            @include('publisher.reviews.partial.reviews-list', ['reviews' => $reviews])
        </div>
    </div>

</main>
@endsection
