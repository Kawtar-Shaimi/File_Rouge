@extends('layouts.front-office')

@section('title', 'Profile')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white p-8 rounded-xl shadow-xl border-2 border-emerald-500/30 space-y-8">
            <!-- User Information -->
            <div class="flex items-center justify-between space-x-8 border-b border-slate-200 pb-8">
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <img class="w-24 h-24 rounded-full border-4 border-emerald-500 shadow-lg"
                            src="https://ui-avatars.com/api/?name={{ Auth::guard('client')->user()->name }}&background=000&color=10b981"
                            alt="{{ Auth::guard('client')->user()->name }}">
                        <div class="absolute -bottom-1 -right-1 p-1 bg-emerald-500 rounded-full">
                            <i class="fas fa-user-check text-white text-xs"></i>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold text-slate-800">{{ Auth::guard('client')->user()->name }}</h3>
                        <p class="text-lg text-slate-600 mt-1">Email : {{ Auth::guard('client')->user()->email }}</p>
                        <p class="text-lg text-slate-600 mt-1">Phone : <span class="text-emerald-600 font-medium">{{ Auth::guard('client')->user()->phone }}</span></p>
                        <p class="text-slate-600 text-lg font-semibold mt-1">Role : <span class="text-emerald-600">{{ Auth::guard('client')->user()->role }}</span></p>
                    </div>
                </div>

                <div class="flex flex-col space-y-3">
                    <a href="{{ route('users.edit', Auth::guard('client')->user()->uuid) }}"
                        class="px-6 py-2 bg-emerald-600 text-white font-medium rounded-lg shadow-md hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-200 transition-all duration-300 flex items-center justify-center space-x-2">
                        <i class="fas fa-user-edit"></i>
                        <span>Edit Profile</span>
                    </a>

                    <a href="{{ route('users.change-password.view', Auth::guard('client')->user()->uuid) }}"
                        class="px-6 py-2 bg-slate-600 text-white font-medium rounded-lg shadow-md hover:bg-slate-700 hover:shadow-lg hover:shadow-slate-200 transition-all duration-300 flex items-center justify-center space-x-2">
                        <i class="fas fa-key"></i>
                        <span>Change Password</span>
                    </a>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <div class="p-2 rounded-full bg-emerald-100">
                        <i class="fas fa-info-circle text-xl text-emerald-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800">Additional Information</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-slate-50 rounded-xl p-4">
                        <h4 class="text-lg font-semibold text-slate-800">Name</h4>
                        <p class="text-slate-600 mt-1">{{ Auth::guard('client')->user()->name }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4">
                        <h4 class="text-lg font-semibold text-slate-800">Email Verification</h4>
                        @if (Auth::guard('client')->user()->email_verified_at)
                            <p class="text-emerald-600 font-medium mt-1 flex items-center space-x-2">
                                <i class="fas fa-check-circle"></i>
                                <span>Verified</span>
                            </p>
                        @else
                            <p class="text-red-500 font-medium mt-1 flex items-center space-x-2">
                                <i class="fas fa-times-circle"></i>
                                <span>Not Verified</span>
                            </p>
                        @endif
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4">
                        <h4 class="text-lg font-semibold text-slate-800">Register Date</h4>
                        <p class="text-slate-600 mt-1">{{ Auth::guard('client')->user()->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4">
                        <h4 class="text-lg font-semibold text-slate-800">Role</h4>
                        <p class="text-slate-600 mt-1">{{ Auth::guard('client')->user()->role }}</p>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <div class="p-2 rounded-full bg-emerald-100">
                        <i class="fas fa-shopping-bag text-xl text-emerald-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800">Recent Orders</h2>
                </div>

                <div class="overflow-x-auto bg-slate-50 p-6 rounded-xl shadow-sm">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="bg-emerald-50">
                                <th class="py-3 px-4 text-left text-slate-800 font-medium">Order Number</th>
                                <th class="py-3 px-4 text-left text-slate-800 font-medium">Date</th>
                                <th class="py-3 px-4 text-left text-slate-800 font-medium">Total</th>
                                <th class="py-3 px-4 text-left text-slate-800 font-medium">Status</th>
                                <th class="py-3 px-4 text-left text-slate-800 font-medium">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->count() > 0)
                                @foreach ($orders as $order)
                                    <tr class="border-t border-slate-200 hover:bg-emerald-50/50 transition-colors">
                                        <td class="py-3 px-4 text-slate-600 italic underline hover:text-emerald-600">
                                            #{{ $order->order_number }}
                                        </td>
                                        <td class="py-3 px-4 text-slate-600">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td class="py-3 px-4 text-slate-600">${{ number_format($order->total_amount, 2) }}</td>
                                        <td class="py-3 px-4">
                                            @if ($order->status == 'pending')
                                                <span class="px-3 py-1 bg-amber-100 text-amber-800 text-xs rounded-full font-medium">
                                                    {{ $order->status }}
                                                </span>
                                            @elseif ($order->status == 'in shipping')
                                                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full font-medium">
                                                    {{ $order->status }}
                                                </span>
                                            @elseif ($order->status == 'completed')
                                                <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs rounded-full font-medium">
                                                    {{ $order->status }}
                                                </span>
                                            @else
                                                <span class="px-3 py-1 bg-red-100 text-red-800 text-xs rounded-full font-medium">
                                                    {{ $order->status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">
                                            <a href="{{ route('client.order.show', $order->uuid) }}"
                                                class="px-4 py-1 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-200 transition-all duration-300 flex items-center justify-center space-x-2">
                                                <i class="fas fa-eye"></i>
                                                <span>Show</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center py-8">
                                        <div class="flex flex-col items-center justify-center space-y-4">
                                            <div class="p-4 rounded-full bg-emerald-100">
                                                <i class="fas fa-shopping-bag text-4xl text-emerald-600"></i>
                                            </div>
                                            <p class="text-slate-600 text-xl font-medium">No Orders Yet</p>
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
</div>
@endsection
