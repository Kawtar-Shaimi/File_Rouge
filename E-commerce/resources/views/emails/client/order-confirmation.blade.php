<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body style="font-family: 'Figtree', sans-serif; background-color: #f3e8ff; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table width="700" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); overflow: hidden;">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background-color: #c084fc; padding: 20px 40px; color: white; text-align: center;">
                            <h1 style="margin: 0; font-size: 24px;">{{ config('app.name') }}</h1>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="margin: 0 0 20px 0; color: #4b5563;">Hi {{ $order->client->name }},</h2>
                            <p style="color: #6b7280; font-size: 14px; line-height: 1.6;">
                                🎉 Your order <strong>#{{ $order->order_number }}</strong> has been placed <strong>successfully</strong>! Thank you for shopping with us.
                            </p>
                            <p style="color: #6b7280; font-size: 14px; line-height: 1.6;">
                                Below are your order details and shipping information. You can track the status or view more details using the button below.
                            </p>

                            <div style="margin: 30px 0; text-align: center;">
                                <a href="{{ route('client.order.show', $order) }}" style="background-color: #c084fc; color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; display: inline-block; font-weight: bold;">
                                    View Your Order
                                </a>
                            </div>

                            <!-- Order Details -->
                            <h3 style="margin-bottom: 10px; color: #4b5563;">📦 Order Information</h3>
                            <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                                <tr><td style="padding: 8px; border: 1px solid #e5e7eb;">Order Number</td><td style="padding: 8px; border: 1px solid #e5e7eb;">#{{ $order->order_number }}</td></tr>
                                <tr><td style="padding: 8px; border: 1px solid #e5e7eb;">Order Total</td><td style="padding: 8px; border: 1px solid #e5e7eb;">${{ $order->total_amount }}</td></tr>
                                <tr><td style="padding: 8px; border: 1px solid #e5e7eb;">Status</td><td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $order->status ?? 'pending' }}</td></tr>
                                <tr><td style="padding: 8px; border: 1px solid #e5e7eb;">Payment Status</td><td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $order->payment->status }}</td></tr>
                                <tr><td style="padding: 8px; border: 1px solid #e5e7eb;">Payment Method</td><td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $order->payment_method }}</td></tr>
                                <tr><td style="padding: 8px; border: 1px solid #e5e7eb;">Order Date</td><td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $order->created_at }}</td></tr>
                                <tr><td style="padding: 8px; border: 1px solid #e5e7eb;">Last Update</td><td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $order->updated_at }}</td></tr>
                            </table>

                            <!-- Shipping Details -->
                            <h3 style="margin-bottom: 10px; color: #4b5563;">🚚 Shipping Information</h3>
                            <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                                <tr><td style="padding: 8px; border: 1px solid #e5e7eb;">Name</td><td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $order->client->name }}</td></tr>
                                <tr><td style="padding: 8px; border: 1px solid #e5e7eb;">Email</td><td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $order->shipping_email }}</td></tr>
                                <tr><td style="padding: 8px; border: 1px solid #e5e7eb;">Phone</td><td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $order->shipping_phone }}</td></tr>
                                <tr><td style="padding: 8px; border: 1px solid #e5e7eb;">Address</td><td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $order->shipping_address }}, {{ $order->shipping_postal_code }}, {{ $order->shipping_city }}, {{ $order->shipping_country }}</td></tr>
                            </table>

                            <!-- Books Table -->
                            <h3 style="margin-bottom: 10px; color: #4b5563;">📚 Ordered Books</h3>
                            <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
                                <thead>
                                    <tr style="background-color: #ede9fe;">
                                        <th style="padding: 10px; border: 1px solid #e5e7eb;">Title</th>
                                        <th style="padding: 10px; border: 1px solid #e5e7eb;">Description</th>
                                        <th style="padding: 10px; border: 1px solid #e5e7eb;">Price</th>
                                        <th style="padding: 10px; border: 1px solid #e5e7eb;">Category</th>
                                        <th style="padding: 10px; border: 1px solid #e5e7eb;">Qty</th>
                                        <th style="padding: 10px; border: 1px solid #e5e7eb;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($order->orderBooks->count() > 0)
                                        @foreach ($order->orderBooks as $orderBook)
                                            <tr>
                                                <td style="padding: 8px; border: 1px solid #e5e7eb;">
                                                    <a href="{{ route('books.show', $orderBook->book) }}" style="text-decoration: underline; color: #4f46e5;">
                                                        {{ $orderBook->book->name }}
                                                    </a>
                                                </td>
                                                <td style="padding: 8px; border: 1px solid #e5e7eb;">{{ Str::limit($orderBook->book->description, 20) }}</td>
                                                <td style="padding: 8px; border: 1px solid #e5e7eb;">${{ $orderBook->book->price }}</td>
                                                <td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $orderBook->book->category->name }}</td>
                                                <td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $orderBook->quantity }}</td>
                                                <td style="padding: 8px; border: 1px solid #e5e7eb;">${{ $orderBook->total }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" style="text-align: center; padding: 12px; color: red; font-weight: bold;">No Books In This Order</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f3e8ff; text-align: center; padding: 20px; color: #6b7280; font-size: 12px;">
                            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
