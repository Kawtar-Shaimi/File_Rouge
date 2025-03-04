@extends('layouts.app')

@section('content')
<div class="w-full flex justify-center items-center min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-16 overflow-hidden">

    <!-- Login Form Card -->
    <div class="max-w-md w-full space-y-8 bg-white/10 backdrop-blur-md p-8 rounded-xl shadow-2xl transform transition duration-500 hover:scale-105 relative z-10">
        <!-- Form Header -->
        <div class="text-center">
            <h2 class="mt-6 text-4xl font-extrabold text-white tracking-tight">
                Bienvenue
            </h2>
            <p class="mt-2 text-sm text-white/80">
                Connectez-vous à votre compte
            </p>
        </div>

        <!-- Login Form -->
        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Field -->
            <div class="rounded-md -space-y-px">
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-white mb-1">
                        Adresse email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="far fa-envelope text-white/60"></i>
                        </div>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                            class="appearance-none rounded-lg relative block w-full px-10 py-3 bg-white/20 border border-white/10 placeholder-white/60 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent focus:z-10 sm:text-sm transition duration-300"
                            placeholder="Entrez votre email"
                        >
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-white mb-1">
                        Mot de passe
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-white/60"></i>
                        </div>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            class="appearance-none rounded-lg relative block w-full px-10 py-3 bg-white/20 border border-white/10 placeholder-white/60 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent focus:z-10 sm:text-sm transition duration-300"
                            placeholder="Entrez votre mot de passe"
                        >
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input
                        id="remember"
                        name="remember"
                        type="checkbox"
                        class="h-4 w-4 text-purple-500 focus:ring-purple-500 border-white/10 rounded cursor-pointer bg-white/20"
                    >
                    <label for="remember" class="ml-2 block text-sm text-white">
                        Se souvenir de moi
                    </label>
                </div>
            </div>

            <!-- Login Button -->
            <div>
                <button
                    type="submit"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transform transition duration-300 hover:scale-[1.02] hover:shadow-lg"
                >
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <i class="fas fa-sign-in-alt text-purple-200 group-hover:text-white transition-colors duration-300"></i>
                    </span>
                    Se connecter
                </button>
            </div>
        </form>

        <!-- Register Link -->
        <div class="text-center mt-4">
            <p class="text-sm text-white/80">
                Vous n'avez pas de compte?
                <a href="{{ route('registerView') }}" class="font-medium text-purple-300 hover:text-white transition duration-300">
                    Inscrivez-vous
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
