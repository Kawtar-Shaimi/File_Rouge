@extends('layouts.back-office')

@section('content')

@include('layouts.admin-sidebar')

<div class="container w-5/6 ms-auto p-6">
    <div class="max-w-lg mx-auto">
        <div class="mt-10">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-4 text-center">Update User Role</h2>

                <form action="{{ route('admin.users.update', $user->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Role -->
                    <div class="mb-4">
                        <label for="role" class="block text-lg font-semibold">Role</label>
                        <select name="role" id="role"
                            class="w-full mt-2 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                            <option value="">Select Role</option>
                            <option @if ($user->role == 'admin') selected @endif value="admin">Admin</option>
                            <option @if ($user->role == 'publisher') selected @endif value="publisher">Publisher</option>
                        </select>
                    </div>
                    <p id="roleErr" class="text-red-500 text-sm mt-1"></p>
                    @error('role')
                        <p class="text-red-500 text-sm my-1">{{ $message }}</p>
                    @enderror

                    <!-- Submit -->
                    <button id="update-user" type="submit"
                        class="w-full bg-purple-400 text-white p-3 rounded-lg hover:bg-blue-700 transition">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#role').on('change', function() {
            var role = $(this).val();
            if (role === 'admin' || role === 'publisher') {
                $('#roleErr').text('');
                $('#role').removeClass('border-red-500').addClass('border-green-500');
                $('#update-user').prop('disabled', false);
            } else {
                $('#roleErr').text('Role must be admin or publisher');
                $('#role').removeClass('border-green-500').addClass('border-red-500');
                $('#update-user').prop('disabled', true);
            }
        });
    });
</script>
@endsection
