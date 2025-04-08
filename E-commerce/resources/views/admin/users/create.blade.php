@extends('layouts.back-office')

@section('content')

@include('layouts.admin-sidebar')

<div class="container w-5/6 ms-auto p-6">
    <div class="max-w-lg mx-auto">
        <div class="mt-10">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-4 text-center">Create New User</h2>

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-lg font-semibold">Name</label>
                        <input type="text" id="name" name="name" required value="{{ old('name') }}"
                            class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300" >
                    </div>
                    <p id="nameErr" class="text-red-500 text-sm mt-1"></p>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-lg font-semibold">Email</label>
                        <input type="email" id="email" name="email" required value="{{ old('email') }}"
                            class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>
                    <p id="emailErr" class="text-red-500 text-sm mt-1"></p>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Phone -->
                    <div class="mb-4">
                        <label for="phone" class="block text-lg font-semibold">Phone</label>
                        <input type="text" id="phone" name="phone" required value="{{ old('phone') }}"
                            class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>
                    <p id="phoneErr" class="text-red-500 text-sm mt-1"></p>
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Role -->
                    <div class="mb-4">
                        <label for="role" class="block text-lg font-semibold">Role</label>
                        <select name="role" id="role"
                            class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="publisher">Publisher</option>
                        </select>
                    </div>
                    <p id="roleErr" class="text-red-500 text-sm mt-1"></p>
                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-lg font-semibold">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>
                    <p id="passwordErr" class="text-red-500 text-sm mt-1"></p>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-lg font-semibold">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>
                    <p id="password_confirmationErr" class="text-red-500 text-sm mt-1"></p>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Submit -->
                    <button id="create-user" type="submit"
                        class="w-full bg-purple-400 text-white p-3 rounded-lg hover:bg-blue-700 transition">Create User</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#name').on('input', function() {
            var name = $(this).val();
            if (name.length < 3) {
                $('#nameErr').text('Name must be at least 3 characters');
                $('#name').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else if (name.length > 100) {
                $('#nameErr').text('Name must be less than 100 characters');
                $('#name').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else if (!/^[a-zA-Z\s]+$/.test(name)) {
                $('#nameErr').text('Name must only contain letters and spaces');
                $('#name').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else if (name.trim() === '') {
                $('#nameErr').text('Name cannot be empty');
                $('#name').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else {
                $('#nameErr').text('');
                $('#name').removeClass('border-red-500').addClass('border-green-500');
                $('#create-user').prop('disabled', false);
            }
        });

        $('#email').on('input', function() {
            var email = $(this).val();
            if (email.length < 3) {
                $('#emailErr').text('Email must be at least 3 characters');
                $('#email').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else if (email.length > 150) {
                $('#emailErr').text('Email must be less than 150 characters');
                $('#email').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                $('#emailErr').text('Invalid email format');
                $('#email').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else if (email.trim() === '') {
                $('#emailErr').text('Email cannot be empty');
                $('#email').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else {
                $('#emailErr').text('');
                $('#email').removeClass('border-red-500').addClass('border-green-500');
                $('#create-user').prop('disabled', false);
            }
        });

        $('#phone').on('input', function() {
            var phone = $(this).val();
            if (phone.length < 3) {
                $('#phoneErr').text('Phone must be at least 3 characters');
                $('#phone').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else if (phone.length > 20) {
                $('#phoneErr').text('Phone must be less than 20 characters');
                $('#phone').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else if (phone.trim() === '') {
                $('#phoneErr').text('Phone cannot be empty');
                $('#phone').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else {
                $('#phoneErr').text('');
                $('#phone').removeClass('border-red-500').addClass('border-green-500');
                $('#create-user').prop('disabled', false);
            }    
        });

        $('#password').on('input', function() {
            var password = $(this).val();
            if (password.length < 8) {
                $('#passwordErr').text('Password must be at least 8 characters');
                $('#password').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else if (password.length > 20) {
                $('#passwordErr').text('Password must be less than 20 characters');
                $('#password').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/.test(password)) {
                $('#passwordErr').text('Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character');
                $('#password').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            }else if (password.trim() === '') {
                $('#passwordErr').text('Password cannot be empty');
                $('#password').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            }
            else {
                $('#passwordErr').text('');
                $('#password').removeClass('border-red-500').addClass('border-green-500');
                $('#create-user').prop('disabled', false);
            }
        });

        $('#password_confirmation').on('input', function() {
            var password = $('#password').val();
            var confirmPassword = $(this).val();
            if (confirmPassword.length < 8) {
                $('#password_confirmationErr').text('Password confirmation must be at least 8 characters');
                $('#password_confirmation').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else if (confirmPassword.length > 20) {
                $('#password_confirmationErr').text('Password confirmation must be less than 20 characters');
                $('#password_confirmation').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/.test(confirmPassword)) {
                $('#password_confirmationErr').text('Password confirmation must contain at least one lowercase letter, one uppercase letter, one number, and one special character');
                $('#password_confirmation').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else if (confirmPassword.trim() === '') {
                $('#password_confirmationErr').text('Password confirmation cannot be empty');
                $('#password_confirmation').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else if (password !== confirmPassword) {
                $('#password_confirmationErr').text('Passwords do not match');
                $('#password_confirmation').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            } else {
                $('#password_confirmationErr').text('');
                $('#password_confirmation').removeClass('border-red-500').addClass('border-green-500');
                $('#create-user').prop('disabled', false);
            }
        });

        $('#role').on('change', function() {
            var role = $(this).val();
            if (role === 'admin' || role === 'publisher') {
                $('#roleErr').text('');
                $('#role').removeClass('border-red-500').addClass('border-green-500');
                $('#create-user').prop('disabled', false);
            } else {
                $('#roleErr').text('Role must be admin or publisher');
                $('#role').removeClass('border-green-500').addClass('border-red-500');
                $('#create-user').prop('disabled', true);
            }
        });
    })
</script>
@endsection
