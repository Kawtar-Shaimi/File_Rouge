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
            <h3 class="text-xl font-semibold mb-4">Change Password</h3>
            <form action="{{ route('users.change-password.update', $user->uuid) }}" method="POST">
                <div class="space-y-4">
                    @csrf

                    <div>
                        <label for="old_password" class="block text-sm font-medium text-gray-700">Old Password:</label>
                        <input type="password" id="old_password" name="old_password" class="w-full p-3 border rounded-md"
                            value="{{ old('old_password') }}" required>
                    </div>
                    <p id="old_passwordErr" class="text-red-500 text-xs mt-1"></p>
                    @error('old_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700">New Password:</label>
                        <input type="password" id="new_password" name="new_password" class="w-full p-3 border rounded-md"
                            value="{{ old('new_password') }}" required>
                    </div>
                    <p id="new_passwordErr" class="text-red-500 text-xs mt-1"></p>
                    @error('new_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password:</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                            class="w-full p-3 border rounded-md" required>
                    </div>
                    <p id="new_password_confirmationErr" class="text-red-500 text-xs mt-1"></p>
                    @error('new_password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <button id="change-password" type="submit"
                        class="w-full bg-purple-400 text-white font-bold py-3 rounded-lg hover:bg-blue-600">
                        Change Password
                    </button>

                </div>
            </form>
        </div>
    </div>

<script>
    $(document).ready(function() {
       $('#old_password').on('input', function() {
           var password = $(this).val();
           if (password.length < 8) {
               $('#old_passwordErr').text('Password must be at least 8 characters');
               $('#old_password').removeClass('border-green-500').addClass('border-red-500');
               $('#change-password').prop('disabled', true);
           } else if (password.length > 20) {
               $('#old_passwordErr').text('Password must be less than 20 characters');
               $('#old_password').removeClass('border-green-500').addClass('border-red-500');
               $('#change-password').prop('disabled', true);
           } else if (password.trim() === '') {
               $('#old_passwordErr').text('Password cannot be empty');
               $('#old_password').removeClass('border-green-500').addClass('border-red-500');
               $('#change-password').prop('disabled', true);
           } else {
               $('#old_passwordErr').text('');
               $('#old_password').removeClass('border-red-500').addClass('border-green-500');
               $('#change-password').prop('disabled', false);
           }
       });

       $('#new_password').on('input', function() {
           var password = $(this).val();
           if (password.length < 8) {
               $('#new_passwordErr').text('Password must be at least 8 characters');
               $('#new_password').removeClass('border-green-500').addClass('border-red-500');
               $('#change-password').prop('disabled', true);
           } else if (password.length > 20) {
               $('#new_passwordErr').text('Password must be less than 20 characters');
               $('#new_password').removeClass('border-green-500').addClass('border-red-500');
               $('#change-password').prop('disabled', true);
           } else if (password.trim() === '') {
               $('#new_passwordErr').text('Password cannot be empty');
               $('#new_password').removeClass('border-green-500').addClass('border-red-500');
               $('#change-password').prop('disabled', true);
           } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])/.test(password)) {
               $('#new_passwordErr').text('Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character');
               $('#new_password').removeClass('border-green-500').addClass('border-red-500');
               $('#change-password').prop('disabled', true);
           } else {
               $('#new_passwordErr').text('');
               $('#new_password').removeClass('border-red-500').addClass('border-green-500');
               $('#change-password').prop('disabled', false);
           }
       });

       $('#new_password_confirmation').on('input', function() {
           var password = $('#new_password').val();
           var confirmPassword = $(this).val();
           if (confirmPassword.length < 8) {
               $('#new_password_confirmationErr').text('Password must be at least 8 characters');
               $('#new_password_confirmation').removeClass('border-green-500').addClass('border-red-500');
               $('#change-password').prop('disabled', true);
           } else if (confirmPassword.length > 20) {
               $('#new_password_confirmationErr').text('Password must be less than 20 characters');
               $('#new_password_confirmation').removeClass('border-green-500').addClass('border-red-500');
               $('#change-password').prop('disabled', true);
           } else if (confirmPassword.trim() === '') {
               $('#new_password_confirmationErr').text('Password cannot be empty');
               $('#new_password_confirmation').removeClass('border-green-500').addClass('border-red-500');
               $('#change-password').prop('disabled', true);
           } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])/.test(confirmPassword)) {
               $('#new_password_confirmationErr').text('Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character');
               $('#new_password_confirmation').removeClass('border-green-500').addClass('border-red-500');
               $('#change-password').prop('disabled', true);
           } else if (password !== confirmPassword) {
               $('#new_password_confirmationErr').text('Passwords do not match');
               $('#new_password_confirmation').removeClass('border-green-500').addClass('border-red-500');
               $('#change-password').prop('disabled', true);
           } else {
               $('#new_password_confirmationErr').text('');
               $('#new_password_confirmation').removeClass('border-red-500').addClass('border-green-500');
               $('#change-password').prop('disabled', false);
           }
       });
   })
</script>
@endsection
