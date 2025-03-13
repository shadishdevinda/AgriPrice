<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Credentials</title>
</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f7f7f7;">
    <!-- Email Container -->
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f7f7f7;">
        <tr>
            <td align="center">
                <!-- Email Content -->
                <table width="600" cellpadding="0" cellspacing="0" border="0"
                    style="background-color: #ffffff; margin: 20px auto; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                    <!-- Header -->
                    <tr>
                        <td
                            style="padding: 20px; background-color: #065744; border-radius: 8px 8px 0 0; text-align: center;">
                            <h1 style="color: #ffffff; font-size: 24px; margin: 0;">{{ config('app.name') }}</h1>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 30px;">
                            <h2 style="color: #333333; font-size: 20px; margin-top: 0;">Your Login Credentials</h2>
                            <p style="color: #555555; font-size: 16px; line-height: 1.6;">Hello,</p>
                            <p style="color: #555555; font-size: 16px; line-height: 1.6;">Your account has been created
                                successfully. Here are your login credentials:</p>
                            <ul style="color: #555555; font-size: 16px; line-height: 1.6; padding-left: 20px;">
                                <li><strong>Username:</strong> {{ $username }}</li>
                                <li><strong>Password:</strong> {{ $password }}</li>
                            </ul>
                            <p style="color: #555555; font-size: 16px; line-height: 1.6;">Please keep this information
                                secure and do not share it with anyone and after you login change the provided password.
                            </p>
                            <p style="color: #555555; font-size: 16px; line-height: 1.6;">Thank you!</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="padding: 20px; background-color: #f1f1f1; border-radius: 0 0 8px 8px; text-align: center;">
                            <p style="color: #777777; font-size: 14px; margin: 0;">© {{ date('Y') }}
                                {{ config('app.name') }}. All rights reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
