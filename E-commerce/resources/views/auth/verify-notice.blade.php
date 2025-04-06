@extends('layouts.front-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
@endsection

@section('content')
<main class="min-h-screen bg-purple-400 flex items-center justify-center py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-lg">
            <h2 class="text-3xl font-semibold text-gray-800 text-center mb-6">Verify Your Email</h2>

            @if (session('resent'))
                <div class="bg-green-100 text-green-700 p-4 rounded-md border border-green-300 mb-6">
                    A fresh verification link has been sent to your email address.
                </div>
            @endif

            <p class="text-gray-700 text-base mb-6 leading-relaxed">
                Before proceeding, please check your email for a verification link.
                If you did not receive the email,
                <form method="POST" action="{{ route('verify.resend', $user) }}" class="inline">
                    @csrf
                    <button type="submit" class="text-purple-600 font-medium hover:underline">click here to request another</button>.
                </form>
            </p>

            <div class="text-sm text-center text-gray-500">
                If the email doesn't arrive in a few minutes, check your spam folder or ensure you entered the correct address.
            </div>
        </div>
    </div>
</main>
@endsection
