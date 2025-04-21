@extends('layouts.back-office')

@section('title', 'Profile')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')

    @include('layouts.admin-sidebar')

    <div class="container mx-auto p-8">
        <div class="max-w-5xl ms-auto bg-white p-8 rounded-xl shadow-lg space-y-8">
            <!-- User Profile -->
            <div class="flex flex-col md:flex-row md:items-center justify-between space-y-6 md:space-y-0 md:space-x-8 border-b border-gray-100 pb-8">
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <div class="w-28 h-28 rounded-full bg-gradient-to-r from-teal-600 to-blue-800 flex items-center justify-center shadow-lg">
                            <img class="w-24 h-24 rounded-full border-4 border-white"
                                src="https://ui-avatars.com/api/?name={{ Auth::guard('admin')->user()->name }}&background=0891b2&color=fff"
                                alt="{{ Auth::guard('admin')->user()->name }}">
                        </div>
                        <div class="absolute bottom-1 right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-1">{{ Auth::guard('admin')->user()->name }}</h3>
                        <div class="flex items-center text-gray-500 mb-1">
                            <i class="fas fa-envelope text-teal-600 mr-2"></i>
                            <span>{{ Auth::guard('admin')->user()->email }}</span>
                        </div>
                        <div class="flex items-center text-gray-500 mb-1">
                            <i class="fas fa-phone text-teal-600 mr-2"></i>
                            <span>{{ Auth::guard('admin')->user()->phone }}</span>
                        </div>
                        <div class="flex items-center text-gray-500">
                            <i class="fas fa-user-shield text-teal-600 mr-2"></i>
                            <span class="font-medium text-blue-800">{{ Auth::guard('admin')->user()->role }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('users.edit', Auth::guard('admin')->user()->uuid) }}"
                        class="px-6 py-3 bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white font-medium rounded-lg shadow hover:shadow-lg transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-user-edit mr-2"></i> Edit Profile
                    </a>

                    <a href="{{ route('users.change-password.view', Auth::guard('admin')->user()->uuid) }}"
                        class="px-6 py-3 bg-gradient-to-r from-blue-700 to-blue-800 hover:from-blue-800 hover:to-blue-900 text-white font-medium rounded-lg shadow hover:shadow-lg transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-key mr-2"></i> Change Password
                    </a>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <h2 class="text-2xl font-bold text-gray-800">Additional Information</h2>
                    <div class="h-0.5 flex-1 bg-gradient-to-r from-teal-500 to-blue-500 opacity-20 rounded-full"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-6 rounded-xl">
                    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100">
                        <h4 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                            <i class="fas fa-id-card text-teal-600 mr-2"></i> Name
                        </h4>
                        <p class="text-gray-700">{{ Auth::guard('admin')->user()->name }}</p>
                    </div>
                    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100">
                        <h4 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                            <i class="fas fa-check-circle text-teal-600 mr-2"></i> Email Verification
                        </h4>
                        @if (Auth::guard('admin')->user()->email_verified_at)
                            <div class="flex items-center">
                                <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                                <p class="text-green-600 font-medium">Verified</p>
                            </div>
                        @else
                            <div class="flex items-center">
                                <span class="inline-block w-2 h-2 rounded-full bg-red-500 mr-2"></span>
                                <p class="text-red-600 font-medium">Not Verified</p>
                            </div>
                        @endif
                    </div>
                    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100">
                        <h4 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                            <i class="fas fa-calendar-alt text-teal-600 mr-2"></i> Register Date
                        </h4>
                        <p class="text-gray-700">{{ Auth::guard('admin')->user()->created_at->format('F d, Y') }}</p>
                    </div>
                    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100">
                        <h4 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                            <i class="fas fa-user-tag text-teal-600 mr-2"></i> Role
                        </h4>
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full font-medium">
                            {{ Auth::guard('admin')->user()->role }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Order History -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <h2 class="text-2xl font-bold text-gray-800">Recent Orders</h2>
                    <div class="h-0.5 flex-1 bg-gradient-to-r from-teal-500 to-blue-500 opacity-20 rounded-full"></div>
                </div>

                <div class="overflow-x-auto bg-gray-50 p-6 rounded-xl shadow-sm border border-gray-100">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr>
                                <th class="py-3 px-4 text-left text-gray-700 font-semibold bg-gray-100 rounded-tl-lg">ID</th>
                                <th class="py-3 px-4 text-left text-gray-700 font-semibold bg-gray-100">Order Number</th>
                                <th class="py-3 px-4 text-left text-gray-700 font-semibold bg-gray-100">Client</th>
                                <th class="py-3 px-4 text-left text-gray-700 font-semibold bg-gray-100">Email</th>
                                <th class="py-3 px-4 text-left text-gray-700 font-semibold bg-gray-100">Total Amount</th>
                                <th class="py-3 px-4 text-left text-gray-700 font-semibold bg-gray-100">Status</th>
                                <th class="py-3 px-4 text-left text-gray-700 font-semibold bg-gray-100 rounded-tr-lg">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @if ($orders->count() > 0)
                                @foreach ($orders as $order)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-3 px-4 text-blue-600 font-medium">
                                            <a href="{{ route('admin.orders.show', $order->uuid) }}" class="hover:underline">
                                                #{{ substr($order->uuid, 0, 8) }}
                                            </a>
                                        </td>
                                        <td class="py-3 px-4 text-blue-600 font-medium">
                                            <a href="{{ route('admin.orders.show', $order->uuid) }}" class="hover:underline">
                                                #{{ $order->order_number }}
                                            </a>
                                        </td>
                                        <td class="py-3 px-4 text-gray-700">{{ $order->client->name }}</td>
                                        <td class="py-3 px-4 text-gray-700">{{ $order->client->email }}</td>
                                        <td class="py-3 px-4 font-medium {{ $order->payment->status === 'paid' ? 'text-green-600' : ($order->payment->status === 'failed' ? 'text-red-600' : 'text-gray-800') }}">
                                            ${{ $order->total_amount }}
                                        </td>
                                        <td class="py-3 px-4">
                                            @if ($order->status == 'pending')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 mr-1.5"></span>
                                                    {{ $order->status }}
                                                </span>
                                            @elseif ($order->status == 'in shipping')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-1.5"></span>
                                                    {{ $order->status }}
                                                </span>
                                            @elseif ($order->status == 'completed')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                                    {{ $order->status }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span>
                                                    {{ $order->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('admin.orders.edit', $order->uuid) }}"
                                                    class="px-3 py-1 bg-teal-600 hover:bg-teal-700 text-white text-xs font-medium rounded transition-colors flex items-center">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.orders.delete', $order->uuid) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded transition-colors flex items-center">
                                                        <i class="fas fa-trash-alt mr-1"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="py-8 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <i class="fas fa-box-open text-gray-300 text-5xl mb-3"></i>
                                            <p class="text-gray-500 font-medium text-lg">No Orders Yet</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
