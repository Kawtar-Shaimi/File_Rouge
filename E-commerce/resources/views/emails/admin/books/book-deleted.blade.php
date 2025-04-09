<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Book Deleted Notification</title>
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
                            <h2 style="margin: 0 0 20px 0; color: #4b5563;">Hello {{ $user->name }},</h2>
                            <p style="color: #6b7280; font-size: 14px; line-height: 1.6;">
                                We wanted to inform you that a book has been <strong>deleted</strong> by one of the publishers.
                            </p>
                            <p style="color: #6b7280; font-size: 14px; line-height: 1.6;">
                                The publisher has removed the following book from the platform:
                            </p>
                            <ul style="color: #6b7280; font-size: 14px; line-height: 1.6; list-style-type: disc; margin-left: 20px;">
                                <li><strong>Book Name:</strong> {{ $book_name }}</li>
                                <li><strong>Publisher:</strong> {{ $publisher_name }}</li>
                                <li><strong>Deletion Date:</strong> {{ $deletedAt }}</li>
                            </ul>

                            <div style="margin: 30px 0; text-align: center;">
                                <a href="{{ route('admin.books.index') }}" style="background-color: #c084fc; color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; display: inline-block; font-weight: bold;">
                                    View All Books
                                </a>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="background-color: #f3e8ff; text-align: center; padding: 20px; color: #6b7280; font-size: 12px;">
                            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
