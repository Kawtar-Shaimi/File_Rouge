@extends('layouts.back-office')

@section('title', 'Orders List')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/publisher/orders/orders.js', 'resources/js/publisher/orders/cancelOrder.js'])
@endsection

@section('content')
    @include('layouts.publisher-sidebar')

    <main class="ml-64 p-8 bg-slate-50 min-h-screen">
        <!-- Orders Table -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-slate-800">Orders Management</h2>
                <p class="text-sm text-slate-500 mt-1">View and manage customer orders</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
            <!-- Search and Filters -->
            <div class="mb-8 flex flex-col md:flex-row gap-6 items-start md:items-center">
                <div class="w-full md:w-1/3">
                    <div class="relative">
                        <input type="text" 
                               id="search" 
                               placeholder="Search orders..."
                               class="w-full border border-slate-200 rounded-xl pl-12 pr-4 py-3 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all duration-300 text-slate-700 placeholder-slate-400">
                        <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                    </div>
                </div>
                
                <div class="flex flex-col md:flex-row gap-4 w-full md:w-2/3">
                    <div class="flex items-center space-x-3">
                        <label for="sort" class="text-sm font-medium text-slate-700">Sort By:</label>
                        <select id="sort" 
                                class="border border-slate-200 rounded-xl px-4 py-2.5 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all duration-300 text-slate-700">
                            <option value="order_number" selected>Order Number</option>
                            <option value="client_name">Client Name</option>
                            <option value="client_email">Client Email</option>
                            <option value="total_amount">Total Amount</option>
                            <option value="status">Status</option>
                            <option value="created_at">Creation Date</option>
                            <option value="updated_at">Last Update</option>
                        </select>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <label for="order" class="text-sm font-medium text-slate-700">Order:</label>
                        <select id="order" 
                                class="border border-slate-200 rounded-xl px-4 py-2.5 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 transition-all duration-300 text-slate-700">
                            <option value="asc" selected>Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div id="orders-table" class="overflow-x-auto rounded-xl border border-slate-200">
                @include('publisher.orders.partial.orders-list', ['orders' => $orders])
            </div>
        </div>
    </main>
@endsection
