<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Book Updated</title>
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
                                A publisher has updated a book in our platform. Below are the details:
                            </p>

                            <table class="w-full border-collapse" style="margin-top: 30px;">
                                <tr>
                                    <td class="p-3 border" style="font-weight: bold; color: #4b5563;">Book Name</td>
                                    <td class="p-3 border underline italic hover:text-blue-400" style="color: #4b5563;">
                                        <a href="{{ route('admin.books.show', $book->uuid) }}" style="text-decoration: none; color: #4b5563;">#{{ $book->name }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-3 border" style="font-weight: bold; color: #4b5563;">Book Description</td>
                                    <td class="p-3 border" style="color: #6b7280;">{{ $book->description }}</td>
                                </tr>
                                <tr>
                                    <td class="p-3 border" style="font-weight: bold; color: #4b5563;">Book Category</td>
                                    <td class="p-3 border" style="color: #6b7280;">{{ $book->category->name }}</td>
                                </tr>
                                <tr>
                                    <td class="p-3 border" style="font-weight: bold; color: #4b5563;">Book Price</td>
                                    <td class="p-3 border" style="color: #6b7280;">{{ $book->price }}</td>
                                </tr>
                                <tr>
                                    <td class="p-3 border" style="font-weight: bold; color: #4b5563;">Book Stock</td>
                                    <td class="p-3 border" style="color: #6b7280;">{{ $book->stock }}</td>
                                </tr>
                                <tr>
                                    <td class="p-3 border" style="font-weight: bold; color: #4b5563;">Publisher Name</td>
                                    <td class="p-3 border" style="color: #6b7280;">{{ $book->publisher->name }}</td>
                                </tr>
                                <tr>
                                    <td class="p-3 border" style="font-weight: bold; color: #4b5563;">Creation Date</td>
                                    <td class="p-3 border" style="color: #6b7280;">{{ $book->created_at }}</td>
                                </tr>
                                <tr>
                                    <td class="p-3 border" style="font-weight: bold; color: #4b5563;">Update Date</td>
                                    <td class="p-3 border" style="color: #6b7280;">{{ $book->updated_at }}</td>
                                </tr>
                            </table>

                            <div style="margin: 30px 0; text-align: center;">
                                <a href="{{ route('admin.books.show', $book->uuid) }}"
                                    style="background-color: #c084fc; color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; display: inline-block; font-weight: bold;">
                                    View Book on Website
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
