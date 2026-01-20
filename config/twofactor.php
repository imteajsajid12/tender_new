<?php

/**
 * Two-Factor Authentication Configuration
 *
 * This configuration file contains all settings for the 2FA OTP system.
 * Copy this file to your config directory and customize as needed.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Enable Two-Factor Authentication
    |--------------------------------------------------------------------------
    |
    | This option controls whether 2FA is enabled for the application.
    | When disabled, users can login without OTP verification.
    |
    */

    'enabled' => env('TWOFACTOR_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | OTP Length
    |--------------------------------------------------------------------------
    |
    | The number of digits in the generated OTP code.
    | Recommended: 6 digits for a good balance of security and usability.
    |
    */

    'otp_length' => env('TWOFACTOR_OTP_LENGTH', 6),

    /*
    |--------------------------------------------------------------------------
    | OTP Expiry Time
    |--------------------------------------------------------------------------
    |
    | The number of minutes before an OTP code expires.
    | Shorter times are more secure but less convenient.
    |
    */

    'otp_expiry_minutes' => env('TWOFACTOR_OTP_EXPIRY', 10),

    /*
    |--------------------------------------------------------------------------
    | Maximum Verification Attempts
    |--------------------------------------------------------------------------
    |
    | The maximum number of times a user can attempt to verify an OTP
    | before it becomes invalid. This helps prevent brute force attacks.
    |
    */

    'max_attempts' => env('TWOFACTOR_MAX_ATTEMPTS', 5),

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    |
    | Maximum number of OTP codes that can be generated per user per hour.
    | This prevents abuse and email flooding.
    |
    */

    'rate_limit_per_hour' => env('TWOFACTOR_RATE_LIMIT', 5),

    /*
    |--------------------------------------------------------------------------
    | Cooldown Period
    |--------------------------------------------------------------------------
    |
    | Minimum seconds between OTP resend requests.
    |
    */

    'resend_cooldown_seconds' => env('TWOFACTOR_RESEND_COOLDOWN', 60),

    /*
    |--------------------------------------------------------------------------
    | Remember 2FA Device
    |--------------------------------------------------------------------------
    |
    | When enabled, users can choose to "remember" their device for a
    | specified number of days, skipping 2FA on subsequent logins.
    |
    */

    'remember_device' => [
        'enabled' => env('TWOFACTOR_REMEMBER_DEVICE', true),
        'days' => env('TWOFACTOR_REMEMBER_DAYS', 30),
        'cookie_name' => 'twofactor_trusted_device',
    ],

    /*
    |--------------------------------------------------------------------------
    | Session Keys
    |--------------------------------------------------------------------------
    |
    | Session keys used to store 2FA state during the authentication flow.
    |
    */

    'session' => [
        'user_id_key' => 'twofactor_user_id',
        'verified_key' => 'twofactor_verified',
        'timestamp_key' => 'twofactor_timestamp',
    ],

    /*
    |--------------------------------------------------------------------------
    | Email Configuration
    |--------------------------------------------------------------------------
    |
    | Settings for the OTP email notifications.
    |
    */

    'email_template' => 'emails.otp',
    'email_locale' => env('TWOFACTOR_EMAIL_LOCALE', 'he'),
    'email_direction' => env('TWOFACTOR_EMAIL_DIRECTION', 'rtl'),

    /*
    |--------------------------------------------------------------------------
    | Email Subjects
    |--------------------------------------------------------------------------
    |
    | Subject lines for different OTP purposes.
    |
    */

    'subjects' => [
        'login' => env('TWOFACTOR_SUBJECT_LOGIN', 'קוד אימות כניסה'),
        'password_reset' => env('TWOFACTOR_SUBJECT_PASSWORD', 'קוד אימות לאיפוס סיסמה'),
        'email_verify' => env('TWOFACTOR_SUBJECT_EMAIL', 'אימות כתובת אימייל'),
        'transaction' => env('TWOFACTOR_SUBJECT_TRANSACTION', 'קוד אימות פעולה'),
        'default' => env('TWOFACTOR_SUBJECT_DEFAULT', 'קוד האימות שלך'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes Configuration
    |--------------------------------------------------------------------------
    |
    | Configure the routes for the 2FA system.
    |
    */

    'routes' => [
        'prefix' => '2fa',
        'middleware' => ['web'],
        'verify' => '/verify',
        'resend' => '/resend',
    ],

    /*
    |--------------------------------------------------------------------------
    | Redirect URLs
    |--------------------------------------------------------------------------
    |
    | Where to redirect users after various 2FA actions.
    |
    */

    'redirects' => [
        'after_verification' => env('TWOFACTOR_REDIRECT_AFTER_VERIFY', '/admin'),
        'on_failure' => env('TWOFACTOR_REDIRECT_ON_FAILURE', '/login'),
    ],

    /*
    |--------------------------------------------------------------------------
    | User Roles Exempt from 2FA
    |--------------------------------------------------------------------------
    |
    | List of user roles that should bypass 2FA requirement.
    | Leave empty to require 2FA for all users.
    |
    */

    'exempt_roles' => explode(',', env('TWOFACTOR_EXEMPT_ROLES', '')),

    /*
    |--------------------------------------------------------------------------
    | IP Whitelist
    |--------------------------------------------------------------------------
    |
    | List of IP addresses that can bypass 2FA.
    | Useful for internal networks or testing environments.
    |
    */

    'ip_whitelist' => explode(',', env('TWOFACTOR_IP_WHITELIST', '')),

    /*
    |--------------------------------------------------------------------------
    | Cleanup Settings
    |--------------------------------------------------------------------------
    |
    | Settings for automatic cleanup of expired OTP codes.
    |
    */

    'cleanup' => [
        'enabled' => env('TWOFACTOR_CLEANUP_ENABLED', true),
        'older_than_days' => env('TWOFACTOR_CLEANUP_DAYS', 7),
    ],

    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    |
    | Enable detailed logging for debugging purposes.
    |
    */

    'logging' => [
        'enabled' => env('TWOFACTOR_LOGGING', true),
        'channel' => env('TWOFACTOR_LOG_CHANNEL', 'stack'),
    ],

];
