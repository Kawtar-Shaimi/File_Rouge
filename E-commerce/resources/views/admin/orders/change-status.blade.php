@extends('layouts.back-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/admin/orders/changeStatusInputValidation.js',
    ])
@endsection

@section('content')

@include('layouts.admin-sidebar')

<div class="container w-5/6 ms-auto p-6">
    <div class="max-w-lg mx-auto">
        <div class="mt-10">
            <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Change Order Status</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">

                <form id="update-form" action="{{ route('admin.orders.update', $order->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status" class="w-full p-3 border rounded-lg mt-1" required>
                            <option value="">Select Status</option>
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }} {{ $order->status == 'in shipping' || $order->status == 'completed' || $order->status == 'cancelled' ? 'disabled' : '' }}>Pending</option>
                            <option value="in shipping" {{ $order->status == 'in shipping' ? 'selected' : '' }} {{ $order->status == 'completed' || $order->status == 'cancelled' ? 'disabled' : '' }}>In Shipping</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }} {{ $order->status == 'cancelled' ? 'disabled' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }} {{ $order->status == 'completed' ? 'disabled' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <p id="status-error" class="text-red-500 text-xs mt-1"></p>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <div id="cancel_reason" class="hidden">
                        <div class="mb-4">
                            <label for="reason" class="text-sm font-medium text-gray-700">Reason</label>
                            <input type="text" id="reason" name="reason"
                                class="w-full p-3 border rounded-lg mt-1" required>
                        </div>
                        <p id="reason-error" class="text-red-500 text-xs mt-1"></p>
                        @error('reason')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button id="update-status" type="submit"
                        class="w-full bg-purple-400 text-white p-3 rounded-lg hover:bg-blue-700 transition mt-4">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
