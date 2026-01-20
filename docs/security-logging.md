# Security Activity Logging System

## Overview

This document describes the Security Activity Logging System implemented in the Laravel 11 tender management application. The system provides comprehensive logging of security-related events including login attempts, file downloads, and permission changes.

---

## Table of Contents

1. [Architecture](#architecture)
2. [File Structure](#file-structure)
3. [Log File Organization](#log-file-organization)
4. [Log Format Specification](#log-format-specification)
5. [Components](#components)
   - [SecurityLogger Class](#securitylogger-class)
   - [ActivityLogger Middleware](#activitylogger-middleware)
   - [Helper Functions](#helper-functions)
   - [SecurityLogController](#securitylogcontroller)
6. [Routes](#routes)
7. [Usage Examples](#usage-examples)
8. [Configuration](#configuration)
9. [Access Control](#access-control)
10. [Troubleshooting](#troubleshooting)

---

## Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                        HTTP Request                              │
└─────────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────────┐
│                   ActivityLogger Middleware                      │
│  ┌─────────────┐  ┌─────────────┐  ┌──────────────────────┐    │
│  │Login Detect │  │Download     │  │Permission Change     │    │
│  │             │  │Detect       │  │Detect                │    │
│  └─────────────┘  └─────────────┘  └──────────────────────┘    │
└─────────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────────┐
│                    security_log() Helper                         │
│            Formats log entry with timestamp & data               │
└─────────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────────┐
│                    SecurityLogger Class                          │
│         Creates month/date folder structure                      │
│         Writes to: storage/logs/security/YYYY-MM/YYYY-MM-DD.log │
└─────────────────────────────────────────────────────────────────┘
```

---

## File Structure

```
app/
├── Helper/
│   └── Helper.php                    # Contains security_log() helper
├── Http/
│   ├── Controllers/
│   │   └── SecurityLogController.php # Controller for log management
│   └── Middleware/
│       └── ActivityLogger.php        # Activity detection middleware
└── Logging/
    └── SecurityLogger.php            # Custom Monolog logger

config/
└── logging.php                       # Contains 'security' channel config

bootstrap/
└── app.php                           # Middleware registration

routes/
└── web.php                           # Security log routes

resources/views/admin/
├── security-logs.blade.php           # Log listing view
└── security-log-view.blade.php       # Single log view

storage/logs/security/                # Log files directory
├── 2026-01/
│   ├── 2026-01-18.log
│   ├── 2026-01-19.log
│   └── 2026-01-20.log
└── 2026-02/
    └── ...
```

---

## Log File Organization

### Directory Structure

Logs are organized by **month** and **date**:

```
storage/logs/security/
├── 2026-01/                    # January 2026
│   ├── 2026-01-01.log          # Daily log file
│   ├── 2026-01-02.log
│   └── ...
├── 2026-02/                    # February 2026
│   └── ...
└── YYYY-MM/                    # Year-Month folder
    └── YYYY-MM-DD.log          # Daily log file
```

### Benefits

- **Easy archival**: Monthly folders can be archived or deleted easily
- **Quick access**: Find logs by date without searching through large files
- **Storage management**: Monitor disk usage by month
- **Compliance**: Retain logs for specific periods as required

---

## Log Format Specification

### Standard Format

```
YYYY-MM-DD HH:MM:SS | LEVEL | ACTION             | key1=value1 | key2=value2 | ...
```

### Field Specifications

| Field     | Width | Description                                      |
|-----------|-------|--------------------------------------------------|
| Timestamp | 19    | Format: `YYYY-MM-DD HH:MM:SS`                    |
| Separator | 3     | ` \| `                                           |
| Level     | 5     | Padded: `INFO `, `WARN `, `ERROR`, `DEBUG`       |
| Separator | 3     | ` \| `                                           |
| Action    | 18    | Padded action type                               |
| Data      | Var   | Key-value pairs separated by ` \| `              |

### Log Levels

| Level   | Usage                                           |
|---------|-------------------------------------------------|
| `INFO`  | Successful operations (login, download)         |
| `WARN`  | Failed attempts, suspicious activity            |
| `ERROR` | System errors, security violations              |
| `DEBUG` | Detailed debugging information                  |

### Action Types

| Action              | Description                              |
|---------------------|------------------------------------------|
| `LOGIN_ATTEMPT`     | User login attempt (success or failure)  |
| `DOWNLOAD_FILE`     | File download operation                  |
| `CHANGE_PERMISSIONS`| User permission modification             |

### Example Log Entries

```
2026-01-18 10:15:32 | INFO  | LOGIN_ATTEMPT      | user=admin@example.com | ip=192.168.1.45 | success=true
2026-01-18 10:16:05 | WARN  | LOGIN_ATTEMPT      | user=user@example.com | ip=192.168.1.45 | success=false | reason=INVALID_CREDENTIALS
2026-01-18 10:20:10 | INFO  | DOWNLOAD_FILE      | user=user_123 | ip=192.168.1.45 | file=contract.pdf
2026-01-18 10:25:44 | INFO  | CHANGE_PERMISSIONS | user=admin_001 | ip=192.168.1.50 | target=user_456 | from=NONE | to=READ,WRITE
```

---

## Components

### SecurityLogger Class

**File**: `app/Logging/SecurityLogger.php`

Custom Monolog logger that creates the month/date folder structure automatically.

```php
<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Illuminate\Support\Facades\File;

class SecurityLogger
{
    public function __invoke(array $config): Logger
    {
        // Creates: storage/logs/security/YYYY-MM/YYYY-MM-DD.log
        $date = now();
        $monthFolder = $date->format('Y-m');
        $dailyFile = $date->format('Y-m-d') . '.log';

        $logPath = storage_path("logs/security/{$monthFolder}");

        if (!File::isDirectory($logPath)) {
            File::makeDirectory($logPath, 0755, true);
        }

        $fullPath = "{$logPath}/{$dailyFile}";

        $logger = new Logger('security');
        $handler = new StreamHandler($fullPath, Logger::DEBUG);
        $formatter = new LineFormatter("%message%\n", null, true, true);
        $handler->setFormatter($formatter);
        $logger->pushHandler($handler);

        return $logger;
    }
}
```

### ActivityLogger Middleware

**File**: `app/Http/Middleware/ActivityLogger.php`

Automatically detects and logs security-related activities.

#### Detection Rules

**Login Attempts**:
- POST requests to `/login` route
- Route name: `login`

**File Downloads**:
- Routes containing `download` in URI
- Route names: `file.download`, `template.download`, `tenderListExcelDownload`
- URIs matching: `*download*`, `*export*`, `*cvfiledownload*`

**Permission Changes**:
- POST/PUT/PATCH requests to user management routes
- URIs matching: `admin/users/edit-user/*`, `admin/users/create-user`

### Helper Functions

**File**: `app/Helper/Helper.php`

#### security_log()

Main function for logging security events.

```php
function security_log(string $level, string $action, array $data = []): void
```

**Parameters**:
- `$level`: Log level (`INFO`, `WARN`, `ERROR`, `DEBUG`)
- `$action`: Action type (`LOGIN_ATTEMPT`, `DOWNLOAD_FILE`, `CHANGE_PERMISSIONS`)
- `$data`: Associative array of key-value pairs to log

**Example**:
```php
security_log('INFO', 'LOGIN_ATTEMPT', [
    'user' => 'admin@example.com',
    'ip' => '192.168.1.100',
    'success' => 'true'
]);
```

#### get_security_log_path()

Returns the full path to today's log file.

```php
function get_security_log_path(): string
```

**Returns**: `storage/logs/security/2026-01/2026-01-20.log`

#### get_security_log_directory()

Returns the directory path for a specific month.

```php
function get_security_log_directory(?string $month = null): string
```

**Parameters**:
- `$month`: Optional. Format `Y-m` (e.g., `2026-01`). Defaults to current month.

### SecurityLogController

**File**: `app/Http/Controllers/SecurityLogController.php`

#### Methods

| Method     | Route                          | Description                    |
|------------|--------------------------------|--------------------------------|
| `index()`  | GET `/admin/security-log`      | List all available log files   |
| `download()`| GET `/admin/security-log/download` | Download log file         |
| `show()`   | GET `/admin/security-log/view/{date}` | View log content       |

---

## Routes

### Available Routes

| Method | URI                              | Name                  | Description            |
|--------|----------------------------------|-----------------------|------------------------|
| GET    | `/admin/security-log`            | `security-log.index`  | List log files         |
| GET    | `/admin/security-log/download`   | `security-log.download` | Download log file    |
| GET    | `/admin/security-log/view/{date}`| `security-log.show`   | View log content       |

### Query Parameters

**Download Route**:
- `date`: Date in `Y-m-d` format (e.g., `2026-01-20`)

**Example URLs**:
```
/admin/security-log
/admin/security-log/download?date=2026-01-20
/admin/security-log/view/2026-01-20
```

---

## Usage Examples

### Manual Logging

#### Log a Successful Login
```php
security_log('INFO', 'LOGIN_ATTEMPT', [
    'user' => $user->email,
    'ip' => request()->ip(),
    'success' => 'true'
]);
```

#### Log a Failed Login
```php
security_log('WARN', 'LOGIN_ATTEMPT', [
    'user' => $request->email,
    'ip' => request()->ip(),
    'success' => 'false',
    'reason' => 'INVALID_PASSWORD'
]);
```

#### Log a File Download
```php
security_log('INFO', 'DOWNLOAD_FILE', [
    'user' => "user_{$user->id}",
    'ip' => request()->ip(),
    'file' => $fileName
]);
```

#### Log a Permission Change
```php
security_log('INFO', 'CHANGE_PERMISSIONS', [
    'user' => "admin_{$adminId}",
    'ip' => request()->ip(),
    'target' => "user_{$targetUserId}",
    'from' => $oldPermissions,
    'to' => $newPermissions
]);
```

### Custom Security Events

```php
// Log suspicious activity
security_log('WARN', 'SUSPICIOUS_ACTIVITY', [
    'user' => "user_{$userId}",
    'ip' => request()->ip(),
    'reason' => 'Multiple failed attempts',
    'attempts' => '5'
]);

// Log system error
security_log('ERROR', 'SECURITY_ERROR', [
    'user' => 'system',
    'ip' => request()->ip(),
    'error' => 'Token validation failed'
]);
```

---

## Configuration

### Logging Channel

**File**: `config/logging.php`

```php
'channels' => [
    // ... other channels

    'security' => [
        'driver' => 'custom',
        'via' => \App\Logging\SecurityLogger::class,
    ],
],
```

### Middleware Registration

**File**: `bootstrap/app.php`

```php
->withMiddleware(function (Middleware $middleware) {
    // ... other middleware

    // Append ActivityLogger to the web middleware group
    $middleware->appendToGroup('web', \App\Http\Middleware\ActivityLogger::class);
})
```

---

## Access Control

### Who Can Access Security Logs?

The `SecurityLogController` implements access control in the `canAccessSecurityLogs()` method:

1. **Admin Role (user_role = 4)**: Full access
2. **Users with `security_logs` permission**: Full access
3. **Users with `admin` permission**: Full access

### Modifying Access Control

Edit `app/Http/Controllers/SecurityLogController.php`:

```php
protected function canAccessSecurityLogs($user): bool
{
    // Add your custom access control logic here

    // Example: Check for specific permission
    $permissions = explode(',', $user->role ?? '');
    return in_array('security_logs', $permissions);
}
```

---

## Troubleshooting

### Common Issues

#### 1. Log Files Not Being Created

**Symptoms**: No files in `storage/logs/security/`

**Solutions**:
1. Check directory permissions:
   ```bash
   chmod -R 775 storage/logs
   chown -R www-data:www-data storage/logs
   ```

2. Verify the security channel is configured:
   ```bash
   php artisan config:clear
   ```

3. Test manually:
   ```php
   security_log('INFO', 'TEST', ['message' => 'test']);
   ```

#### 2. Middleware Not Logging

**Symptoms**: Activities not being logged automatically

**Solutions**:
1. Verify middleware is registered in `bootstrap/app.php`
2. Clear route cache:
   ```bash
   php artisan route:clear
   ```

3. Check if the route matches detection patterns in `ActivityLogger.php`

#### 3. Permission Denied on Download

**Symptoms**: 403 error when accessing security logs

**Solutions**:
1. Verify user has admin role or `security_logs` permission
2. Check `canAccessSecurityLogs()` method logic
3. Ensure user is authenticated

#### 4. Helper Function Not Found

**Symptoms**: `Call to undefined function security_log()`

**Solutions**:
1. Run composer dump-autoload:
   ```bash
   composer dump-autoload
   ```

2. Verify `app/Helper/Helper.php` is in composer.json:
   ```json
   "autoload": {
       "files": [
           "app/Helper/Helper.php"
       ]
   }
   ```

### Maintenance Commands

```bash
# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Regenerate autoload
composer dump-autoload

# Check log directory permissions
ls -la storage/logs/security/

# View recent logs
tail -f storage/logs/security/$(date +%Y-%m)/$(date +%Y-%m-%d).log
```

---

## Security Considerations

1. **Log Sanitization**: User inputs are sanitized before logging to prevent log injection
2. **Access Control**: Only authorized users can view/download logs
3. **Sensitive Data**: Passwords and tokens are never logged
4. **IP Tracking**: All activities include the client IP address
5. **Timestamps**: All entries include precise timestamps for audit trails

---

## Extending the System

### Adding New Action Types

1. Add detection logic in `ActivityLogger.php`
2. Create appropriate log format
3. Update documentation

### Custom Log Handlers

Create a new handler that extends `SecurityLogger`:

```php
namespace App\Logging;

class AlertSecurityLogger extends SecurityLogger
{
    public function __invoke(array $config): Logger
    {
        $logger = parent::__invoke($config);

        // Add email alerts for WARN/ERROR levels
        $mailHandler = new \Monolog\Handler\NativeMailerHandler(
            'security@example.com',
            'Security Alert',
            'system@example.com'
        );
        $mailHandler->setLevel(Logger::WARNING);
        $logger->pushHandler($mailHandler);

        return $logger;
    }
}
```

---

## Version History

| Version | Date       | Changes                                    |
|---------|------------|--------------------------------------------|
| 1.0.0   | 2026-01-20 | Initial implementation                     |

---

## Support

For issues or questions regarding this security logging system, please contact the development team or create an issue in the project repository.
