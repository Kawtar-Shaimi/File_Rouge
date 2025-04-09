<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Book Order</title>
</head>

<body style="font-family: 'Figtree', sans-serif; background-color: #f3e8ff; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table width="600" cellpadding="0" cellspacing="0"
                       style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); overflow: hidden;">
                    <tr>
                        <td style="background-color: #c084fc; padding: 20px 40px; color: white; text-align: center;">
                            <h1 style="margin: 0; font-size: 24px;">{{ config('app.name') }}</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="margin: 0 0 20px 0; color: #4b5563;">Hi {{ $user->name }},</h2>
                            <p style="color: #6b7280; font-size: 14px; line-height: 1.6;">
                                Great news! Your book <strong>"{{ $order->book->name }}"</strong> has been ordered.
                            </p>
                            <p style="color: #6b7280; font-size: 14px; line-height: 1.6;">
                                Below is the summary of the order.
                            </p>

                            <table style="width: 100%; margin: 20px 0; border-collapse: collapse; font-size: 14px; color: #374151;">
                                <tr style="background-color: #f3f4f6;">
                                    <td style="padding: 8px; font-weight: bold;">Order Number</td>
                                    <td style="padding: 8px;">#{{ $order->order->order_number }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; font-weight: bold;">Book</td>
                                    <td style="padding: 8px;">{{ $order->book->name }}</td>
                                </tr>
                                <tr style="background-color: #f3f4f6;">
                                    <td style="padding: 8px; font-weight: bold;">Quantity</td>
                                    <td style="padding: 8px;">{{ $order->quantity }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; font-weight: bold;">Total</td>
                                    <td style="padding: 8px;">${{ $order->total }}</td>
                                </tr>
                                <tr style="background-color: #f3f4f6;">
                                    <td style="padding: 8px; font-weight: bold;">Payment Status</td>
                                    <td style="padding: 8px;">{{ $order->order->payment->status }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; font-weight: bold;">Shipping Name</td>
                                    <td style="padding: 8px;">{{ $order->order->client->name }}</td>
                                </tr>
                                <tr style="background-color: #f3f4f6;">
                                    <td style="padding: 8px; font-weight: bold;">Shipping Address</td>
                                    <td style="padding: 8px;">{{ $order->order->shipping_address }}, {{ $order->order->shipping_city }}, {{ $order->order->shipping_country }}</td>
                                </tr>
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
                                    <tr>
                                        <td style="padding: 8px; border: 1px solid #e5e7eb;">
                                            <a href="{{ route('publisher.books.show', $order->book->uuid) }}" style="text-decoration: underline; color: #4f46e5;">
                                                {{ $order->book->name }}
                                            </a>
                                        </td>
                                        <td style="padding: 8px; border: 1px solid #e5e7eb;">{{ Str::limit($order->book->description, 20) }}</td>
                                        <td style="padding: 8px; border: 1px solid #e5e7eb;">${{ $order->book->price }}</td>
                                        <td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $order->book->category->name }}</td>
                                        <td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $order->quantity }}</td>
                                        <td style="padding: 8px; border: 1px solid #e5e7eb;">${{ $order->total }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div style="margin: 30px 0; text-align: center;">
                                <a href="{{ route('publisher.orders.show', $order->order->uuid) }}"
                                   style="background-color: #c084fc; color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; display: inline-block; font-weight: bold;">
                                    View Order Details
                                </a>
                            </div>
                        </td>
                    </tr>

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
