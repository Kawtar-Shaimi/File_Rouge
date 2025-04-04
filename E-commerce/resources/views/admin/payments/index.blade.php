@extends('layouts.back-office')

@section('content')

@include('layouts.admin-sidebar')

<main class="ml-64 p-6">

    <!-- Payments Table -->
    <h2 class="text-2xl font-bold mt-8 mb-4">Payments Table</h2>
    <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
        <div class="mb-4 flex items-center space-x-5">
            <input type="text" id="search" placeholder="Search by order number, status, client name, or email" class="border border-gray-300 rounded-lg p-2 w-1/3">
            <div>
                <label for="sort" class="ml-2 text-gray-600">Sort By:</label>
                <select id="sort" class="border border-gray-300 rounded-lg p-2">
                    <option value="id" selected>ID</option>
                    <option value="order_number">Order Number</option>
                    <option value="client_name">Client Name</option>
                    <option value="client_email">Email</option>
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
        <div id="payments-table">
            @include('admin.payments.partial.payments-list', ['payments' => $payments])
        </div>
    </div>

</main>

<script>
    $(document).ready(function() {

        function fetchPayments(query, page = 1, sort = 'id', order = 'asc') {
            $.ajax({
                url: "/admin/filter/payments?page=" + page,
                method: 'GET',
                data: {
                    query,
                    sort,
                    order
                },
                success: function(response) {
                    $('#payments-table').html(response.data.html);
                }
            });
        }

        $('#search').on('keyup', function() {
            let query = $(this).val();
            let sort = $('#sort').val();
            let order = $('#order').val();
            fetchPayments(query, 1, sort, order);
        });

        $('#sort, #order').on('change', function() {
            let order = $('#order').val();
            let query = $('#search').val();
            let sort = $('#sort').val();
            fetchPayments(query, 1, sort, order);
        });

        $(document).on('click', '#pagination a', function(event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            let query = $('#search').val();
            let sort = $('#sort').val();
            let order = $('#order').val();
            fetchPayments(query, page, sort, order);
        });
    })
</script>

@endsection
