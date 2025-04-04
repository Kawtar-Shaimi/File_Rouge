@extends('layouts.back-office')

@section('content')

@include('layouts.admin-sidebar')

<main class="ml-64 p-6">
    <!-- Users List -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold mt-8 mb-4">Users Table</h2>
        <button class="bg-blue-500 text-white px-3 py-2 rounded"><a href="{{ route('admin.users.create') }}">Add User</a></button>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="mb-4 flex items-center space-x-5">
            <input type="text" id="search" placeholder="Search by name, email, or role" class="border border-gray-300 rounded-lg p-2 w-1/3">
            <div>
                <label for="sort" class="ml-2 text-gray-600">Sort By:</label>
                <select id="sort" class="border border-gray-300 rounded-lg p-2">
                    <option value="id" selected>ID</option>
                    <option value="name">Name</option>
                    <option value="email">Email</option>
                    <option value="role">Role</option>
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
        <div id="users-table">
            @include('admin.users.partial.users-list', ['users' => $users])
        </div>
    </div>
</main>

<script>
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
</script>

@endsection
