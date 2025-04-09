<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Category Updated</title>
</head>

<body style="font-family: 'Figtree', sans-serif; background-color: #f3e8ff; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); overflow: hidden;">

                    <!-- Header -->
                    <tr>
                        <td style="background-color: #c084fc; padding: 20px 40px; color: white; text-align: center;">
                            <h1 style="margin: 0; font-size: 24px;">{{ config('app.name') }}</h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="margin: 0 0 20px 0; color: #4b5563;">Hello {{ $user->name }},</h2>
                            <p style="color: #6b7280; font-size: 14px; line-height: 1.6;">
                                A category has just been updated by <strong>{{ $admin_name }}</strong>. Below are the updated details:
                            </p>

                            <!-- Info Table -->
                            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #e5e7eb;">Category ID</td>
                                    <td style="padding: 8px; border: 1px solid #e5e7eb;">
                                        <a href="{{ route('admin.categories.show', $category->uuid) }}" style="color: #7c3aed; text-decoration: underline;">#{{ $category->uuid }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #e5e7eb;">Name</td>
                                    <td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #e5e7eb;">Description</td>
                                    <td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $category->description }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #e5e7eb;">Created At</td>
                                    <td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $category->created_at }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 8px; border: 1px solid #e5e7eb;">Updated At</td>
                                    <td style="padding: 8px; border: 1px solid #e5e7eb;">{{ $category->updated_at }}</td>
                                </tr>
                            </table>

                            <!-- View Button -->
                            <div style="margin: 30px 0; text-align: center;">
                                <a href="{{ route('admin.categories.show', $category->uuid) }}"
                                    style="background-color: #c084fc; color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; display: inline-block; font-weight: bold;">
                                    View Category
                                </a>
                            </div>
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
