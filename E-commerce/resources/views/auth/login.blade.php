@extends('layouts.front-office')

@section('title', 'Login')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/auth/loginInputValidation.js'])
@endsection

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-teal-50 to-slate-100 py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
        <div class="max-w-md w-full bg-white rounded-2xl shadow-sm overflow-hidden transform transition-all border border-slate-200">
            <div class="bg-gradient-to-r from-teal-600 to-slate-600 py-8 px-8 relative">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-20 h-20 rounded-full bg-teal-200 opacity-20 blur-xl"></div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-16 h-16 rounded-full bg-slate-200 opacity-20 blur-xl"></div>
                <h2 class="text-2xl font-extrabold text-white text-center">Welcome Back</h2>
                <p class="text-white text-center mt-2 text-sm">Sign in to your account</p>
            </div>
            
            <div class="p-8 space-y-8 bg-gradient-to-b from-white to-slate-50">
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-slate-500 group-hover:text-slate-600 transition-colors"></i>
                            </div>
                            <input type="email" id="email" name="email" 
                                class="w-full pl-10 pr-3 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent bg-white shadow-sm hover:shadow transition-all"
                                value="{{ old('email') }}" required placeholder="your@email.com">
                        </div>
                        <p id="emailErr" class="text-red-500 text-sm mt-1"></p>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-slate-500 group-hover:text-slate-600 transition-colors"></i>
                            </div>
                            <input type="password" id="password" name="password" 
                                class="w-full pl-10 pr-10 py-3 border-2 border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent bg-white shadow-sm hover:shadow transition-all"
                                required placeholder="••••••••">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fa-solid fa-eye text-slate-500 hover:text-slate-700 cursor-pointer" id="togglePassword"></i>
                            </div>
                        </div>
                        <p id="passwordErr" class="text-red-500 text-sm mt-1"></p>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember" 
                                class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-slate-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-slate-700">Remember me</label>
                        </div>
                        <a href="{{ route('reset.forget-password') }}" class="text-sm font-medium text-teal-600 hover:text-teal-700 underline-offset-2 hover:underline">
                            Forgot password?
                        </a>
                    </div>

                    <button id="login" type="submit"
                        class="w-full py-4 px-4 bg-gradient-to-r from-teal-600 to-slate-600 hover:from-teal-700 hover:to-slate-700 text-white font-bold rounded-xl transition-all duration-300 shadow-sm hover:shadow-md transform hover:-translate-y-1 border border-slate-200">
                        <i class="fas fa-sign-in-alt mr-2"></i> Sign in
                    </button>

                    <div class="text-center mt-4">
                        <p class="text-sm text-slate-600">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="font-medium text-teal-600 hover:text-teal-700 underline-offset-2 hover:underline">
                                Create account
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
