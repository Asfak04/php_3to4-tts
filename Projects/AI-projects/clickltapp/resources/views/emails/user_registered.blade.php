<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f9fafb; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; padding: 40px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        h1 { color: #111827; font-size: 24px; margin-bottom: 20px; }
        p { color: #4b5563; line-height: 1.6; font-size: 16px; margin-bottom: 20px; }
        .box { background-color: #f3f4f6; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .box p { margin: 5px 0; font-family: monospace; font-size: 15px; color: #1f2937; }
        .btn { display: inline-block; background-color: #10b981; color: #ffffff; text-decoration: none; padding: 12px 24px; border-radius: 8px; font-weight: bold; margin-top: 20px; }
        .footer { text-align: center; margin-top: 40px; color: #9ca3af; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Click<span style="color: #f59e0b;">IT</span>!</h1>
        <p>Hi {{ $user->name }},</p>
        <p>Thank you for registering with us. Your account has been successfully created and you're now ready to shop for fresh groceries delivered fast to your home.</p>
        
        <div class="box">
            <strong>Your Login Credentials:</strong>
            <p>Email: {{ $user->email }}</p>
            <p>Password: {{ $password }}</p>
        </div>

        <p>We recommend changing your password after your first login for better security.</p>

        <a href="{{ route('login') }}" class="btn">Login to Your Account</a>

        <div class="footer">
            <p>Thank you for choosing ClickIT!<br>This is an automated email, please do not reply.</p>
        </div>
    </div>
</body>
</html>
