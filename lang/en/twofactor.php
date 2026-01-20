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

];
