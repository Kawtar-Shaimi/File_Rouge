import { showAlert } from '../../showAlert';

$(document).ready(function () {
    $('#track-btn').click(function () {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        let order_number = $('#order-number').val();
        if (order_number) {
            if ($('#order-number-err').text()) {
                $('#order-number-err').text("")
            }
            const url = "/client/order/status";
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    order_number: order_number,
                    _token: csrfToken
                },
                success: function(response, _, xhr) {
                    if (xhr.status === 200) {

                        $('#order-modal').removeClass('hidden').addClass('flex');
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

                        showAlert("success", `Your order is ${status}`)
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON) {
                        if (xhr.responseJSON.message) {
                            if (xhr.status === 404) {
                                $('#order-number-err').text(xhr.responseJSON.message);
                            }
                            showAlert("error", xhr.responseJSON.message)
                        } else {
                            console.error(xhr.responseJSON.message);
                        }
                    } else {
                        console.error(xhr.responseJSON.message);
                    }
                }
            });
        } else {
            $('#order-number-err').text("Please enter an order number");
            showAlert("error", "Please enter an order number")
        }
    });

    $('#close-modal').click(function () {
        $('#order-modal').addClass('hidden').removeClass('flex');
    });
});
