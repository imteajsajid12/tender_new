<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>אישור קבלת מועמדות</title>
    <link href="https://fonts.googleapis.com/earlyaccess/opensanshebrew.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans Hebrew', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            direction: rtl;
            text-align: right;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            line-height: 1.6;
        }

        .email-container {
            max-width: 700px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #2c5aa0, #1e3d72);
            color: white;
            padding: 0;
            position: relative;
            overflow: hidden;
        }

        .header-content {
            display: flex;
            align-items: center;
            padding: 25px 30px;
            position: relative;
            z-index: 2;
        }

        .logo-section {
            flex-shrink: 0;
            margin-left: 25px;
        }

        .logo-section img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 8px;
        }

        .header-text {
            flex: 1;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: bold;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .header-subtitle {
            margin: 5px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
            font-weight: normal;
        }

        .header-decoration {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .content {
            padding: 35px 30px;
        }

        .date-header {
            text-align: left;
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .greeting {
            font-size: 20px;
            color: #2c5aa0;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .message {
            color: #555;
            margin-bottom: 25px;
            font-size: 16px;
            line-height: 1.7;
        }

        .tender-info {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-right: 4px solid #2c5aa0;
            padding: 20px;
            margin: 25px 0;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(44, 90, 160, 0.1);
        }

        .tender-info strong {
            color: #2c5aa0;
            font-size: 18px;
        }

        .tender-name {
            font-size: 16px;
            color: #333;
            margin-top: 8px;
            font-weight: 600;
        }

        .attachments-info {
            background: linear-gradient(135deg, #e8f5e8, #d4f4d4);
            border: 1px solid #28a745;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.1);
        }

        .attachments-info h3 {
            color: #155724;
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .attachments-info h3:before {
            content: "📎";
            margin-left: 8px;
            font-size: 20px;
        }

        .attachments-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .attachments-list li {
            padding: 12px 15px;
            border-bottom: 1px solid #c3e6cb;
            background: rgba(255, 255, 255, 0.5);
            margin-bottom: 5px;
            border-radius: 4px;
            display: flex;
            align-items: center;
        }

        .attachments-list li:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .attachments-list li:before {
            content: "✓";
            margin-left: 10px;
            color: #28a745;
            font-weight: bold;
            font-size: 16px;
        }

        .next-steps {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 1px solid #ffc107;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            box-shadow: 0 2px 8px rgba(255, 193, 7, 0.1);
        }

        .next-steps h3 {
            color: #856404;
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .next-steps h3:before {
            content: "⏰";
            margin-left: 8px;
            font-size: 20px;
        }

        .next-steps p {
            margin-bottom: 12px;
            line-height: 1.6;
        }

        .footer {
            background: linear-gradient(135deg, #2c5aa0, #1e3d72);
            padding: 25px;
            text-align: center;
            color: white;
            position: relative;
        }

        .footer-logo {
            margin-bottom: 15px;
        }

        .footer-logo img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            opacity: 0.8;
        }

        .signature {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 2px solid rgba(255, 255, 255, 0.2);
            color: rgba(255, 255, 255, 0.9);
            text-align: center;
        }

        .signature strong {
            color: white;
            font-size: 18px;
        }

        .contact-info {
            margin-top: 15px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.7);
            font-style: italic;
        }

        .website-link {
            color: #ffc107;
            text-decoration: none;
            font-weight: 600;
        }

        .website-link:hover {
            text-decoration: underline;
        }

        .divider {
            height: 2px;
            background: linear-gradient(to left, transparent, #2c5aa0, transparent);
            margin: 25px 0;
            border: none;
        }

        @media (max-width: 600px) {
            .email-container {
                margin: 0;
                border-radius: 0;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
                padding: 20px 15px;
            }

            .logo-section {
                margin-left: 0;
                margin-bottom: 15px;
            }

            .logo-section img {
                width: 60px;
                height: 60px;
            }

            .header h1 {
                font-size: 22px;
            }

            .content, .footer {
                padding: 25px 15px;
            }

            .tender-info, .attachments-info, .next-steps {
                padding: 15px;
                margin: 20px 0;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        {{-- <div class="header">
            <div class="header-decoration"></div>
            <div class="header-content">
                <div class="logo-section">
                    <img src="{{ isset($organization_logo) ? asset($organization_logo) : asset('img/logo-b.png') }}"
                         alt="לוגו הארגון">
                </div>
                <div class="header-text">
                    <h1>אישור קבלת מועמדות</h1>
                    <div class="header-subtitle">מערכת ניהול מכרזים</div>
                </div>
            </div> --}}
        </div>

        <div class="content">
            {{-- <div class="date-header">
                תאריך: {{ date('d/m/Y') }}
                <br>
                <?php
                    // $str = jdtojewish(gregoriantojd( date('m'), date('d'), date('Y')), true, CAL_JEWISH_ADD_GERESHAYIM);
                    // $str1 = iconv ('WINDOWS-1255', 'UTF-8', $str);
                ?>
                תאריך עברי: {{ $str1 }}
            </div>

            <div class="greeting">
                לכבוד {{ $applicant_name }},
            </div> --}}

            <div class="message">
                {{-- תודה על פנייתך, מצ״ב: --}}
                אישור קבלת הגשת המועמדות, טופס הגשת המועמדות שמילאת והמסמכים שצרפת.
            </div>
            {{-- <div class="message">
                תודה על פנייתך, מצ״ב:<br>
                אישור קבלת הגשת המועמדות, טופס הגשת המועמדות שמילאת והמסמכים שצרפת
            </div> --}}

            {{-- <div class="tender-info">
                <strong>פרטי המכרז:</strong>
                <div class="tender-name">{{ $tender_name }}</div>
            </div>

            <hr class="divider"> --}}

        </div>

        {{-- <div class="footer">
            <div class="footer-logo">
                <img src="{{ isset($organization_logo) ? asset($organization_logo) : asset('img/logo-b.png') }}"
                     alt="לוגו הארגון">
            </div>

            <div class="signature">
                <strong>בברכה והצלחה,</strong><br>
                צוות משאבי אנוש<br>
                {{ $organization_name ?? 'מועצה מקומית קריית ארבע חברון' }}

                <div class="contact-info">
                    <p>
                        <a href="https://www.tcarmel.automas.co.il" class="website-link">www.tcarmel.automas.co.il</a>
                    </p>
                    <p>הודעה זו נשלחה אוטומטית ממערכת ניהול המכרזים</p>
                    <p>© {{ date('Y') }} {{ $organization_name ?? 'מועצה מקומית קריית ארבע חברון' }} - כל הזכויות שמורות</p>
                </div>
            </div>
        </div> --}}
    </div>
</body>
</html>
