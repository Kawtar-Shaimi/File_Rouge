@extends('layouts.front-office')

@section('title', 'Reset Password')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')
    <main class="min-h-screen bg-purple-400 flex items-center justify-center py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-lg">
                <h2 class="text-3xl font-semibold text-gray-800 text-center mb-6">Reset Your Password</h2>

                <p class="text-gray-700 text-base mb-6 leading-relaxed">
                    Please check your email for the password reset link.
                    If you did not receive the email,
                <form method="POST" action="{{ route('reset.resend', $user->uuid) }}" class="inline">
                    @csrf
                    <button type="submit" class="text-purple-600 font-medium hover:underline">click here to request
                        another</button>.
                </form>
                </p>

                <div class="text-sm text-center text-gray-500">
                    If the email doesn't arrive in a few minutes, check your spam folder or ensure your email address is
                    correct.
                </div>
            </div>
        </div>
    </main>
@endsection
