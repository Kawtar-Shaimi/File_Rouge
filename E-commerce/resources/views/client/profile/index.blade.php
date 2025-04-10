@extends('layouts.front-office')

@section('title', 'Profile')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')

    <div class="container mx-auto p-8">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-xl space-y-6">
            <!-- Informations Utilisateur -->
            <div class="flex items-center justify-between space-x-8 border-b pb-6">
                <div class="flex items-center space-x-4">
                    <img class="w-24 h-24 rounded-full border-4 border-indigo-600 "
                        src="https://ui-avatars.com/api/?name={{ Auth::guard('client')->user()->name }}&background=000&color=c084fc"
                        alt="{{ Auth::guard('client')->user()->name }}">
                    <div>
                        <h3 class="text-3xl font-bold text-gray-800">{{ Auth::guard('client')->user()->name }}</h3>
                        <p class="text-lg text-gray-600">Email : {{ Auth::guard('client')->user()->email }}</p>
                        <p class="text-lg text-gray-600">Phone : <span
                                class="text-indigo-500">{{ Auth::guard('client')->user()->phone }}</span></p>
                        <p class="text-gray-600 text-lg font-semibold">Role : <span
                                class="text-indigo-500">{{ Auth::guard('client')->user()->role }}</span></p>
                    </div>
                </div>

                <a href="{{ route('users.edit', Auth::guard('client')->user()->uuid) }}"
                    class="px-6 py-2 bg-purple-400 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition-all duration-300">
                    Edit Profile
                </a>

                <a href="{{ route('users.change-password.view', Auth::guard('client')->user()->uuid) }}"
                    class="px-6 py-2 bg-gray-400 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition-all duration-300">
                    Change Password
                </a>
            </div>

            <!-- Additional Information -->
            <div class="space-y-6">
                <h2 class="text-2xl font-bold text-gray-800">Additional Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <h4 class="text-lg font-semibold text-gray-800">Name</h4>
                        <p class="text-gray-600">{{ Auth::guard('client')->user()->name }}</p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-lg font-semibold text-gray-800">Email Verification</h4>
                        @if (Auth::guard('client')->user()->email_verified_at)
                            <p class="text-gray-600">Verified</p>
                        @else
                            <p class="text-red-600">Not Verified</p>
                        @endif

                    </div>
                    <div class="space-y-2">
                        <h4 class="text-lg font-semibold text-gray-800">Register Date</h4>
                        <p class="text-gray-600">{{ Auth::guard('client')->user()->created_at }}</p>
                    </div>
                    <div class="space-y-2">
                        <h4 class="text-lg font-semibold text-gray-800">Role</h4>
                        <p class="text-gray-600">{{ Auth::guard('client')->user()->role }}</p>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="space-y-6">
                <h2 class="text-2xl font-bold text-gray-800">Recent Orders:</h2>

                <div class="overflow-x-auto bg-gray-100 p-6 rounded-lg shadow-lg">
                    <table class="min-w-full text-sm">
                        <thead class="text-gray-600">
                            <tr class="bg-indigo-100">
                                <th class="py-3 px-4 text-left">Order Number</th>
                                <th class="py-3 px-4 text-left">Date</th>
                                <th class="py-3 px-4 text-left">Total</th>
                                <th class="py-3 px-4 text-left">Statut</th>
                                <th class="py-3 px-4 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->count() > 0)
                                @foreach ($orders as $order)
                                    <tr class="border-t hover:bg-indigo-50 text-gray-600">
                                        <td class="py-3 px-4 italic underline hover:text-blue-400">
                                            #{{ $order->order_number }}</td>
                                        <td class="py-3 px-4">{{ $order->created_at }}</td>
                                        <td class="py-3 px-4">${{ $order->total_amount }}</td>
                                        <td class="py-3 px-4">
                                            @if ($order->status == 'pending')
                                                <span
                                                    class="px-3 py-1 bg-yellow-500 text-white text-xs rounded-full">{{ $order->status }}</span>
                                            @elseif ($order->status == 'in shipping')
                                                <span
                                                    class="px-3 py-1 bg-blue-500 text-white text-xs rounded-full">{{ $order->status }}</span>
                                            @elseif ($order->status == 'completed')
                                                <span
                                                    class="px-3 py-1 bg-green-500 text-white text-xs rounded-full">{{ $order->status }}</span>
                                            @else
                                                <span
                                                    class="px-3 py-1 bg-red-500 text-white text-xs rounded-full">{{ $order->status }}</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4">
                                            <a href="{{ route('client.order.show', $order->uuid) }}"
                                                class="px-4 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition duration-300">Show</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-red-500 text-center py-3 px-6 text-2xl font-bold">No
                                        Orders Yet</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
