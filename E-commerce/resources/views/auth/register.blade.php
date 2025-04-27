@extends('layouts.front-office')

@section('title', 'Register')

@section('head')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/auth/registerInputValidation.js'])
@endsection

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-teal-50 to-green-100 py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
        <div class="max-w-2xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all border border-green-100">
            <div class="bg-gradient-to-r from-teal-400 to-green-500 py-8 px-8 relative">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-20 h-20 rounded-full bg-green-200 opacity-20 blur-xl"></div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-16 h-16 rounded-full bg-teal-200 opacity-20 blur-xl"></div>
                <h2 class="text-2xl font-extrabold text-white text-center">Create Account</h2>
                <p class="text-white text-center mt-2 text-sm">Join our community today</p>
            </div>
            
            <div class="p-8 space-y-6 bg-gradient-to-b from-white to-green-50">
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-500 group-hover:text-gray-600 transition-colors"></i>
                                </div>
                                <input type="text" id="name" name="name" 
                                    class="w-full pl-10 pr-3 py-3 border-2 border-green-100 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-transparent bg-white shadow-sm hover:shadow transition-all"
                                    value="{{ old('name') }}" required placeholder="John Doe">
                            </div>
                            <p id="nameErr" class="text-red-500 text-sm mt-1"></p>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-500 group-hover:text-gray-600 transition-colors"></i>
                                </div>
                                <input type="email" id="email" name="email" 
                                    class="w-full pl-10 pr-3 py-3 border-2 border-green-100 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-transparent bg-white shadow-sm hover:shadow transition-all"
                                    value="{{ old('email') }}" required placeholder="your@email.com">
                            </div>
                            <p id="emailErr" class="text-red-500 text-sm mt-1"></p>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone text-gray-500 group-hover:text-gray-600 transition-colors"></i>
                                </div>
                                <input type="text" id="phone" name="phone" 
                                    class="w-full pl-10 pr-3 py-3 border-2 border-green-100 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-transparent bg-white shadow-sm hover:shadow transition-all"
                                    value="{{ old('phone') }}" required placeholder="+1 234 567 890">
                            </div>
                            <p id="phoneErr" class="text-red-500 text-sm mt-1"></p>
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user-tag text-gray-500 group-hover:text-gray-600 transition-colors"></i>
                                </div>
                                <select id="role" name="role" 
                                    class="w-full pl-10 pr-3 py-3 border-2 border-green-100 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-transparent bg-white shadow-sm hover:shadow transition-all appearance-none" 
                                    required>
                                    <option value="">Select Role</option>
                                    <option value="client">Client</option>
                                    <option value="publisher">Publisher</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-500 group-hover:text-gray-600 transition-colors"></i>
                                </div>
                            </div>
                            <p id="roleErr" class="text-red-500 text-sm mt-1"></p>
                            @error('role')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-500 group-hover:text-gray-600 transition-colors"></i>
                                </div>
                                <input type="password" id="password" name="password" 
                                    class="w-full pl-10 pr-10 py-3 border-2 border-green-100 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-transparent bg-white shadow-sm hover:shadow transition-all"
                                    required placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i class="fa-solid fa-eye text-gray-500 hover:text-gray-700 cursor-pointer" id="togglePassword"></i>
                                </div>
                            </div>
                            <p id="passwordErr" class="text-red-500 text-sm mt-1"></p>
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-500 group-hover:text-gray-600 transition-colors"></i>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation" 
                                    class="w-full pl-10 pr-10 py-3 border-2 border-green-100 rounded-xl focus:ring-2 focus:ring-teal-400 focus:border-transparent bg-white shadow-sm hover:shadow transition-all"
                                    required placeholder="••••••••">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i class="fa-solid fa-eye text-gray-500 hover:text-gray-700 cursor-pointer" id="toggleConfirmPassword"></i>
                                </div>
                            </div>
                            <p id="password_confirmationErr" class="text-red-500 text-sm mt-1"></p>
                            @error('password_confirmation')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex items-center">
                        <input type="checkbox" id="remember" name="remember" 
                            class="h-4 w-4 text-teal-500 focus:ring-teal-400 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>

                    <button id="register" type="submit"
                        class="w-full mt-6 py-4 px-4 bg-gradient-to-r from-green-400 to-teal-500 hover:from-green-500 hover:to-teal-600 text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 border border-green-300">
                        <i class="fas fa-user-plus mr-2"></i> Register
                    </button>

                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-600">
                            Already have an account? 
                            <a href="{{ route('loginView') }}" class="font-medium text-teal-500 hover:text-teal-600 underline-offset-2 hover:underline">
                                Login
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
