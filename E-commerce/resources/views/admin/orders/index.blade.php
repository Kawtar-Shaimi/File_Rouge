@extends('layouts.back-office')

@section('title', 'Orders List')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/admin/orders/orders.js'])
@endsection

@section('content')
    @include('layouts.admin-sidebar')

    <main class="ml-64 p-8 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <!-- Orders List Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-slate-800">Orders Table</h2>
                <p class="text-sm text-slate-500 mt-1">Manage and track customer orders</p>
            </div>

            <!-- Orders Table Container -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                <!-- Filters -->
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="flex-1">
                        <input type="text" 
                            id="search" 
                            placeholder="Search by order number, status, client name or email"
                            class="w-full border border-slate-200 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300">
                    </div>
                    <div class="flex items-center space-x-4">
                        <div>
                            <label for="sort" class="text-sm text-slate-600">Sort By:</label>
                            <select id="sort" 
                                class="border border-slate-200 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300">
                                <option value="id" selected>ID</option>
                                <option value="client_name">Client Name</option>
                                <option value="client_email">Client Email</option>
                                <option value="total_amount">Total Amount</option>
                                <option value="status">Status</option>
                                <option value="created_at">Creation Date</option>
                                <option value="updated_at">Last Update</option>
                            </select>
                        </div>
                        <div>
                            <label for="order" class="text-sm text-slate-600">Order:</label>
                            <select id="order" 
                                class="border border-slate-200 rounded-xl p-2.5 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-300">
                                <option value="asc" selected>Ascending</option>
                                <option value="desc">Descending</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Orders Table -->
                <div id="orders-table" class="overflow-x-auto">
                    @include('admin.orders.partial.orders-list', ['orders' => $orders])
                </div>
            </div>
        </div>
    </main>
@endsection
