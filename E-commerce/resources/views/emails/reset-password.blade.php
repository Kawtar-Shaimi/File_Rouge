<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Your Password</title>
</head>
<body style="font-family: 'Figtree', sans-serif; background-color: #f3e8ff; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); overflow: hidden;">
                    <tr>
                        <td style="background-color: #c084fc; padding: 20px 40px; color: white; text-align: center;">
                            <h1 style="margin: 0; font-size: 24px;">{{ config('app.name') }}</h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="margin: 0 0 20px 0; color: #4b5563;">Reset Your Password</h2>
                            <p style="color: #6b7280; font-size: 14px; line-height: 1.6;">
                                You are receiving this email because we received a password reset request for your account.
                            </p>
                            <p style="color: #6b7280; font-size: 14px; line-height: 1.6;">
                                Click the button below to reset your password. This password reset link will expire in 15 minutes.
                            </p>

                            <div style="margin: 30px 0; text-align: center;">
                                <a href="{{ $url }}" style="background-color: #c084fc; color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; display: inline-block; font-weight: bold;">
                                    Reset Password
                                </a>
                            </div>

                            <p style="color: #9ca3af; font-size: 12px;">
                                If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
                            </p>

                            <p style="word-break: break-all; color: #6b7280; font-size: 12px;">
                                <a href="{{ $url }}" style="color: #7c3aed;">{{ $url }}</a>
                            </p>

                            <p style="color: #9ca3af; font-size: 12px;">
                                If you did not request a password reset, no further action is required.
                            </p>
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