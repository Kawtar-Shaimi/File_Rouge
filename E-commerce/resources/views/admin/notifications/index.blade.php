@extends('layouts.back-office')

@section('title', 'Notifications List')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/notifications/notifications.js'])
@endsection

@section('content')
    @include('layouts.admin-sidebar')

    <main class="ml-64 p-8 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <!-- Notifications Header -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-slate-800">My Notifications</h2>
                <p class="text-sm text-slate-500 mt-1">Stay updated with your latest activities</p>
            </div>

            <!-- Notifications Container -->
            <div id="notifications-container" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 space-y-4">
                @php
                    $admin = Auth::guard('admin')->user();
                @endphp
                @if ($admin->notifications->count() > 0)
                    @foreach ($admin->notifications as $notification)
                        <div id="notification-{{ $notification->id }}"
                            class="p-6 rounded-xl border border-slate-200 @if ($notification->read_at) bg-white @else bg-slate-50 @endif transition-all duration-300 hover:shadow-md">
                            <p class="text-slate-800 text-lg">{{ $notification->data['message'] }}. 
                                @if ($notification->data['url'])
                                    <a class="text-teal-600 hover:text-teal-700 font-medium transition-colors duration-300"
                                        href="{{ $notification->data['url'] }}">{{ $notification->data['url_text'] }}</a>
                                @endif
                            </p>
                            <div class="flex justify-end items-center space-x-4 mt-4">
                                @if (!$notification->read_at)
                                    <button id="mark-as-read-{{ $notification->id }}" 
                                        class="text-teal-600 hover:text-teal-700 font-medium transition-colors duration-300"
                                        onclick="markAsRead(event, '{{ $notification->id }}', 'admin')">
                                        Mark as read
                                    </button>
                                @endif
                                <button id="delete" 
                                    class="text-red-600 hover:text-red-700 font-medium transition-colors duration-300"
                                    onclick="deleteNotification(event, '{{ $notification->id }}', 'admin')">
                                    Delete
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="py-12 flex items-center justify-center">
                        <p class="text-slate-600 text-2xl font-semibold text-center">You have no notifications</p>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
