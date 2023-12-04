<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4;">
<div class="container" style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <h1 style="color: #333;">Welcome to Our Website</h1>
    <p style="color: #666;">Dear {{ $mailData['name'] }},</p>
    <p style="color: #666;">Thank you for joining our website. We are excited to have you on board!</p>
    <p style="color: #666;">Your verification code is: <strong>{{ $mailData['code'] }}</strong></p>

    <p style="color: #666;">If you have any questions or need assistance, please don't hesitate to contact us.</p>

    <p style="color: #666;">Best regards,<br>Your Meal Bhai Team</p>
</div>
</body>
</html>
