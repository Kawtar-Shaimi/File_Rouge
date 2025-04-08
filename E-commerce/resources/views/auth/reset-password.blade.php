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
            <h3 class="text-xl font-semibold mb-4">Reset Password</h3>
            <form action="{{ route('reset.reset-password', $user->uuid) }}" method="POST">
                <div class="space-y-4">
                    @csrf

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                        <input type="password" id="password" name="password" class="w-full p-3 border rounded-md"
                            value="{{ old('password') }}" required>
                    </div>
                    <p id="passwordErr" class="text-red-500 text-sm mt-1"></p>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-3 border rounded-md"
                            required>
                    </div>
                    <p id="password_confirmationErr" class="text-red-500 text-sm mt-1"></p>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <button id="reset-password" type="submit"
                        class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg hover:bg-blue-600">
                        Reset Password
                    </button>

                </div>
            </form>
        </div>
    </div>

<script>
    $(document).ready(function() {
       $('#password').on('input', function() {
           var password = $(this).val();
           if (password.length < 8) {
               $('#passwordErr').text('Password must be at least 8 characters');
               $('#password').removeClass('border-green-500').addClass('border-red-500');
               $('#reset-password').prop('disabled', true);
           } else if (password.length > 20) {
               $('#passwordErr').text('Password must be less than 20 characters');
               $('#password').removeClass('border-green-500').addClass('border-red-500');
               $('#reset-password').prop('disabled', true);
           } else if (password.trim() === '') {
               $('#passwordErr').text('Password cannot be empty');
               $('#password').removeClass('border-green-500').addClass('border-red-500');
               $('#reset-password').prop('disabled', true);
           } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])/.test(password)) {
               $('#passwordErr').text('Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character');
               $('#password').removeClass('border-green-500').addClass('border-red-500');
               $('#reset-password').prop('disabled', true);
           } else {
               $('#passwordErr').text('');
               $('#password').removeClass('border-red-500').addClass('border-green-500');
               $('#reset-password').prop('disabled', false);
           }
       });

       $('#password_confirmation').on('input', function() {
           var password = $('#password').val();
           var confirmPassword = $(this).val();
           if (password.length < 8) {
               $('#password_confirmationErr').text('Password must be at least 8 characters');
               $('#password_confirmation').removeClass('border-green-500').addClass('border-red-500');
               $('#reset-password').prop('disabled', true);
           } else if (password.length > 20) {
               $('#password_confirmationErr').text('Password must be less than 20 characters');
               $('#password_confirmation').removeClass('border-green-500').addClass('border-red-500');
               $('#reset-password').prop('disabled', true);
           } else if (password.trim() === '') {
               $('#password_confirmationErr').text('Password cannot be empty');
               $('#password_confirmation').removeClass('border-green-500').addClass('border-red-500');
               $('#reset-password').prop('disabled', true);
           } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])/.test(password)) {
               $('#password_confirmationErr').text('Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character');
               $('#password_confirmation').removeClass('border-green-500').addClass('border-red-500');
               $('#reset-password').prop('disabled', true);
           } else if (password !== confirmPassword) {
               $('#password_confirmationErr').text('Passwords do not match');
               $('#password_confirmation').removeClass('border-green-500').addClass('border-red-500');
               $('#reset-password').prop('disabled', true);
           } else {
               $('#password_confirmationErr').text('');
               $('#password_confirmation').removeClass('border-red-500').addClass('border-green-500');
               $('#reset-password').prop('disabled', false);
           }
       });
   });
</script>
@endsection
