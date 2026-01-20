# Two-Factor Authentication (2FA) Email OTP System

A reusable, production-ready two-factor authentication system for Laravel applications using email-based One-Time Passwords (OTP).

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Requirements](#requirements)
- [Files Changed/Created](#files-changedcreated)
- [Files to Upload to Live Server](#files-to-upload-to-live-server)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Customization](#customization)
- [API Reference](#api-reference)
- [Testing](#testing)
- [Troubleshooting](#troubleshooting)

---

## Overview

This 2FA system adds an additional security layer to your Laravel application by requiring users to verify their identity via a one-time password sent to their email after successful credential verification.

### Flow Diagram

```
User Login → Credentials Valid → Generate OTP → Send Email → Verify OTP → Access Granted
                    ↓                                            ↓
              Login Failed                               Invalid OTP / Expired
```

---

## Features

- **Email-based OTP**: Secure 6-digit codes sent via email
- **Configurable Expiry**: OTP codes expire after configurable time (default: 10 minutes)
- **Rate Limiting**: Prevents OTP flooding (max 5 per hour by default)
- **Brute Force Protection**: Maximum verification attempts (default: 5)
- **Remember Device**: Option to skip 2FA on trusted devices
- **IP Whitelist**: Skip 2FA for specific IP addresses
- **Role Exemptions**: Exclude specific user roles from 2FA
- **Hebrew Language**: Full Hebrew language support with RTL
- **Automatic Cleanup**: Scheduled command to remove expired OTPs
- **Logging**: Comprehensive logging for security audits

---

## Requirements

- PHP 8.2+
- Laravel 11.x
- Mail driver configured (SMTP, Mailgun, etc.)
- Database (MySQL, PostgreSQL, SQLite)

---

## Files Changed/Created

### NEW FILES CREATED (Upload All)

| File Path | Description |
|-----------|-------------|
| `app/Console/Commands/CleanupExpiredOtps.php` | Artisan command for OTP cleanup |
| `app/Http/Controllers/Auth/TwoFactorController.php` | 2FA verification controller |
| `app/Http/Middleware/RequiresTwoFactor.php` | Middleware for pending 2FA |
| `app/Http/Middleware/TwoFactorVerified.php` | Middleware for verified 2FA |
| `app/Mail/OtpMail.php` | OTP email mailable class |
| `app/Models/OtpCode.php` | OTP Eloquent model |
| `app/Providers/TwoFactorServiceProvider.php` | 2FA service provider |
| `app/Services/TwoFactor/OtpService.php` | Core OTP service |
| `config/twofactor.php` | 2FA configuration file |
| `database/migrations/2025_01_20_000001_create_otp_codes_table.php` | OTP database table migration |
| `lang/en/twofactor.php` | English translations |
| `lang/he/twofactor.php` | Hebrew translations |
| `resources/views/auth/two-factor-verify.blade.php` | OTP verification page |
| `resources/views/emails/otp.blade.php` | OTP email template (Hebrew) |
| `docs/TWO_FACTOR_AUTHENTICATION.md` | This documentation file |

### EXISTING FILES MODIFIED (Upload All)

| File Path | Changes Made |
|-----------|--------------|
| `app/Http/Controllers/Auth/LoginController.php` | Added 2FA integration in `authenticated()` method, CSRF token regeneration |
| `bootstrap/app.php` | Registered 2FA middleware aliases |
| `config/app.php` | Added TwoFactorServiceProvider |
| `routes/web.php` | Added 2FA routes (`/2fa/verify`, `/2fa/resend`, `/2fa/cancel`) |
| `resources/views/layouts/sky_app.blade.php` | Added `@stack('scripts')` for JavaScript |
| `resources/views/auth/login.blade.php` | Added info/error/success message displays |
| `.env` | Added TWOFACTOR_* environment variables |

---

## Files to Upload to Live Server

### Step 1: Upload NEW Files

```
app/
├── Console/
│   └── Commands/
│       └── CleanupExpiredOtps.php          ← NEW
├── Http/
│   ├── Controllers/
│   │   └── Auth/
│   │       ├── LoginController.php          ← MODIFIED
│   │       └── TwoFactorController.php      ← NEW
│   └── Middleware/
│       ├── RequiresTwoFactor.php            ← NEW
│       └── TwoFactorVerified.php            ← NEW
├── Mail/
│   └── OtpMail.php                          ← NEW
├── Models/
│   └── OtpCode.php                          ← NEW
├── Providers/
│   └── TwoFactorServiceProvider.php         ← NEW
└── Services/
    └── TwoFactor/
        └── OtpService.php                   ← NEW

bootstrap/
└── app.php                                  ← MODIFIED

config/
├── app.php                                  ← MODIFIED
└── twofactor.php                            ← NEW

database/
└── migrations/
    └── 2025_01_20_000001_create_otp_codes_table.php  ← NEW

lang/
├── en/
│   └── twofactor.php                        ← NEW
└── he/
    └── twofactor.php                        ← NEW

resources/
└── views/
    ├── auth/
    │   ├── login.blade.php                  ← MODIFIED
    │   └── two-factor-verify.blade.php      ← NEW
    ├── emails/
    │   └── otp.blade.php                    ← NEW
    └── layouts/
        └── sky_app.blade.php                ← MODIFIED

routes/
└── web.php                                  ← MODIFIED
```

### Step 2: Update .env on Live Server

Add these lines to your live server's `.env` file:

```env
# Two-Factor Authentication Settings
TWOFACTOR_ENABLED=true
TWOFACTOR_OTP_LENGTH=6
TWOFACTOR_OTP_EXPIRY=10
TWOFACTOR_MAX_ATTEMPTS=5
TWOFACTOR_RATE_LIMIT=10
TWOFACTOR_RESEND_COOLDOWN=60

# Remember Device
TWOFACTOR_REMEMBER_DEVICE=true
TWOFACTOR_REMEMBER_DAYS=30

# Email Settings (Hebrew)
TWOFACTOR_EMAIL_LOCALE=he
TWOFACTOR_EMAIL_DIRECTION=rtl
TWOFACTOR_SUBJECT_LOGIN="קוד אימות כניסה"

# Redirects
TWOFACTOR_REDIRECT_AFTER_VERIFY=/admin
TWOFACTOR_REDIRECT_ON_FAILURE=/login
```

### Step 3: Run on Live Server

```bash
# Run migration to create otp_codes table
php artisan migrate

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Or use optimize:clear
php artisan optimize:clear
```

---

## Complete File List for Upload

### Copy These 18 Files/Folders to Live Server:

```
1.  app/Console/Commands/CleanupExpiredOtps.php
2.  app/Http/Controllers/Auth/LoginController.php
3.  app/Http/Controllers/Auth/TwoFactorController.php
4.  app/Http/Middleware/RequiresTwoFactor.php
5.  app/Http/Middleware/TwoFactorVerified.php
6.  app/Mail/OtpMail.php
7.  app/Models/OtpCode.php
8.  app/Providers/TwoFactorServiceProvider.php
9.  app/Services/TwoFactor/OtpService.php
10. bootstrap/app.php
11. config/app.php
12. config/twofactor.php
13. database/migrations/2025_01_20_000001_create_otp_codes_table.php
14. lang/en/twofactor.php
15. lang/he/twofactor.php
16. resources/views/auth/login.blade.php
17. resources/views/auth/two-factor-verify.blade.php
18. resources/views/emails/otp.blade.php
19. resources/views/layouts/sky_app.blade.php
20. routes/web.php
```

---

## Detailed Changes in Each File

### 1. `app/Http/Controllers/Auth/LoginController.php`

**Changes:**
- Added `OtpService` injection in constructor
- Added `TwoFactorController` import
- Modified `authenticated()` method to:
  - Check if 2FA is enabled
  - Logout user while preserving session
  - Regenerate CSRF token (prevents 419 errors)
  - Generate and send OTP
  - Redirect to `/2fa/verify`
- Modified `logout()` method to clear 2FA session data

```php
// Key changes in authenticated() method:
protected function authenticated(Request $request, $user)
{
    if (config('twofactor.enabled', true) && !TwoFactorController::shouldBypass2FA($request, $user)) {
        $this->guard()->logout();
        session()->put(config('twofactor.session.user_id_key'), $user->id);
        $request->session()->regenerateToken(); // Prevents 419 error

        $result = $this->otpService->generateAndSend($user, OtpCode::PURPOSE_LOGIN, $request);
        // ... redirect to 2FA page
    }
}
```

### 2. `bootstrap/app.php`

**Changes:**
- Added middleware aliases for 2FA:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'twofactor.verified' => \App\Http\Middleware\TwoFactorVerified::class,
        'twofactor.pending' => \App\Http\Middleware\RequiresTwoFactor::class,
    ]);
})
```

### 3. `config/app.php`

**Changes:**
- Added TwoFactorServiceProvider to providers array:

```php
'providers' => ServiceProvider::defaultProviders()->merge([
    App\Providers\TwoFactorServiceProvider::class,
])->toArray(),
```

### 4. `routes/web.php`

**Changes:**
- Added 2FA routes:

```php
Route::prefix('2fa')->name('2fa.')->group(function () {
    Route::get('/verify', [TwoFactorController::class, 'showVerifyForm'])->name('verify');
    Route::post('/verify', [TwoFactorController::class, 'verify'])->name('verify.submit');
    Route::post('/resend', [TwoFactorController::class, 'resend'])->name('resend');
    Route::get('/cancel', [TwoFactorController::class, 'cancel'])->name('cancel');
});
```

### 5. `resources/views/layouts/sky_app.blade.php`

**Changes:**
- Added `@stack('scripts')` before closing `</body>` tag for JavaScript countdown timers

### 6. `resources/views/auth/login.blade.php`

**Changes:**
- Added session message displays for success, error, and info messages

---

## Configuration

All configuration options are in `config/twofactor.php`:

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| `enabled` | bool | true | Enable/disable 2FA globally |
| `otp_length` | int | 6 | Number of digits in OTP |
| `otp_expiry_minutes` | int | 10 | Minutes before OTP expires |
| `max_attempts` | int | 5 | Max verification attempts |
| `rate_limit_per_hour` | int | 5 | Max OTPs per user per hour |
| `resend_cooldown_seconds` | int | 60 | Seconds between resend requests |
| `remember_device.enabled` | bool | true | Allow device remembering |
| `remember_device.days` | int | 30 | Days to remember device |
| `exempt_roles` | array | [] | Roles that skip 2FA |
| `ip_whitelist` | array | [] | IPs that skip 2FA |

---

## Installation

### Fresh Installation

1. **Upload all files** listed above to your server

2. **Add environment variables to `.env`:**

```env
# Two-Factor Authentication Settings
TWOFACTOR_ENABLED=true
TWOFACTOR_OTP_LENGTH=6
TWOFACTOR_OTP_EXPIRY=10
TWOFACTOR_MAX_ATTEMPTS=5
TWOFACTOR_RATE_LIMIT=10
TWOFACTOR_RESEND_COOLDOWN=60
TWOFACTOR_REMEMBER_DEVICE=true
TWOFACTOR_REMEMBER_DAYS=30
TWOFACTOR_EMAIL_LOCALE=he
TWOFACTOR_EMAIL_DIRECTION=rtl
TWOFACTOR_SUBJECT_LOGIN="קוד אימות כניסה"
TWOFACTOR_REDIRECT_AFTER_VERIFY=/admin
TWOFACTOR_REDIRECT_ON_FAILURE=/login
```

3. **Run the migration:**

```bash
php artisan migrate
```

4. **Clear config cache:**

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

5. **Schedule OTP cleanup (optional but recommended):**

Add to `routes/console.php`:

```php
use Illuminate\Support\Facades\Schedule;

Schedule::command('otp:cleanup')->daily();
```

---

### Reusing in Another Project

Copy all files listed in the "Complete File List for Upload" section to your new project, then follow the installation steps above.

**Important:** Make sure to update the view's `@extends` directive in `two-factor-verify.blade.php` to match your layout.

---

## Usage

### Using OTP Service Directly

```php
use App\Services\TwoFactor\OtpService;
use App\Models\OtpCode;

class SomeController extends Controller
{
    public function __construct(protected OtpService $otpService) {}

    public function sendOtp(User $user)
    {
        $result = $this->otpService->generateAndSend(
            $user,
            OtpCode::PURPOSE_TRANSACTION
        );

        return response()->json($result);
    }

    public function verifyOtp(Request $request, User $user)
    {
        $result = $this->otpService->verify(
            $user->id,
            $request->input('otp'),
            OtpCode::PURPOSE_TRANSACTION
        );

        return response()->json($result);
    }
}
```

### Available OTP Purposes

```php
OtpCode::PURPOSE_LOGIN          // 'login'
OtpCode::PURPOSE_PASSWORD_RESET // 'password_reset'
OtpCode::PURPOSE_EMAIL_VERIFY   // 'email_verify'
OtpCode::PURPOSE_TRANSACTION    // 'transaction'
```

### Manual Cleanup

```bash
# Delete OTPs older than 7 days (default)
php artisan otp:cleanup

# Delete OTPs older than 14 days
php artisan otp:cleanup --days=14
```

---

## API Reference

### OtpService Methods

| Method | Parameters | Returns | Description |
|--------|------------|---------|-------------|
| `generate()` | User $user, string $purpose, ?Request $request | OtpCode | Generate new OTP |
| `send()` | OtpCode $otp, ?string $subject, ?string $template | bool | Send OTP email |
| `verify()` | int $userId, string $code, string $purpose | array | Verify OTP code |
| `generateAndSend()` | User $user, string $purpose, ?Request $request | array | Generate and send in one call |
| `resend()` | int $userId, string $purpose, ?Request $request | array | Resend OTP |
| `isRateLimited()` | int $userId | bool | Check rate limit status |
| `getRemainingTime()` | int $userId, string $purpose | ?int | Get OTP remaining seconds |
| `cleanup()` | int $olderThanDays | int | Delete expired OTPs |

### OtpCode Model Scopes

```php
OtpCode::forUser($userId)->get();
OtpCode::forPurpose('login')->get();
OtpCode::valid()->get();
OtpCode::expired()->get();
```

### TwoFactorController Static Methods

```php
TwoFactorController::isTrustedDevice($request, $user);
TwoFactorController::shouldBypass2FA($request, $user);
```

---

## Testing

### Manual Testing

1. Clear any existing session:
```bash
php artisan cache:clear
```

2. Login with valid credentials
3. Check email for OTP
4. Enter OTP on verification page
5. Verify redirect to admin dashboard

### Test Invalid OTP

1. Login with valid credentials
2. Enter wrong OTP code
3. Verify error message and attempt counter
4. After 5 wrong attempts, verify lockout

### Test OTP Expiry

1. Login with valid credentials
2. Wait 10+ minutes
3. Try to verify OTP
4. Verify expiry message

### Test Resend

1. Login and get to 2FA page
2. Wait 60 seconds
3. Click resend
4. Check email for new OTP

---

## Troubleshooting

### 419 Page Expired Error

This was fixed by adding CSRF token regeneration in LoginController:

```php
$request->session()->regenerateToken();
```

If you still see this error:
1. Clear all caches: `php artisan optimize:clear`
2. Check session driver is working
3. Verify session table exists (if using database driver)

### OTP Email Not Sending

1. Check mail configuration in `.env`
2. Test mail manually:
```php
Mail::raw('Test', fn($m) => $m->to('test@example.com')->subject('Test'));
```
3. Check Laravel logs: `storage/logs/laravel.log`

### Session Issues

1. Ensure session driver is configured
2. Check session table exists (if using database driver)
3. Clear session: `php artisan session:flush`

### 2FA Not Triggering

1. Verify `TWOFACTOR_ENABLED=true` in `.env`
2. Check if user role is in exempt list
3. Check if IP is in whitelist
4. Check if device is trusted (clear cookies)

### Rate Limit Issues

1. Check `otp_codes` table for user's OTP count
2. Clear old OTPs: `php artisan otp:cleanup --days=0`
3. Increase rate limit in config

---

## Database Table Structure

The `otp_codes` table:

```sql
CREATE TABLE otp_codes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    email VARCHAR(255) NOT NULL,
    otp_code VARCHAR(10) NOT NULL,
    purpose VARCHAR(50) DEFAULT 'login',
    is_verified BOOLEAN DEFAULT FALSE,
    expires_at TIMESTAMP NOT NULL,
    attempts INT DEFAULT 0,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    INDEX (user_id),
    INDEX (otp_code),
    INDEX (purpose),
    INDEX (expires_at)
);
```

---

## Security Considerations

1. **OTP codes are stored in plain text** - They're short-lived and single-use
2. **Always use HTTPS** in production
3. **Configure proper email security** (SPF, DKIM, DMARC)
4. **Monitor logs** for suspicious activity
5. **Set reasonable expiry times** - Don't exceed 15 minutes
6. **Enable rate limiting** to prevent abuse
7. **Use secure session configuration**

---

## Quick Deployment Checklist

- [ ] Upload all 20 files listed above
- [ ] Add TWOFACTOR_* variables to `.env`
- [ ] Run `php artisan migrate`
- [ ] Run `php artisan optimize:clear`
- [ ] Test login flow with 2FA
- [ ] Verify OTP emails are being sent
- [ ] Test OTP verification
- [ ] Test resend functionality
- [ ] Test cancel/back to login

---

## Support

For issues or questions, contact the development team.

---

*Last Updated: January 2025*


