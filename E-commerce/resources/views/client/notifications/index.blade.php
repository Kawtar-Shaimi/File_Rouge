@extends('layouts.front-office')

@section('title', 'My Notifications')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/notifications/notifications.js'])
@endsection

@section('content')

    <div class="container mx-auto p-6">
        <div id="notifications-container" class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">My Notifications</h2>
            @php
                $user = \App\Models\User::find(Auth::guard('client')->user()->id);
            @endphp

            @if ($user->notifications->count() > 0)
                @foreach ($user->notifications as $notification)
                    <div id="notification-{{ $notification->id }}"
                        class="p-4 rounded-lg mb-4 @if ($notification->read_at) bg-gray-200 @else bg-gray-400 @endif">
                        <p class="text-gray-800">{{ $notification->data['message'] }}. @if ($notification->data['url'])
                                <a class="text-blue-500 hover:underline"
                                    href="{{ $notification->data['url'] }}">{{ $notification->data['url_text'] }}</a>
                            @endif
                        </p>
                        <div class="flex justify-end items-center space-x-3">
                            @if (!$notification->read_at)
                                <p id="mark-as-read-{{ $notification->id }}" class="text-blue-500 cursor-pointer hover:underline"
                                    onclick="markAsRead(event, '{{ $notification->id }}', 'client')">Mark as read</p>
                            @endif
                            <p id="delete" class="text-red-500 cursor-pointer hover:underline"
                                onclick="deleteNotification(event, '{{ $notification->id }}', 'client')">Delete</p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="py-10 flex items-center justify-center">
                    <p class="text-red-500 text-4xl font-bold text-center">You have no notifications</p>
                </div>
            @endif
        </div>
    </div>
@endsection
