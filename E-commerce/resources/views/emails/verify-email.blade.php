<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
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
                            <h2 style="margin: 0 0 20px 0; color: #4b5563;">Verify Your Email Address</h2>
                            <p style="color: #6b7280; font-size: 14px; line-height: 1.6;">
                                Thank you for signing up. Please click the button below to verify your email address to access your account.
                            </p>
                            <p style="color: #6b7280; font-size: 14px; line-height: 1.6;">
                                The verification link will expire in 15 minutes. If you did not create an account, no further action is required.
                            </p>

                            <div style="margin: 30px 0; text-align: center;">
                                <a href="{{ $url }}" style="background-color: #c084fc; color: white; text-decoration: none; padding: 12px 24px; border-radius: 8px; display: inline-block; font-weight: bold;">
                                    Verify Email
                                </a>
                            </div>

                            <p style="color: #9ca3af; font-size: 12px;">
                                If you’re having trouble clicking the "Verify Email" button, copy and paste the URL below into your web browser:
                            </p>

                            <p style="word-break: break-all; color: #6b7280; font-size: 12px;">
                                <a href="{{ $url }}" style="color: #7c3aed;">{{ $url }}</a>
                            </p>

                            <p style="color: #9ca3af; font-size: 12px;">
                                Your account will not be fully activated until you verify your email address. If you didn't verify your email address in 24h your account will be deleted.
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
