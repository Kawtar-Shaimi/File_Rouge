<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Status Updated</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f3f4f6; padding: 40px;">
    <div
        style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 12px; padding: 40px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h1 style="text-align: center; color: #1f2937; font-size: 28px; font-weight: bold;">📦 Order Status Updated</h1>
        <p style="text-align: center; font-size: 16px; color: #4b5563; margin-bottom: 30px;">
            Hello {{ $order->client->name }},<br>
            The status of your order <strong>#{{ $order->order_number }}</strong> has been updated.
        </p>

        <div style="margin: 30px 0;">
                @php
                    $statusText = ucfirst($order->status);
                    $statusColors = [
                        'pending' => 'color: yellow;',
                        'in shipping' => 'color: blue;',
                        'completed' => 'color: green;',
                        'cancelled' => 'color: red;',
                    ];
                    $progressArr = ["pending" => 25, "in shipping" => 50, "completed" => 75, "cancelled" => 0];
                    $progress = $progressArr[$order->status] ?? 0;
                    $color = $statusColors[$order->status] ?? 'color: gray;';
                @endphp
            <h2 style="text-align: center; color: #1f2937; font-size: 28px; font-weight: bold;">Order Status: <span style="{{ $color }} font-size: 28px; font-weight: bold;">{{ $statusText }}</span></h2>
            <div style="margin-top: 24px; position: relative;">
                <div style="width: 100%; background-color: #e5e7eb; height: 8px; border-radius: 8px; margin-top: 8px; position: relative;">
                    <div id="progress-bar" style="position: absolute; top: 0; left: 0; background-color: #6366f1; height: 8px; border-radius: 8px; transition: all 0.5s; width: {{ $progress }}%;"></div>
                </div>
            </div>
        </div>

        <div style="margin: 30px 0; text-align: center;">
            <a href="{{ route('client.order.show', $order->uuid) }}"
                style="background-color: #c084fc; color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; display: inline-block; font-weight: bold;">
                View Your Order
            </a>
        </div>

        <p style="margin-top: 40px; font-size: 14px; color: #6b7280; text-align: center;">
            Thank you for shopping with us.<br>We will keep you updated on the progress of your order.
        </p>

        <footer style="text-align: center; margin-top: 40px; font-size: 12px; color: #6b7280;">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </footer>
    </div>
</body>

</html>
