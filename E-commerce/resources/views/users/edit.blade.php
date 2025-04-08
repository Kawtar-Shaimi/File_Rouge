@extends('layouts.front-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
@endsection

@section('content')

<div class="container mx-auto p-8">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-xl space-y-6">
        <h2 class="text-2xl font-bold mb-4 text-center">Update Profile</h2>
        <form action="{{ route('users.update', $user->uuid) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-lg font-semibold">Name</label>
                <input type="text" id="name" name="name" required value="{{ old('name', $user->name ) }}"
                    class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300" >
            </div>
            <p id="nameErr" class="text-red-500 text-sm mt-1"></p>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-lg font-semibold">Email</label>
                <input type="email" id="email" name="email" required value="{{ old('email', $user->email) }}"
                    class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300">
            </div>
            <p id="emailErr" class="text-red-500 text-sm mt-1"></p>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <!-- Phone -->
            <div class="mb-4">
                <label for="phone" class="block text-lg font-semibold">Phone</label>
                <input type="text" id="phone" name="phone" required value="{{ old('phone', $user->phone) }}"
                    class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300">
            </div>
            <p id="phoneErr" class="text-red-500 text-sm mt-1"></p>
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <!-- Bouton de soumission -->
            <button id="update-user" type="submit"
                class="w-full bg-purple-400 text-white p-3 rounded-lg hover:bg-blue-700 transition">Update</button>
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
                $('#update-user').prop('disabled', true);
            } else if (name.length > 60) {
                $('#nameErr').text('Name must be less than 60 characters');
                $('#name').removeClass('border-green-500').addClass('border-red-500');
                $('#update-user').prop('disabled', true);
            } else if (!/^[a-zA-Z\s]+$/.test(name)) {
                $('#nameErr').text('Name must only contain letters and spaces');
                $('#name').removeClass('border-green-500').addClass('border-red-500');
                $('#update-user').prop('disabled', true);
            } else if (name.trim() === '') {
                $('#nameErr').text('Name cannot be empty');
                $('#name').removeClass('border-green-500').addClass('border-red-500');
                $('#update-user').prop('disabled', true);
            } else {
                $('#nameErr').text('');
                $('#name').removeClass('border-red-500').addClass('border-green-500');
                $('#update-user').prop('disabled', false);
            }
        });

        $('#email').on('input', function() {
            var email = $(this).val();
            if (email.length < 3) {
                $('#emailErr').text('Email must be at least 3 characters');
                $('#email').removeClass('border-green-500').addClass('border-red-500');
                $('#update-user').prop('disabled', true);
            } else if (email.length > 150) {
                $('#emailErr').text('Email must be less than 150 characters');
                $('#email').removeClass('border-green-500').addClass('border-red-500');
                $('#update-user').prop('disabled', true);
            } else if (!/^\S+@\S+\.\S+$/.test(email)) {
                $('#emailErr').text('Email must be a valid email address');
                $('#email').removeClass('border-green-500').addClass('border-red-500');
                $('#update-user').prop('disabled', true);
            } else {
                $('#emailErr').text('');
                $('#email').removeClass('border-red-500').addClass('border-green-500');
                $('#update-user').prop('disabled', false);
            }
        });

        $('#phone').on('input', function() {
            var phone = $(this).val();
            if (phone.length < 6) {
                $('#phoneErr').text('Phone must be at least 6 characters');
                $('#phone').removeClass('border-green-500').addClass('border-red-500');
                $('#update-user').prop('disabled', true);
            } else if (phone.length > 20) {
                $('#phoneErr').text('Phone must be less than 20 characters');
                $('#phone').removeClass('border-green-500').addClass('border-red-500');
                $('#update-user').prop('disabled', true);
            } else {
                $('#phoneErr').text('');
                $('#phone').removeClass('border-red-500').addClass('border-green-500');
                $('#update-user').prop('disabled', false);
            }
        });
   })
</script>

@endsection
