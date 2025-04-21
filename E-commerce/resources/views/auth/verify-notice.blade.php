@extends('layouts.front-office')

@section('title', 'Verify Your Email')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
        <div class="max-w-md w-full bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-900 to-teal-800 py-6 px-8">
                <h2 class="text-2xl font-bold text-white text-center">Verify Your Email</h2>
                <p class="text-teal-100 text-center mt-1 text-sm">One more step to get started</p>
            </div>
            
            <div class="p-8">
                <div class="text-center mb-6">
                    <div class="bg-teal-50 rounded-full w-20 h-20 mx-auto flex items-center justify-center mb-4">
                        <i class="fas fa-envelope text-4xl text-teal-600"></i>
                    </div>
                </div>
                
                <p class="text-gray-700 text-base mb-6 leading-relaxed text-center">
                    We've sent a verification link to your email address.
                    Please check your inbox and click the link to verify your account.
                </p>
                
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-r">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-600"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-800">
                                If you don't see the email in your inbox, please check your spam folder.
                            </p>
                        </div>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('verify.resend', $user->uuid) }}" class="mb-6">
                    @csrf
                    <button type="submit" 
                        class="w-full py-3 px-4 bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white font-medium rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-paper-plane mr-2"></i> Resend Verification Email
                    </button>
                </form>
                
                <div class="text-center text-sm text-gray-600 space-y-1">
                    <p>Make sure you've entered the correct email address.</p>
                    <p>The verification link will expire after 15 minutes.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
