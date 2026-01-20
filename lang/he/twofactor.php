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

];
