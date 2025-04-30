@extends('layouts.back-office')

@section('title', 'Notifications List')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/notifications/notifications.js'])
@endsection

@section('content')
    @include('layouts.publisher-sidebar')

    <main class="ml-64 p-8 bg-slate-50 min-h-screen">
        <div class="max-w-4xl mx-auto">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-slate-800">My Notifications</h2>
                <p class="text-sm text-slate-500 mt-1">Stay updated with your latest activities</p>
            </div>

            <div id="notifications-container" class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 space-y-4">
                @php
                    $publisher = Auth::guard('publisher')->user();
                @endphp

                @if ($publisher->notifications->count() > 0)
                    @foreach ($publisher->notifications as $notification)
                        <div id="notification-{{ $notification->id }}"
                            class="p-6 rounded-xl border border-slate-200 transition-all duration-300
                                @if ($notification->read_at) 
                                    bg-white hover:bg-slate-50 
                                @else 
                                    bg-teal-50 border-teal-200 hover:bg-teal-100 
                                @endif">
                            <div class="flex flex-col space-y-3">
                                <p class="text-slate-700 @if (!$notification->read_at) font-medium @endif">
                                    {{ $notification->data['message'] }}
                                    @if ($notification->data['url'])
                                        <a class="text-teal-600 hover:text-teal-700 font-medium ml-1"
                                            href="{{ $notification->data['url'] }}">
                                            {{ $notification->data['url_text'] }}
                                        </a>
                                    @endif
                                </p>
                                <div class="flex justify-end items-center space-x-4">
                                    @if (!$notification->read_at)
                                        <button id="mark-as-read-{{ $notification->id }}" 
                                            class="text-teal-600 hover:text-teal-700 font-medium transition-colors duration-300"
                                            onclick="markAsRead(event, '{{ $notification->id }}', 'publisher')">
                                            Mark as read
                                        </button>
                                    @endif
                                    <button id="delete" 
                                        class="text-red-600 hover:text-red-700 font-medium transition-colors duration-300"
                                        onclick="deleteNotification(event, '{{ $notification->id }}', 'publisher')">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="py-12 flex flex-col items-center justify-center space-y-4">
                        <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center">
                            <i class="fas fa-bell text-2xl text-slate-400"></i>
                        </div>
                        <p class="text-slate-500 text-lg font-medium">You have no notifications</p>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
