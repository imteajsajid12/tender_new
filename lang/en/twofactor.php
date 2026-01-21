<?php

/**
 * English translations for Two-Factor Authentication
 */

return [

    // General Messages
    'otp_sent' => 'Verification code has been sent to your email',
    'otp_verified' => 'Verification successful',
    'otp_not_found' => 'No valid verification code found. Please request a new one',
    'otp_expired' => 'Verification code has expired. Please request a new one',
    'invalid_otp' => 'Invalid verification code. :attempts attempts remaining',
    'max_attempts_exceeded' => 'Maximum attempts exceeded. Please request a new code',
    'rate_limit_exceeded' => 'Too many requests. Please try again later',
    'otp_generation_failed' => 'Failed to generate verification code. Please try again',
    'email_send_failed' => 'Failed to send email. Please try again',
    'user_not_found' => 'User not found',
    'resend_cooldown' => 'Please wait :seconds seconds before requesting a new code',

    // Page Titles
    'verification_title' => 'Two-Factor Verification',
    'verification_subtitle' => 'Enter the verification code sent to your email',

    // Form Labels
    'otp_placeholder' => 'Enter verification code',
    'verify_button' => 'Verify',
    'resend_button' => 'Resend Code',
    'back_to_login' => 'Back to Login',
    'remember_device' => 'Remember this device for :days days',

    // Email Content
    'email_header_subtitle' => 'Secure Identity Verification',
    'email_greeting' => 'Hello :name,',
    'email_message_login' => 'A login request was received for your account. Use the following code to verify your identity:',
    'email_message_password_reset' => 'A password reset request was received. Use the following code to continue:',
    'email_message_email_verify' => 'Use the following code to verify your email address:',
    'email_message_transaction' => 'Use the following code to confirm the transaction:',
    'email_message_default' => 'Use the following code for verification:',
    'email_otp_label' => 'Your Verification Code',
    'email_expiry_notice' => 'Note:',
    'email_expiry_message' => 'This code will expire in :minutes minutes.',
    'email_security_title' => 'Security Tips:',
    'email_security_1' => 'Never share this code with anyone',
    'email_security_2' => 'Our team will never ask you for this code',
    'email_security_3' => 'If you did not request this code, ignore this email',
    'email_footer_text' => 'This email was sent by :appName',
    'email_footer_auto' => 'This is an automated email, please do not reply',

    // Error Messages
    'session_expired' => 'Session expired. Please login again',
    'verification_failed' => 'Verification failed. Please try again',
    'invalid_request' => 'Invalid request',

    // Success Messages
    'login_success' => 'Login successful',
    'verification_complete' => 'Verification completed successfully',

    // Settings Page
    'settings_title' => 'Two-Factor Authentication Settings (2FA)',
    'settings_subtitle' => 'Two-factor authentication settings for the system - OTP code sent via email',

    // Settings - General
    'settings_general' => 'General Settings',
    'settings_enabled' => 'Enable Two-Factor Authentication',
    'settings_enabled_help' => 'When enabled, users will need to enter a verification code sent to their email',
    'settings_status_enabled' => 'Enabled',
    'settings_status_disabled' => 'Disabled',

    // Settings - OTP
    'settings_otp' => 'OTP Code Settings',
    'settings_otp_length' => 'OTP Code Length',
    'settings_otp_length_digits' => ':count digits',
    'settings_otp_length_recommended' => '(Recommended)',
    'settings_otp_expiry' => 'Expiry Time (minutes)',
    'settings_otp_expiry_help' => 'The code will expire after the specified number of minutes (1-60)',
    'settings_max_attempts' => 'Maximum Attempts',
    'settings_max_attempts_help' => 'Maximum number of attempts to enter an incorrect code (1-10)',

    // Settings - Rate Limiting
    'settings_rate_limiting' => 'Rate Limiting',
    'settings_rate_limit' => 'Maximum Codes Per Hour',
    'settings_rate_limit_help' => 'Maximum number of codes that can be sent to a user per hour',
    'settings_resend_cooldown' => 'Resend Cooldown (seconds)',
    'settings_resend_cooldown_help' => 'Wait time between resend requests (30-300 seconds)',

    // Settings - Device Memory
    'settings_device_memory' => 'Device Memory',
    'settings_remember_device' => 'Allow Device Remembering',
    'settings_remember_device_help' => 'Allows users to skip two-factor authentication on recognized devices',
    'settings_remember_days' => 'Days to Remember Device',
    'settings_remember_days_help' => 'Number of days the device is remembered (1-90)',

    // Settings - Exemptions
    'settings_exemptions' => 'Exemptions',
    'settings_exempt_roles' => 'Exempt Roles',
    'settings_exempt_roles_help' => 'Roles that are exempt from two-factor authentication (comma separated)',
    'settings_exempt_roles_placeholder' => 'e.g., admin,superuser',
    'settings_ip_whitelist' => 'Allowed IP Addresses',
    'settings_ip_whitelist_help' => 'IP addresses that are exempt from two-factor authentication (comma separated)',
    'settings_ip_whitelist_placeholder' => 'e.g., 192.168.1.1,10.0.0.0/24',

    // Settings - Statistics
    'settings_statistics' => 'Today\'s Statistics',
    'settings_stat_sent' => 'Codes Sent',
    'settings_stat_verified' => 'Successfully Verified',
    'settings_stat_failed' => 'Failed Attempts',

    // Settings - Actions
    'settings_save' => 'Save Settings',
    'settings_refresh' => 'Refresh',
    'settings_saved' => 'Two-factor authentication settings updated successfully',
    'settings_save_error' => 'Error saving settings',
    'settings_load_error' => 'Error loading settings',
    'settings_no_permission' => 'You do not have permission to change settings',

];
