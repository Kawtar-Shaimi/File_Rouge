@extends('layouts.back-office')

@section('content')

@include('layouts.publisher-sidebar')

<main class="ml-64 p-6">
    <!-- Orders Table -->
    <h2 class="text-2xl font-bold mt-8 mb-4">Orders Table</h2>
    <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
        <div class="mb-4 flex items-center space-x-5">
            <input type="text" id="search" placeholder="Search by order number, status, client name or email" class="border border-gray-300 rounded-lg p-2 w-1/3">
            <div>
                <label for="sort" class="ml-2 text-gray-600">Sort By:</label>
                <select id="sort" class="border border-gray-300 rounded-lg p-2">
                    <option value="order_number" selected>Order Number</option>
                    <option value="client_name">Client Name</option>
                    <option value="client_email">Client Email</option>
                    <option value="total_amount">Total Amount</option>
                    <option value="status">Status</option>
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
        <div id="orders-table">
            @include('publisher.orders.partial.orders-list', ['orders' => $orders])
        </div>
    </div>

</main>

<script>
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
</script>

@endsection
