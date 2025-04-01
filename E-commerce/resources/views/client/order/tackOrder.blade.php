@extends('layouts.front-office')

@section('head')
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/trackOrderScript.js'
    ])
@endsection

@section('content')

<div class="w-full min-h-screen flex items-center justify-center">
    <div class="max-w-xl w-full bg-white p-8 rounded-xl shadow-xl text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Track Your Order</h2>
        <input type="text" id="order-number" placeholder="Enter Order Number" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <p id="order-number-err" class="text-red-500 mt-5"></p>
        <button id="track-btn" class="mt-4 px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-800 transition-all duration-300">
            Track Order
        </button>
    </div>
</div>

<!-- Modal -->
<div id="order-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="w-2/4 bg-white px-14 py-16 rounded-lg shadow-lg text-center">
        <h3 class="text-2xl font-semibold text-gray-800">Order Status</h3>
        <div class="mt-6 relative">
            <div class="flex justify-between items-center w-full text-sm font-semibold text-gray-600">
                <span>Pending</span>
                <span>In Shipping</span>
                <span>Completed</span>
                <span>Cancelled</span>
            </div>
            <div class="w-full bg-gray-200 h-2 rounded-full mt-2 relative">
                <div id="progress-bar" class="absolute top-0 left-0 bg-indigo-500 h-2 rounded-full transition-all duration-500" style="width: 0%;">
                    <p id="progress-bar-status" class="absolute -right-11 mt-5 text-right text-md font-bold"></p>
                </div>
                <div class="absolute inset-0 flex justify-between items-center">
                    <span class="w-5 h-5 bg-gray-400 rounded-full border-2 border-white"></span>
                    <span class="w-5 h-5 bg-gray-400 rounded-full border-2 border-white"></span>
                    <span class="w-5 h-5 bg-gray-400 rounded-full border-2 border-white"></span>
                    <span class="w-5 h-5 bg-gray-400 rounded-full border-2 border-white"></span>
                </div>
            </div>
        </div>
        <button id="close-modal" class="mt-10 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-700 transition">Close</button>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#track-btn').click(function () {
            let order_number = $('#order-number').val();
            if (order_number) {
                if ($('#order-number-err').text()) {
                    $('#order-number-err').text("")
                }
                const url = "{{ route('client.order.status') }}";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        order_number: order_number,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response, _, xhr) {
                        if (xhr.status === 200) {

                            $('#order-modal').removeClass('hidden');
                            let status = response.data.status;

                            const statusMap = {
                                "pending": { progress: "0%", index: 0, color: "yellow" },
                                "in shipping": { progress: "33%", index: 1, color: "blue" },
                                "completed": { progress: "66%", index: 2, color: "green" },
                                "cancelled": { progress: "100%", index: 3, color: "red" }
                            };

                            let { progress, index: statusIndex, color } = statusMap[status] || { progress: "0%", index: 0, color: "yellow" };


                            $('#progress-bar').css('width', progress);
                            $('#progress-bar-status').text(status.charAt(0).toUpperCase() + status.slice(1));
                            $('#progress-bar-status').css('color', color);

                            // Update status indicators
                            $('#order-modal span.w-5').each(function (index) {
                                $(this).removeClass('bg-indigo-500').addClass('bg-gray-400');
                                if (index <= statusIndex) {
                                    $(this).removeClass('bg-gray-400').addClass('bg-indigo-500');
                                }
                            });
                        }
                    },
                    error: function(xhr, _, error) {
                        if (xhr.status === 404) {
                            if (xhr.responseJSON.message) {
                                $('#order-number-err').text(xhr.responseJSON.message)
                            }
                        } else {
                            console.error(error);
                        }
                    }
                });
            } else {
                $('#order-number-err').text("Please enter an order number")
            }
        });

        $('#close-modal').click(function () {
            $('#order-modal').addClass('hidden');
        });
    });
</script>

@endsection
