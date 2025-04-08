@extends('layouts.front-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
@endsection

@section('content')

<div class="container mx-auto p-6">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
        <!-- Formulaire d'adresse -->
        <h3 class="text-xl font-semibold mb-4">Login</h3>
        <form action="{{ route('login') }}" method="POST">
            <div class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                    <input type="email" id="email" name="email" class="w-full p-3 border rounded-md" value="{{ old('email') }}" required>
                </div>
                <p id="emailErr" class="text-red-500 text-sm mt-1"></p>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                    <input type="password" id="password" name="password" class="w-full p-3 border rounded-md" value="{{ old('password') }}" required>
                </div>
                <p id="passwordErr" class="text-red-500 text-sm mt-1"></p>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="mr-2">
                    <label for="remember" class="text-sm text-gray-700">Remember me</label>
                </div>
                
                <button id="login" type="submit" class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg hover:bg-blue-600">
                    Login
                </button>

                <div class="text-center mt-4">
                    <p class="text-sm text-gray-700">Don't have an account? <a href="{{ route('register') }}" class="text-blue-500">Register</a></p>
                </div>

                <div class="text-center mt-4">
                    <p class="text-sm text-gray-700">Forgot your password? <a href="{{ route('reset.forget-password') }}" class="text-blue-500">Reset Password</a></p>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
       $('#email').on('input', function() {
           var email = $(this).val();
           if (email.length < 3) {
               $('#emailErr').text('Email must be at least 3 characters');
               $('#email').removeClass('border-green-500').addClass('border-red-500');
               $('#login').prop('disabled', true);
           } else if (email.length > 150) {
               $('#emailErr').text('Email must be less than 150 characters');
               $('#email').removeClass('border-green-500').addClass('border-red-500');
               $('#login').prop('disabled', true);
           } else if (!/^\S+@\S+\.\S+$/.test(email)) {
               $('#emailErr').text('Invalid email format');
               $('#email').removeClass('border-green-500').addClass('border-red-500');
               $('#login').prop('disabled', true);
           } else {
               $('#emailErr').text('');
               $('#email').removeClass('border-red-500').addClass('border-green-500');
               $('#login').prop('disabled', false);
           }
       });

       $('#password').on('input', function() {
           var password = $(this).val();
           if (password.length < 8) {
               $('#passwordErr').text('Password must be at least 8 characters');
               $('#password').removeClass('border-green-500').addClass('border-red-500');
               $('#login').prop('disabled', true);
           } else if (password.length > 20) {
               $('#passwordErr').text('Password must be less than 20 characters');
               $('#password').removeClass('border-green-500').addClass('border-red-500');
               $('#login').prop('disabled', true);
           } else {
               $('#passwordErr').text('');
               $('#password').removeClass('border-red-500').addClass('border-green-500');
               $('#login').prop('disabled', false);
           }
       });
   })
</script>

@endsection
