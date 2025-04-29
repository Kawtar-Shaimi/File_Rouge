@extends('layouts.back-office')

@section('title', 'Profile')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')
    @include('layouts.publisher-sidebar')

    <main class="ml-64 p-8 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-8">
                <!-- User Profile -->
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 border-b border-slate-200 pb-8">
                    <div class="flex items-center space-x-6">
                        <img class="w-24 h-24 rounded-full border-4 border-teal-500"
                            src="https://ui-avatars.com/api/?name={{ Auth::guard('publisher')->user()->name }}&background=000&color=0d9488"
                            alt="{{ Auth::guard('publisher')->user()->name }}">
                        <div>
                            <h3 class="text-3xl font-bold text-slate-800">{{ Auth::guard('publisher')->user()->name }}</h3>
                            <p class="text-lg text-slate-600">Email : {{ Auth::guard('publisher')->user()->email }}</p>
                            <p class="text-lg text-slate-600">Phone : <span class="text-teal-600">{{ Auth::guard('publisher')->user()->phone }}</span></p>
                            <p class="text-slate-600 text-lg font-semibold">Role : <span class="text-teal-600">{{ Auth::guard('publisher')->user()->role }}</span></p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('users.edit', Auth::guard('publisher')->user()->uuid) }}"
                            class="px-6 py-3 bg-teal-600 text-white font-semibold rounded-xl shadow-sm hover:bg-teal-700 hover:shadow-md transition-all duration-300">
                            Edit Profile
                        </a>

                        <a href="{{ route('users.change-password.view', Auth::guard('publisher')->user()->uuid) }}"
                            class="px-6 py-3 bg-slate-600 text-white font-semibold rounded-xl shadow-sm hover:bg-slate-700 hover:shadow-md transition-all duration-300">
                            Change Password
                        </a>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-slate-800">Additional Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <h4 class="text-lg font-semibold text-slate-700">Name</h4>
                            <p class="text-slate-600">{{ Auth::guard('publisher')->user()->name }}</p>
                        </div>
                        <div class="space-y-2">
                            <h4 class="text-lg font-semibold text-slate-700">Email Verification</h4>
                            @if (Auth::guard('publisher')->user()->email_verified_at)
                                <p class="text-teal-600 font-medium">Verified</p>
                            @else
                                <p class="text-red-600 font-medium">Not Verified</p>
                            @endif
                        </div>
                        <div class="space-y-2">
                            <h4 class="text-lg font-semibold text-slate-700">Register Date</h4>
                            <p class="text-slate-600">{{ Auth::guard('publisher')->user()->created_at }}</p>
                        </div>
                        <div class="space-y-2">
                            <h4 class="text-lg font-semibold text-slate-700">Role</h4>
                            <p class="text-slate-600">{{ Auth::guard('publisher')->user()->role }}</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-bold text-slate-800">Recent Orders</h2>

                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="bg-slate-50">
                                    <th class="py-4 px-6 text-left text-slate-700 font-semibold">Order Number</th>
                                    <th class="py-4 px-6 text-left text-slate-700 font-semibold">Client</th>
                                    <th class="py-4 px-6 text-left text-slate-700 font-semibold">Email</th>
                                    <th class="py-4 px-6 text-left text-slate-700 font-semibold">Total Amount</th>
                                    <th class="py-4 px-6 text-left text-slate-700 font-semibold">Status</th>
                                    <th class="py-4 px-6 text-left text-slate-700 font-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($orders->count() > 0)
                                    @foreach ($orders as $order)
                                        <tr class="border-t border-slate-200 hover:bg-slate-50">
                                            <td class="py-4 px-6">
                                                <a href="{{ route('publisher.orders.show', $order->order->uuid) }}"
                                                    class="text-teal-600 hover:text-teal-700 font-medium">
                                                    #{{ $order->order->order_number }}
                                                </a>
                                            </td>
                                            <td class="py-4 px-6 text-slate-600">{{ $order->order->client->name }}</td>
                                            <td class="py-4 px-6 text-slate-600">{{ $order->order->client->email }}</td>
                                            <td class="py-4 px-6 font-semibold {{ $order->order->payment->status === 'paid' ? 'text-teal-600' : ($order->order->payment->status === 'failed' ? 'text-red-600' : 'text-slate-700') }}">
                                                ${{ $order->order->total_amount }}
                                            </td>
                                            <td class="py-4 px-6">
                                                @if (!$order->is_cancelled)
                                                    @if ($order->order->status == 'pending')
                                                        <span class="bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-sm font-medium">
                                                            {{ $order->order->status }}
                                                        </span>
                                                    @elseif ($order->order->status == 'in shipping')
                                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                                            {{ $order->order->status }}
                                                        </span>
                                                    @elseif ($order->order->status == 'completed')
                                                        <span class="bg-teal-100 text-teal-800 px-3 py-1 rounded-full text-sm font-medium">
                                                            {{ $order->order->status }}
                                                        </span>
                                                    @else
                                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                                            {{ $order->order->status }}
                                                        </span>
                                                    @endif
                                                @else
                                                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                                        Cancelled
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-6">
                                                <a href="{{ route('publisher.orders.show', $order->order->uuid) }}"
                                                    class="px-4 py-2 bg-teal-600 text-white rounded-xl hover:bg-teal-700 transition-all duration-300 text-sm font-medium">
                                                    Show
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="border-t border-slate-200">
                                        <td colspan="6" class="text-center py-8 px-6">
                                            <p class="text-slate-500 text-lg font-medium">No Orders Yet</p>
                                        </td>
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
