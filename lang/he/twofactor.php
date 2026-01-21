<?php

/**
 * Hebrew translations for Two-Factor Authentication
 */

return [

    // General Messages
    'otp_sent' => 'קוד אימות נשלח לאימייל שלך',
    'otp_verified' => 'האימות הצליח',
    'otp_not_found' => 'לא נמצא קוד אימות תקף. אנא בקש קוד חדש',
    'otp_expired' => 'קוד האימות פג תוקף. אנא בקש קוד חדש',
    'invalid_otp' => 'קוד אימות שגוי. נותרו :attempts ניסיונות',
    'max_attempts_exceeded' => 'חרגת ממספר הניסיונות המותר. אנא בקש קוד חדש',
    'rate_limit_exceeded' => 'שלחת יותר מדי בקשות. אנא נסה שוב מאוחר יותר',
    'otp_generation_failed' => 'נכשלה יצירת קוד האימות. אנא נסה שוב',
    'email_send_failed' => 'נכשלה שליחת האימייל. אנא נסה שוב',
    'user_not_found' => 'המשתמש לא נמצא',
    'resend_cooldown' => 'אנא המתן :seconds שניות לפני בקשת קוד חדש',

    // Page Titles
    'verification_title' => 'אימות דו-שלבי',
    'verification_subtitle' => 'הזן את קוד האימות שנשלח לאימייל שלך',

    // Form Labels
    'otp_placeholder' => 'הזן קוד אימות',
    'verify_button' => 'אמת',
    'resend_button' => 'שלח קוד חדש',
    'back_to_login' => 'חזור לדף הכניסה',
    'remember_device' => 'זכור מכשיר זה ל-:days ימים',

    // Email Content
    'email_header_subtitle' => 'אימות זהות מאובטח',
    'email_greeting' => 'שלום :name,',
    'email_message_login' => 'התקבלה בקשה להתחברות לחשבון שלך. השתמש בקוד הבא כדי לאמת את זהותך:',
    'email_message_password_reset' => 'התקבלה בקשה לאיפוס סיסמה. השתמש בקוד הבא כדי להמשיך:',
    'email_message_email_verify' => 'השתמש בקוד הבא כדי לאמת את כתובת האימייל שלך:',
    'email_message_transaction' => 'השתמש בקוד הבא כדי לאשר את הפעולה:',
    'email_message_default' => 'השתמש בקוד הבא לאימות:',
    'email_otp_label' => 'קוד האימות שלך',
    'email_expiry_notice' => 'שים לב:',
    'email_expiry_message' => 'קוד זה יפוג בעוד :minutes דקות.',
    'email_security_title' => 'טיפים לאבטחה:',
    'email_security_1' => 'לעולם אל תשתף את הקוד הזה עם אף אחד',
    'email_security_2' => 'צוות האתר לעולם לא יבקש ממך את הקוד',
    'email_security_3' => 'אם לא ביקשת קוד זה, התעלם מאימייל זה',
    'email_footer_text' => 'אימייל זה נשלח על ידי :appName',
    'email_footer_auto' => 'זהו אימייל אוטומטי, אנא אל תשיב לו',

    // Error Messages
    'session_expired' => 'הפעלה פגה תוקף. אנא התחבר מחדש',
    'verification_failed' => 'האימות נכשל. אנא נסה שוב',
    'invalid_request' => 'בקשה לא תקינה',

    // Success Messages
    'login_success' => 'התחברת בהצלחה',
    'verification_complete' => 'האימות הושלם בהצלחה',

    // Settings Page
    'settings_title' => 'הגדרות אימות דו-שלבי (2FA)',
    'settings_subtitle' => 'הגדרות אימות דו-שלבי למערכת - קוד OTP נשלח באימייל',

    // Settings - General
    'settings_general' => 'הגדרות כלליות',
    'settings_enabled' => 'הפעל אימות דו-שלבי',
    'settings_enabled_help' => 'כאשר מופעל, המשתמשים יצטרכו להזין קוד אימות שנשלח לאימייל שלהם',
    'settings_status_enabled' => 'מופעל',
    'settings_status_disabled' => 'מושבת',

    // Settings - OTP
    'settings_otp' => 'הגדרות קוד OTP',
    'settings_otp_length' => 'אורך קוד OTP',
    'settings_otp_length_digits' => ':count ספרות',
    'settings_otp_length_recommended' => '(מומלץ)',
    'settings_otp_expiry' => 'זמן תפוגה (דקות)',
    'settings_otp_expiry_help' => 'הקוד יפוג לאחר מספר הדקות שנקבע (1-60)',
    'settings_max_attempts' => 'מקסימום ניסיונות',
    'settings_max_attempts_help' => 'מספר הניסיונות המרבי להזנת קוד שגוי (1-10)',

    // Settings - Rate Limiting
    'settings_rate_limiting' => 'הגבלת קצב',
    'settings_rate_limit' => 'מקסימום קודים לשעה',
    'settings_rate_limit_help' => 'מספר הקודים המרבי שניתן לשלוח למשתמש בשעה',
    'settings_resend_cooldown' => 'זמן המתנה לשליחה חוזרת (שניות)',
    'settings_resend_cooldown_help' => 'זמן ההמתנה בין בקשות לשליחה חוזרת של קוד (30-300 שניות)',

    // Settings - Device Memory
    'settings_device_memory' => 'זיכרון מכשיר',
    'settings_remember_device' => 'אפשר זכירת מכשיר',
    'settings_remember_device_help' => 'מאפשר למשתמשים לדלג על אימות דו-שלבי במכשירים מוכרים',
    'settings_remember_days' => 'ימים לזכירת מכשיר',
    'settings_remember_days_help' => 'מספר הימים שהמכשיר נזכר (1-90)',

    // Settings - Exemptions
    'settings_exemptions' => 'פטורים',
    'settings_exempt_roles' => 'תפקידים פטורים',
    'settings_exempt_roles_help' => 'תפקידים שפטורים מאימות דו-שלבי (מופרדים בפסיק)',
    'settings_exempt_roles_placeholder' => 'לדוגמה: admin,superuser',
    'settings_ip_whitelist' => 'כתובות IP מורשות',
    'settings_ip_whitelist_help' => 'כתובות IP שפטורות מאימות דו-שלבי (מופרדות בפסיק)',
    'settings_ip_whitelist_placeholder' => 'לדוגמה: 192.168.1.1,10.0.0.0/24',

    // Settings - Statistics
    'settings_statistics' => 'סטטיסטיקות היום',
    'settings_stat_sent' => 'קודים נשלחו',
    'settings_stat_verified' => 'אומתו בהצלחה',
    'settings_stat_failed' => 'ניסיונות כושלים',

    // Settings - Actions
    'settings_save' => 'שמור הגדרות',
    'settings_refresh' => 'רענן',
    'settings_saved' => 'הגדרות האימות הדו-שלבי עודכנו בהצלחה',
    'settings_save_error' => 'שגיאה בשמירת ההגדרות',
    'settings_load_error' => 'שגיאה בטעינת ההגדרות',
    'settings_no_permission' => 'אין לך הרשאה לשנות הגדרות',

];
