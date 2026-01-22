# User Data Encryption Documentation

## Overview

This document describes the encryption system implemented for protecting sensitive user data (`name` and `email` fields) in the database. The encryption uses Laravel's built-in encryption which relies on the `APP_KEY` from the `.env` file.

---

## Table of Contents

1. [How It Works](#how-it-works)
2. [New Files Created](#new-files-created)
3. [Modified Files](#modified-files)
4. [Database Changes](#database-changes)
5. [Encryption Process](#encryption-process)
6. [Decryption Process](#decryption-process)
7. [Authentication Flow](#authentication-flow)
8. [Artisan Commands](#artisan-commands)
9. [Important Notes](#important-notes)
10. [Troubleshooting](#troubleshooting)

---

## How It Works

### Encryption Method
- Uses Laravel's `Crypt::encryptString()` which implements AES-256-CBC encryption
- The encryption key is derived from `APP_KEY` in `.env` file
- Each encrypted value includes an IV (Initialization Vector) for security
- Encrypted data is stored as base64-encoded JSON containing: `iv`, `value`, `mac`

### Key Slot Tracking
- The `encryption_key_slot` column stores the **FULL APP_KEY** (e.g., `base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=`)
- This allows tracking exactly which key was used to encrypt the data
- Column size: VARCHAR(100) to accommodate the full key
- Useful for key rotation scenarios and data recovery

---

## New Files Created

### 1. `app/Services/EncryptionService.php`
**Purpose:** Central service for all encryption/decryption operations.

**Methods:**
| Method | Description |
|--------|-------------|
| `encrypt($value)` | Encrypts a string value |
| `decrypt($value)` | Decrypts an encrypted value |
| `isEncrypted($value)` | Checks if a value is already encrypted |
| `encryptIfNotEncrypted($value)` | Encrypts only if not already encrypted |
| `getCurrentKeySlot()` | Returns current APP_KEY identifier |
| `encryptAttributes($data, $attributes)` | Encrypts multiple attributes in an array |
| `decryptAttributes($data, $attributes)` | Decrypts multiple attributes in an array |

**Usage Example:**
```php
use App\Services\EncryptionService;

$encryptionService = app(EncryptionService::class);

// Encrypt
$encrypted = $encryptionService->encrypt('sensitive data');

// Decrypt
$decrypted = $encryptionService->decrypt($encrypted);

// Check if encrypted
if ($encryptionService->isEncrypted($value)) {
    // Already encrypted
}
```

---

### 2. `app/Traits/Encryptable.php`
**Purpose:** Trait for automatic encryption/decryption on Eloquent models.

**How It Works:**
- Hooks into Eloquent's `saving` event to encrypt before save
- Hooks into Eloquent's `retrieved` event to decrypt after retrieval
- Automatically manages `encryption_key_slot`

**Usage in Model:**
```php
use App\Traits\Encryptable;

class User extends Authenticatable
{
    use Encryptable;

    protected $encryptable = ['name', 'email'];
}
```

---

### 3. `app/Auth/EncryptedUserProvider.php`
**Purpose:** Custom authentication provider that handles login with encrypted email.

**How It Works:**
- Extends Laravel's `EloquentUserProvider`
- Overrides `retrieveByCredentials()` method
- Fetches all users matching other criteria, then decrypts email to find match
- Allows users to login with plaintext email while email is encrypted in database

---

### 4. `app/Console/Commands/EncryptExistingUsers.php`
**Purpose:** Artisan command to encrypt/decrypt existing user data.

**Commands:**
```bash
# Encrypt all users
php artisan users:encrypt

# Decrypt all users
php artisan users:encrypt --decrypt

# Preview changes (dry run)
php artisan users:encrypt --dry-run
```

---

### 5. `database/migrations/2025_01_20_100000_add_encryption_columns_to_users_table.php`
**Purpose:** Database migration for encryption support.

**Changes Made:**
- Drops unique index on `email` column (TEXT columns cannot have unique index)
- Changes `name` column from VARCHAR(191) to TEXT
- Changes `email` column from VARCHAR(191) to TEXT
- Adds `encryption_key_slot` column (VARCHAR(100), nullable) - stores full APP_KEY

---

## Modified Files

### 1. `app/User.php`
**Changes:**
- Added `use App\Traits\Encryptable;`
- Added `use App\Services\EncryptionService;`
- Added `protected $encryptable = ['name', 'email'];`
- Added `encryption_key_slot` to `$fillable`
- Updated `get_all_users()` to decrypt name/email after DB query
- Updated `get_user($id)` to decrypt name/email after DB query

**Before:**
```php
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'status'];
}
```

**After:**
```php
class User extends Authenticatable
{
    use Notifiable, Encryptable;

    protected $encryptable = ['name', 'email'];

    protected $fillable = ['name', 'email', 'password', 'role', 'status', 'encryption_key_slot'];
}
```

---

### 2. `app/Models/User.php`
**Changes:**
- Added `use App\Traits\Encryptable;`
- Added `protected $encryptable = ['name', 'email'];`
- Added `encryption_key_slot` to `$fillable`

---

### 3. `app/Http/Controllers/UsersController.php`
**Changes:**
- Added `use App\Services\EncryptionService;`
- Added `private EncryptionService $encryptionService;` property
- Updated constructor to inject `EncryptionService`
- Updated `create_user()` to encrypt name/email before insert
- Updated `edit_user()` form_type 1 to encrypt name before update
- Updated `edit_user()` form_type 2 to encrypt email before update

**Key Code Changes:**

```php
// Constructor - added EncryptionService injection
public function __construct(User $user, EncryptionService $encryptionService)
{
    $this->middleware('auth');
    $this->user = $user;
    $this->encryptionService = $encryptionService;
}

// create_user() - encrypt before insert
$encryptedName = $this->encryptionService->encrypt($name);
$encryptedEmail = $this->encryptionService->encrypt($request->email);

$id = User::insertGetId([
    'name' => $encryptedName,
    'email' => $encryptedEmail,
    'encryption_key_slot' => $this->encryptionService->getCurrentKeySlot(),
    // ... other fields
]);

// edit_user() form_type 1 - encrypt name
$encryptedName = $this->encryptionService->encrypt($name);
DB::table('users')->where('id', $id)->update([
    'name' => $encryptedName,
    'encryption_key_slot' => $this->encryptionService->getCurrentKeySlot()
]);

// edit_user() form_type 2 - encrypt email
$encryptedEmail = $this->encryptionService->encrypt($request->email);
DB::table('users')->where('id', $id)->update([
    'email' => $encryptedEmail,
    'encryption_key_slot' => $this->encryptionService->getCurrentKeySlot()
]);
```

---

### 4. `app/Providers/AuthServiceProvider.php`
**Changes:**
- Added `use App\Auth\EncryptedUserProvider;`
- Added `use Illuminate\Support\Facades\Auth;`
- Registered custom `encrypted` auth provider in `boot()` method

**Code Added:**
```php
public function boot()
{
    $this->registerPolicies();

    Auth::provider('encrypted', function ($app, array $config) {
        return new EncryptedUserProvider(
            $app['hash'],
            $config['model']
        );
    });
}
```

---

### 5. `config/auth.php`
**Changes:**
- Changed user provider driver from `eloquent` to `encrypted`

**Before:**
```php
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
],
```

**After:**
```php
'providers' => [
    'users' => [
        'driver' => 'encrypted',
        'model' => App\Models\User::class,
    ],
],
```

---

## Database Changes

### Users Table Structure (After Migration)

| Column | Type | Description |
|--------|------|-------------|
| id | BIGINT | Primary key |
| name | TEXT | Encrypted user name |
| email | TEXT | Encrypted user email |
| role | VARCHAR(110) | User roles (comma-separated) |
| email_verified_at | TIMESTAMP | Email verification timestamp |
| password | VARCHAR(191) | Hashed password |
| remember_token | VARCHAR(100) | Session remember token |
| created_at | TIMESTAMP | Created timestamp |
| updated_at | TIMESTAMP | Updated timestamp |
| status | VARCHAR(10) | User status |
| **encryption_key_slot** | VARCHAR(100) | Full APP_KEY stored here (NEW) |

### Example Encrypted Data

**In Database:**
```
name: eyJpdiI6IjMrbU9YTnRFdFV5NkdlL0FldG5SM3c9PSIsInZhbHVlIjoiemtiUlZGdFgyVDQ0bEpJRmsy...
email: eyJpdiI6IjJPbWFNR3lSRjZ3TkFuOGpGMmNrM3c9PSIsInZhbHVlIjoiNkFNdW13d2M2U0l2ZFl4L0NM...
encryption_key_slot: base64:0d5rHySL+4qGT7UQfUTmQECLid5ZYErZ0t3JpyRONus=
```

**After Decryption (in application):**
```
name: John Doe
email: john@example.com
```

---

## Encryption Process

### Flow Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│                    ENCRYPTION FLOW                               │
├─────────────────────────────────────────────────────────────────┤
│                                                                  │
│  User Input (plaintext)                                         │
│       │                                                          │
│       ▼                                                          │
│  ┌─────────────────────┐                                        │
│  │ EncryptionService   │                                        │
│  │ ->encrypt($value)   │                                        │
│  └─────────────────────┘                                        │
│       │                                                          │
│       ▼                                                          │
│  ┌─────────────────────┐                                        │
│  │ Laravel Crypt       │  Uses APP_KEY from .env                │
│  │ ::encryptString()   │  AES-256-CBC encryption                │
│  └─────────────────────┘                                        │
│       │                                                          │
│       ▼                                                          │
│  Base64 encoded JSON: {iv, value, mac}                          │
│       │                                                          │
│       ▼                                                          │
│  ┌─────────────────────┐                                        │
│  │ Database Storage    │  Stored as TEXT                        │
│  │ (encrypted data)    │  + encryption_key_slot                 │
│  └─────────────────────┘                                        │
│                                                                  │
└─────────────────────────────────────────────────────────────────┘
```

### When Encryption Happens

1. **Eloquent Model Save** - Automatic via `Encryptable` trait
2. **Direct DB Insert** - Manual in `UsersController::create_user()`
3. **Direct DB Update** - Manual in `UsersController::edit_user()`
4. **Artisan Command** - `php artisan users:encrypt`

---

## Decryption Process

### Flow Diagram

```
┌─────────────────────────────────────────────────────────────────┐
│                    DECRYPTION FLOW                               │
├─────────────────────────────────────────────────────────────────┤
│                                                                  │
│  Database (encrypted data)                                      │
│       │                                                          │
│       ▼                                                          │
│  ┌─────────────────────┐                                        │
│  │ EncryptionService   │                                        │
│  │ ->decrypt($value)   │                                        │
│  └─────────────────────┘                                        │
│       │                                                          │
│       ▼                                                          │
│  ┌─────────────────────┐                                        │
│  │ Laravel Crypt       │  Uses APP_KEY from .env                │
│  │ ::decryptString()   │  Verifies MAC, decrypts                │
│  └─────────────────────┘                                        │
│       │                                                          │
│       ▼                                                          │
│  Plaintext value returned to application                        │
│                                                                  │
└─────────────────────────────────────────────────────────────────┘
```

### When Decryption Happens

1. **Eloquent Model Retrieved** - Automatic via `Encryptable` trait
2. **Static Methods** - Manual in `User::get_all_users()` and `User::get_user()`
3. **Authentication** - In `EncryptedUserProvider::retrieveByCredentials()`
4. **Artisan Command** - `php artisan users:encrypt --decrypt`

---

## Authentication Flow

```
┌─────────────────────────────────────────────────────────────────┐
│                 AUTHENTICATION WITH ENCRYPTED EMAIL              │
├─────────────────────────────────────────────────────────────────┤
│                                                                  │
│  1. User enters email + password on login form                  │
│       │                                                          │
│       ▼                                                          │
│  2. LoginController sends credentials to Auth                   │
│       │                                                          │
│       ▼                                                          │
│  3. EncryptedUserProvider::retrieveByCredentials()              │
│       │                                                          │
│       ├──► Fetches all users with status=1                      │
│       │                                                          │
│       ├──► For each user:                                       │
│       │      - Decrypt stored email                             │
│       │      - Compare with input email (case-insensitive)      │
│       │                                                          │
│       ├──► If match found, return User model                    │
│       │                                                          │
│       ▼                                                          │
│  4. Auth validates password against user                        │
│       │                                                          │
│       ▼                                                          │
│  5. User authenticated successfully                             │
│                                                                  │
└─────────────────────────────────────────────────────────────────┘
```

---

## Artisan Commands

### Encrypt Existing Users

```bash
# Encrypt all users (production)
php artisan users:encrypt

# Preview what would be encrypted (dry run)
php artisan users:encrypt --dry-run
```

**Output:**
```
Encrypting user data...
 4/4 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

Summary:
  Processed: 4
  Skipped (already encrypted): 0

Encryption complete!
```

### Decrypt Users (If Needed)

```bash
# Decrypt all users
php artisan users:encrypt --decrypt

# Preview decryption
php artisan users:encrypt --decrypt --dry-run
```

---

## Important Notes

### 1. APP_KEY Security
- **NEVER** change the `APP_KEY` after encrypting data
- If APP_KEY is changed, all encrypted data becomes unreadable
- Always backup APP_KEY securely

### 2. Backup Before Migration
```bash
# Backup database before running encryption
mysqldump -u username -p database_name users > users_backup.sql
```

### 3. Email Uniqueness
- The unique index on email was removed (TEXT columns can't have unique index)
- Duplicate email validation must be handled in application code
- The `EncryptedUserProvider` handles email lookup correctly

### 4. Search Limitations
- LIKE queries on encrypted fields will NOT work
- `autocomplete()` and `findUsersByTxt()` methods in UsersController need modification if searching encrypted data
- Consider adding a separate searchable hash if search is required

### 5. Performance Considerations
- Authentication requires decrypting emails of all active users to find match
- For large user bases, consider adding an email hash column for faster lookups

---

## Troubleshooting

### Issue: Decryption Failed Error
**Cause:** APP_KEY was changed after encryption
**Solution:** Restore the original APP_KEY from backup

### Issue: Login Not Working
**Cause:** Custom provider not registered
**Solution:** Verify `config/auth.php` has `'driver' => 'encrypted'`

### Issue: Data Shows as Encrypted in Views
**Cause:** Direct DB query without decryption
**Solution:** Use Eloquent models or manually decrypt with EncryptionService

### Issue: Migration Failed - Column Already Exists
**Solution:** Run `php artisan migrate:status` to check, then manually fix or rollback

### Testing Encryption
```bash
php artisan tinker

# Check if data is encrypted in DB
$user = DB::table('users')->first();
echo $user->name; // Should show encrypted string

# Check if decryption works via Model
$user = App\User::first();
echo $user->name; // Should show decrypted name
```

---

## File Summary

| File | Status | Purpose |
|------|--------|---------|
| `app/Services/EncryptionService.php` | NEW | Encryption/decryption service |
| `app/Traits/Encryptable.php` | NEW | Model trait for auto encryption |
| `app/Auth/EncryptedUserProvider.php` | NEW | Custom auth provider |
| `app/Console/Commands/EncryptExistingUsers.php` | NEW | Artisan command |
| `database/migrations/2025_01_20_100000_...` | NEW | Initial database migration |
| `database/migrations/2025_01_20_100001_...` | NEW | Increase key_slot column size |
| `app/User.php` | MODIFIED | Added encryption trait |
| `app/Models/User.php` | MODIFIED | Added encryption trait |
| `app/Http/Controllers/UsersController.php` | MODIFIED | Manual encryption |
| `app/Providers/AuthServiceProvider.php` | MODIFIED | Register provider |
| `config/auth.php` | MODIFIED | Use encrypted driver |

---

## Version History

| Version | Date | Changes |
|---------|------|---------|
| 1.0.0 | 2025-01-20 | Initial encryption implementation |
| 1.1.0 | 2025-01-20 | Store full APP_KEY instead of hash in encryption_key_slot |

---

*Document created: January 20, 2025*
```bash

php artisan users:encrypt           # Encrypt all users
php artisan users:encrypt --decrypt # Decrypt all users
php artisan users:encrypt --dry-run # Preview changes
```

## New: Applications and File metadata encryption commands

Two new Artisan commands were added to handle encryption for `applications` and `apps_file` tables.

Usage (dry-run first):

```bash
# Preview encrypting applications.email (no changes made)
php artisan applications:encrypt --dry-run

# Actually encrypt applications.email
php artisan applications:encrypt

# Preview decrypting applications.email
php artisan applications:encrypt --decrypt --dry-run

# Decrypt applications.email (restores plaintext)
php artisan applications:encrypt --decrypt
```

```bash
# Preview encrypting apps_file.url and apps_file.file_name
php artisan appsfile:encrypt --dry-run

# Actually encrypt apps_file.url and apps_file.file_name
php artisan appsfile:encrypt

# Preview decrypting apps_file entries
php artisan appsfile:encrypt --decrypt --dry-run

# Decrypt apps_file entries (restores plaintext url/file_name)
php artisan appsfile:encrypt --decrypt
```

Notes on running the commands safely
- Always run with `--dry-run` first and inspect the output. The commands will report Processed/Skipped counts.
- Make a full database backup before running the commands without `--dry-run`.
- Run these commands in a staging environment first to verify application behavior (file listing, downloads, decision flows).

Sample dry-run output (what you should expect):

```
Encrypting applications.email field...
DRY RUN MODE - No changes will be made
 0/3 [░░░░░░░░░░░░░░░░░░░░░░░░░░░░]   0%
 3/3 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

Applications Summary:
    Processed: 3
    Skipped (already encrypted): 0

Dry run complete. Run without --dry-run to apply changes.
```

And for `appsfile:encrypt --dry-run`:

```
Encrypting apps_file table (url, file_name)...
DRY RUN MODE - No changes will be made
    0/70 [░░░░░░░░░░░░░░░░░░░░░░░░░░░░]   0%
 70/70 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

Apps_file Summary:
    Processed: 70
    Skipped (already encrypted): 0

Dry run complete. Run without --dry-run to apply changes.
```

If you want help adding a deterministic hash column for efficient DB queries (recommended for large data sets), see the `Optional` section below.
