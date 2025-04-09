<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Canceled Notification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f3f4f6; padding: 40px;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 12px; padding: 40px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h1 style="text-align: center; color: #1f2937; font-size: 28px; font-weight: bold;">❌ Order Canceled</h1>
        <p style="text-align: center; font-size: 16px; color: #4b5563; margin-bottom: 30px;">
            Hello {{ $user->name }}<br>
            Order <strong>#{{ $order->order_number }}</strong> placed by <strong>{{ $order->client->name }}</strong> has been <span style="color: red; font-weight: bold;">canceled</span>.
        </p>

        <p style="text-align: center; font-size: 16px; color: #4b5563; margin-bottom: 30px;">
            Cancellation reason: {{ $reason }}
        </p>

        <div style="text-align: center; margin-top: 40px;">
            <a href="{{ route('admin.orders.show', $order->uuid) }}" style="background-color: #4f46e5; color: white; padding: 12px 30px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 16px;">
                View Order in Dashboard
            </a>
        </div>

        <p style="margin-top: 40px; font-size: 14px; color: #6b7280; text-align: center;">
            This notification was sent to inform you about the cancellation.<br>
            Please take any necessary action if required.
        </p>
    </div>
</body>
</html>
