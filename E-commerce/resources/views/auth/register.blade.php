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
            <h3 class="text-xl font-semibold mb-4">Register</h3>
            <form action="{{ route('register') }}" method="POST">
                <div class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                        <input type="text" id="name" name="name" class="w-full p-3 border rounded-md" value="{{ old('name') }}" required>
                    </div>
                    <p id="nameErr" class="text-red-500 text-sm mt-1"></p>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                        <input type="email" id="email" name="email" class="w-full p-3 border rounded-md" value="{{ old('email') }}" required>
                    </div>
                    <p id="emailErr" class="text-red-500 text-sm mt-1"></p>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone:</label>
                        <input type="text" id="phone" name="phone" class="w-full p-3 border rounded-md" value="{{ old('phone') }}" required>
                    </div>
                    <p id="phoneErr" class="text-red-500 text-sm mt-1"></p>
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Role:</label>
                        <select id="role" name="role" class="w-full p-3 border rounded-md" required>
                            <option value="">Select Role</option>
                            <option value="client">Client</option>
                            <option value="publisher">Publisher</option>
                        </select>
                    </div>
                    <p id="roleErr" class="text-red-500 text-sm mt-1"></p>
                    @error('role')
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

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-3 border rounded-md" required>
                    </div>
                    <p id="password_confirmationErr" class="text-red-500 text-sm mt-1"></p>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="mr-2">
                        <label for="remember" class="text-sm text-gray-700">Remember me</label>
                    </div>

                    <button id="register" type="submit" class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg hover:bg-blue-600">
                        Register
                    </button>

                    <div class="text-center mt-4">
                        <span class="text-gray-700">Already have an account? </span>
                        <a href="{{ route('loginView') }}" class="text-blue-600 hover:underline">Login</a>
                    </div>

                </div>
            </form>
        </div>
    </div>

<script>
    $(document).ready(function() {
       $('#name').on('input', function() {
           var name = $(this).val();
           if (name.length < 3) {
               $('#nameErr').text('Name must be at least 3 characters');
               $('#name').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else if (name.length > 60) {
               $('#nameErr').text('Name must be less than 60 characters');
               $('#name').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else if (!/^[a-zA-Z\s]+$/.test(name)) {
               $('#nameErr').text('Name must only contain letters and spaces');
               $('#name').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else if (name.trim() === '') {
               $('#nameErr').text('Name cannot be empty');
               $('#name').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else {
               $('#nameErr').text('');
               $('#name').removeClass('border-red-500').addClass('border-green-500');
               $('#register').prop('disabled', false);
           }
       });

       $('#email').on('input', function() {
           var email = $(this).val();
           if (email.length < 5) {
               $('#emailErr').text('Email must be at least 5 characters');
               $('#email').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else if (email.length > 150) {
               $('#emailErr').text('Email must be less than 150 characters');
               $('#email').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else if (!/^\S+@\S+\.\S+$/.test(email)) {
               $('#emailErr').text('Invalid email format');
               $('#email').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else if (email.trim() === '') {
               $('#emailErr').text('Email cannot be empty');
               $('#email').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           }else {
               $('#emailErr').text('');
               $('#email').removeClass('border-red-500').addClass('border-green-500');
               $('#register').prop('disabled', false);
           }
       });

       $('#phone').on('input', function() {
           var phone = $(this).val();
           if (phone.length < 5) {
               $('#phoneErr').text('Phone must be at least 5 characters');
               $('#phone').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else if (phone.length > 20) {
               $('#phoneErr').text('Phone must be less than 20 characters');
               $('#phone').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else if (phone.trim() === '') {
               $('#phoneErr').text('Phone cannot be empty');
               $('#phone').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else {
               $('#phoneErr').text('');
               $('#phone').removeClass('border-red-500').addClass('border-green-500');
               $('#register').prop('disabled', false);
           }
       });

       $('#role').on('change', function() {
           var role = $(this).val();
           if (role === 'client' || role === 'publisher') {
               $('#roleErr').text('');
               $('#role').removeClass('border-red-500').addClass('border-green-500');
               $('#register').prop('disabled', false);
           }else {
               $('#roleErr').text('Role must be client or publisher');
               $('#role').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           }
       });

       $('#password').on('input', function() {
           var password = $(this).val();
           if (password.length < 8) {
               $('#passwordErr').text('Password must be at least 8 characters');
               $('#password').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else if (password.length > 20) {
               $('#passwordErr').text('Password must be less than 20 characters');
               $('#password').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else if (password.trim() === '') {
               $('#passwordErr').text('Password cannot be empty');
               $('#password').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])/.test(password)) {
               $('#passwordErr').text('Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character');
               $('#password').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           }else {
               $('#passwordErr').text('');
               $('#password').removeClass('border-red-500').addClass('border-green-500');
               $('#register').prop('disabled', false);
           }
       });

       $('#confirm-password').on('input', function() {
           var password = $('#password').val();
           var confirmPassword = $(this).val();
           if (password.length < 8) {
               $('#confirm-passwordErr').text('Password must be at least 8 characters');
               $('#confirm-password').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else if (password.length > 20) {
               $('#confirm-passwordErr').text('Password must be less than 20 characters');
               $('#confirm-password').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else if (password.trim() === '') {
               $('#confirm-passwordErr').text('Password cannot be empty');
               $('#confirm-password').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])/.test(password)) {
               $('#confirm-passwordErr').text('Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character');
               $('#confirm-password').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else if (password !== confirmPassword) {
               $('#confirm-passwordErr').text('Passwords do not match');
               $('#confirm-password').removeClass('border-green-500').addClass('border-red-500');
               $('#register').prop('disabled', true);
           } else {
               $('#confirm-passwordErr').text('');
               $('#confirm-password').removeClass('border-red-500').addClass('border-green-500');
               $('#register').prop('disabled', false);
           }
       });
   })
</script>
@endsection
