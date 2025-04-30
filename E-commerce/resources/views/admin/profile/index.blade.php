@extends('layouts.back-office')

@section('title', 'Profile')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')
    @include('layouts.admin-sidebar')

    <main class="ml-64 p-8 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-8">
                <!-- User Profile -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 border-b border-slate-200 pb-8">
                    <div class="flex items-center space-x-6">
                        <img class="w-24 h-24 rounded-full border-4 border-teal-500"
                            src="https://ui-avatars.com/api/?name={{ Auth::guard('admin')->user()->name }}&background=000&color=0d9488"
                            alt="{{ Auth::guard('admin')->user()->name }}">
                        <div>
                            <h3 class="text-3xl font-bold text-slate-800">{{ Auth::guard('admin')->user()->name }}</h3>
                            <p class="text-lg text-slate-600">Email : {{ Auth::guard('admin')->user()->email }}</p>
                            <p class="text-lg text-slate-600">Phone : <span class="text-teal-600">{{ Auth::guard('admin')->user()->phone }}</span></p>
                            <p class="text-slate-600 text-lg font-semibold">Role : <span class="text-teal-600">{{ Auth::guard('admin')->user()->role }}</span></p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('users.edit', Auth::guard('admin')->user()->uuid) }}"
                            class="px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-xl transition-colors duration-300 flex items-center justify-center">
                            Edit Profile
                        </a>

                        <a href="{{ route('users.change-password.view', Auth::guard('admin')->user()->uuid) }}"
                            class="px-6 py-2 bg-slate-600 hover:bg-slate-700 text-white font-semibold rounded-xl transition-colors duration-300 flex items-center justify-center">
                            Change Password
                        </a>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-slate-800">Additional Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <h4 class="text-lg font-semibold text-slate-800">Name</h4>
                            <p class="text-slate-600">{{ Auth::guard('admin')->user()->name }}</p>
                        </div>
                        <div class="space-y-2">
                            <h4 class="text-lg font-semibold text-slate-800">Email Verification</h4>
                            @if (Auth::guard('admin')->user()->email_verified_at)
                                <p class="text-slate-600">Verified</p>
                            @else
                                <p class="text-red-600">Not Verified</p>
                            @endif
                        </div>
                        <div class="space-y-2">
                            <h4 class="text-lg font-semibold text-slate-800">Register Date</h4>
                            <p class="text-slate-600">{{ Auth::guard('admin')->user()->created_at }}</p>
                        </div>
                        <div class="space-y-2">
                            <h4 class="text-lg font-semibold text-slate-800">Role</h4>
                            <p class="text-slate-600">{{ Auth::guard('admin')->user()->role }}</p>
                        </div>
                    </div>
                </div>

                <!-- Order History -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-slate-800">Recent Orders</h2>

                    <div class="overflow-x-auto bg-slate-50 p-6 rounded-xl border border-slate-200">
                        <table class="min-w-full text-sm">
                            <thead class="text-slate-600">
                                <tr class="bg-slate-100">
                                    <th class="py-3 px-4 text-left">ID</th>
                                    <th class="py-3 px-4 text-left">Order Number</th>
                                    <th class="py-3 px-4 text-left">Client</th>
                                    <th class="py-3 px-4 text-left">Email</th>
                                    <th class="py-3 px-4 text-left">Total Amount</th>
                                    <th class="py-3 px-4 text-left">Status</th>
                                    <th class="py-3 px-4 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($orders->count() > 0)
                                    @foreach ($orders as $order)
                                        <tr class="border-t border-slate-200 hover:bg-slate-50 text-slate-600">
                                            <td class="py-3 px-4 underline italic hover:text-teal-600">
                                                <a href="{{ route('admin.orders.show', $order->uuid) }}">#{{ $order->uuid }}</a>
                                            </td>
                                            <td class="py-3 px-4 underline italic hover:text-teal-600">
                                                <a href="{{ route('admin.orders.show', $order->uuid) }}">#{{ $order->order_number }}</a>
                                            </td>
                                            <td class="py-3 px-4">{{ $order->client->name }}</td>
                                            <td class="py-3 px-4">{{ $order->client->email }}</td>
                                            <td class="py-3 px-4 font-bold {{ $order->payment->status === 'paid' ? 'text-green-600' : ($order->payment->status === 'failed' ? 'text-red-600' : 'text-slate-800') }}">
                                                ${{ $order->total_amount }}
                                            </td>
                                            <td class="py-3 px-4">
                                                @if ($order->status == 'pending')
                                                    <span class="bg-yellow-500 text-white px-3 py-1 rounded-xl">{{ $order->status }}</span>
                                                @elseif ($order->status == 'in shipping')
                                                    <span class="bg-blue-500 text-white px-3 py-1 rounded-xl">{{ $order->status }}</span>
                                                @elseif ($order->status == 'completed')
                                                    <span class="bg-green-500 text-white px-3 py-1 rounded-xl">{{ $order->status }}</span>
                                                @else
                                                    <span class="bg-red-500 text-white px-3 py-1 rounded-xl">{{ $order->status }}</span>
                                                @endif
                                            </td>
                                            <td class="py-3 px-4 space-x-2">
                                                <a href="{{ route('admin.orders.edit', $order->uuid) }}"
                                                    class="bg-teal-600 hover:bg-teal-700 text-white px-3 py-1 rounded-xl transition-colors duration-300">Update</a>
                                                <form action="{{ route('admin.orders.delete', $order->uuid) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-xl transition-colors duration-300">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="border-t border-slate-200 hover:bg-slate-50 text-slate-600">
                                        <td colspan="7" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No Orders Yet</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
