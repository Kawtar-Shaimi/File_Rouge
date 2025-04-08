@extends('layouts.back-office')

@section('content')

@include('layouts.admin-sidebar')

<div class="container w-5/6 ms-auto p-6">
    <div class="max-w-lg mx-auto">
        <div class="mt-10">
            <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Change Payment Status</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">

                <form action="{{ route('admin.payments.update', $payment->uuid) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status" class="w-full p-3 border rounded-lg mt-1" required>
                            <option value="">Select Status</option>
                            <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $payment->status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                    <p id="status-error" class="text-red-500 text-xs mt-1"></p>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Submit Button -->
                    <button id="update-status" type="submit"
                        class="w-full bg-purple-400 text-white p-3 rounded-lg hover:bg-blue-700 transition">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#status').on('change', function () {
            var selectedStatus = $(this).val();
            if (selectedStatus === 'in shipping' || selectedStatus === 'completed' || selectedStatus === 'cancelled') {
                $('#status-error').text('Cannot change status to "In Shipping", "Completed", or "Cancelled".');
                $('#status').removeClass('border-green-500').addClass('border-red-500');
                $('#update-status').prop('disabled', true);
            } else {
                $('#status-error').text('');
                $('#status').removeClass('border-red-500').addClass('border-green-500');
                $('#update-status').prop('disabled', false);
            }
        });
    })
</script>
@endsection
