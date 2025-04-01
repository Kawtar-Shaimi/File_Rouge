@extends('layouts.front-office')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-gray-800/50 backdrop-blur-sm rounded-xl border border-gray-700/50 p-8">
            <h2 class="text-3xl font-semibold text-white text-center mb-6">Verify Your Email Address</h2>
            @if (session('resent'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                    A fresh verification link has been sent to your email address.
                </div>
            @endif
            <p class="text-gray-300 mb-6">
                Before proceeding, please check your email for a verification link. If you did not receive the email,
                <form class="inline" method="POST" action="">
                    @csrf
                    <button type="submit" class="text-purple-500 hover:underline">click here to request another</button>.
                </form>
            </p>
        </div>
    </div>
</div>
@endsection
