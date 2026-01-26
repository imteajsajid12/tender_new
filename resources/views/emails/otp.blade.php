<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>קוד אימות</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f4f4;
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .email-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(135deg, #61cb14 0%, #408d5a 100%);
            padding: 30px 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .email-header p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }
        .email-body {
            padding: 30px 20px;
            text-align: center;
        }
        .greeting {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .message {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }
        .otp-container {
            background-color: #f8f9fa;
            border: 2px dashed #55a828;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .otp-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }
        .otp-code {
            font-size: 36px;
            font-weight: bold;
              color: #20972d;
            letter-spacing: 8px;
            font-family: 'Courier New', monospace;
        }
        .expiry-notice {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 4px;
            padding: 12px;
            margin: 20px 0;
            font-size: 13px;
            color: #856404;
        }
        .expiry-notice strong {
            color: #664d03;
        }
        .security-notice {
            background-color: #f8f9fa;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            font-size: 12px;
            color: #666;
            text-align: right;
        }
        .security-notice ul {
            margin: 10px 0 0;
            padding-right: 20px;
        }
        .security-notice li {
            margin: 5px 0;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #eee;
        }
        .email-footer p {
            margin: 0;
            font-size: 12px;
            color: #999;
        }
        @media only screen and (max-width: 600px) {
            .email-container { padding: 10px; }
            .email-body { padding: 20px 15px; }
            .otp-code { font-size: 28px; letter-spacing: 4px; }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-card">
            <div class="email-header">
                <h1>{{ $appName ?? config('app.name') }}</h1>
                <p>אימות זהות מאובטח</p>
            </div>

            <div class="email-body">
                @if($user)
                <p class="greeting">שלום {{ $user->name }},</p>
                @endif

                <p class="message">
                    @if($purpose === 'login')
                        התקבלה בקשה להתחברות לחשבון שלך. השתמש בקוד הבא כדי לאמת את זהותך:
                    @elseif($purpose === 'password_reset')
                        התקבלה בקשה לאיפוס סיסמה. השתמש בקוד הבא כדי להמשיך:
                    @else
                        השתמש בקוד הבא לאימות:
                    @endif
                </p>

                <div class="otp-container">
                    <div class="otp-label">קוד האימות שלך</div>
                    <div class="otp-code">{{ $otpCode }}</div>
                </div>

                <div class="expiry-notice">
                    <strong>שים לב:</strong> קוד זה יפוג בעוד {{ $expiryMinutes }} דקות.
                </div>

                <div class="security-notice">
                    <strong>טיפים לאבטחה:</strong>
                    <ul>
                        <li>לעולם אל תשתף את הקוד הזה עם אף אחד</li>
                        <li>צוות האתר לעולם לא יבקש ממך את הקוד</li>
                        <li>אם לא ביקשת קוד זה, התעלם מאימייל זה</li>
                    </ul>
                </div>
            </div>

            <div class="email-footer">
                <p>אימייל זה נשלח על ידי {{ $appName ?? config('app.name') }}</p>
                <p style="margin-top: 10px;">זהו אימייל אוטומטי, אנא אל תשיב לו</p>
            </div>
        </div>
    </div>
</body>
</html>
