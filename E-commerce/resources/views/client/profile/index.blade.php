@extends('layouts.front-office')

@section('title', 'Profile')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')

    <div class="container mx-auto p-6 lg:p-8">
        <div class="mb-6">
            <h1 class="text-lg lg:text-xl font-bold text-gray-800 mb-1">Your Profile</h1>
            <p class="text-xs text-gray-500">Manage your account details and preferences</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-6">
            <!-- Informations Utilisateur -->
            <div class="flex flex-col md:flex-row md:items-center justify-between md:space-x-8 border-b border-gray-100 pb-6">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <div class="w-16 h-16 rounded-lg bg-gradient-to-r from-teal-500 to-teal-600 flex items-center justify-center text-white text-xl font-bold shadow-md">
                            {{ substr(Auth::guard('client')->user()->name, 0, 1) }}
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ Auth::guard('client')->user()->name }}</h3>
                        <p class="text-sm text-gray-600">{{ Auth::guard('client')->user()->email }}</p>
                        <div class="flex items-center mt-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500 mr-1.5"></span>
                            <p class="text-xs text-gray-500">{{ Auth::guard('client')->user()->role }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex space-x-3 mt-4 md:mt-0">
                    <a href="{{ route('users.edit', Auth::guard('client')->user()->uuid) }}"
                        class="px-4 py-2 bg-teal-600 text-white text-sm font-medium rounded-lg shadow-sm hover:bg-teal-700 transition-all duration-200">
                        <i class="fas fa-edit mr-1.5"></i> Edit Profile
                    </a>

                    <a href="{{ route('users.change-password.view', Auth::guard('client')->user()->uuid) }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded-lg shadow-sm hover:bg-gray-300 transition-all duration-200">
                        <i class="fas fa-key mr-1.5"></i> Change Password
                    </a>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="py-6 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Additional Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-sm font-semibold text-gray-600">Full Name</h4>
                        <p class="text-gray-800 mt-1">{{ Auth::guard('client')->user()->name }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-sm font-semibold text-gray-600">Email Verification</h4>
                        @if (Auth::guard('client')->user()->email_verified_at)
                            <div class="flex items-center mt-1">
                                <span class="w-2 h-2 rounded-full bg-green-500 mr-1.5"></span>
                                <p class="text-green-600">Verified</p>
                            </div>
                        @else
                            <div class="flex items-center mt-1">
                                <span class="w-2 h-2 rounded-full bg-red-500 mr-1.5"></span>
                                <p class="text-red-600">Not Verified</p>
                            </div>
                        @endif
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-sm font-semibold text-gray-600">Phone Number</h4>
                        <p class="text-gray-800 mt-1">{{ Auth::guard('client')->user()->phone ?: 'Not provided' }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-sm font-semibold text-gray-600">Registered Since</h4>
                        <p class="text-gray-800 mt-1">{{ Auth::guard('client')->user()->created_at }}</p>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="pt-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-gray-800">Recent Orders</h2>
                </div>

                <div class="rounded-lg border border-gray-200 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Number</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($orders->count() > 0)
                                @foreach ($orders as $order)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 whitespace-nowrap text-teal-600 hover:text-teal-800">
                                            <a href="{{ route('client.order.show', $order->uuid) }}" class="font-medium">
                                                #{{ $order->order_number }}
                                            </a>
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">{{ $order->created_at }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-800">${{ $order->total_amount }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            @if ($order->status == 'pending')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    {{ $order->status }}
                                                </span>
                                            @elseif ($order->status == 'in shipping')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $order->status }}
                                                </span>
                                            @elseif ($order->status == 'completed')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    {{ $order->status }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    {{ $order->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <a href="{{ route('client.order.show', $order->uuid) }}" 
                                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded 
                                                text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                                                View details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center">
                                        <div class="text-center">
                                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <p class="text-sm font-semibold text-gray-400">No Orders Yet</p>
                                            <p class="text-gray-500 mt-1 text-xs">Orders will appear here when received.</p>
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
