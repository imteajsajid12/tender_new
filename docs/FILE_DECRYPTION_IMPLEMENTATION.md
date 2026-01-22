# File Decryption Implementation - Testing Guide

## Overview
This document describes the implementation of file name decryption for the security logging system and file display on the application view page.

## Changes Made

### 1. Security Logging Helper Function (`app/Helper/Helper.php`)
**What was changed:**
- Added automatic decryption of the `file` parameter in the `security_log()` function
- The function now checks if the file name is encrypted before logging
- If encrypted, it decrypts it before writing to the security log

**Impact:**
- All security logs showing file access will now display the actual file name instead of the encrypted value
- Applies to both `DOWNLOAD_FILE` and any other action that logs file names

### 2. TendersController - logFileAccess Method
**What was changed:**
- Added file name decryption before logging
- The method now decrypts the file name received from the request before passing it to `security_log()`

**Impact:**
- AJAX calls to log file access will now log the decrypted file name

### 3. TendersController - secureFileDownload Method
**What was changed:**
- Added file name decryption specifically for logging purposes
- The actual file download still works with encrypted file names (for security)
- Only the log entry shows the decrypted file name

**Impact:**
- Secure file downloads will be logged with human-readable file names

### 4. TendersController - viewapplication Method
**What was changed:**
- Added a loop to decrypt all file names and URLs in the `$afiles` array before passing to the view
- This ensures all files displayed on the application view page show their actual names

**Impact:**
- The application view page at `/admin/tenders/application/{id}` now shows decrypted file names
- File URLs are also decrypted so downloads work correctly

## Testing Instructions

### Test 1: View Application Page
**URL:** `http://localhost:8000/admin/tenders/application/374`

**What to check:**
1. Navigate to the application view page
2. Look at the "מסמכים לצירוף" (Documents to Attach) section
3. Verify that file names are displayed in readable format (not encrypted strings)
4. Example: Should see something like `form.pdf` or `CV_John_Doe.pdf` instead of `eyJpdiI6IkpjSDBVYS9IVWxkMEFlYThsWHV2cEE9PSIsInZhbHVl...`

**Expected Result:**
- All file names should be human-readable
- No base64-encoded strings should be visible to the user
- Files should still be clickable and downloadable

### Test 2: Security Log File Access
**URL:** `http://localhost:8000/admin/users` (or any page that accesses files)

**What to check:**
1. Navigate to a page that displays or downloads files
2. View or download a file
3. Check the security log file at `storage/logs/security/YYYY-MM/YYYY-MM-DD.log`
4. Look for entries with action `DOWNLOAD_FILE`

**Expected Log Format:**
```
2026-01-22 14:30:45 | INFO  | DOWNLOAD_FILE      | user_id=user_48 | email=imteajsajid5@gmail.com | name=imteaj sajid | ip=127.0.0.1 | file=application_form_374.pdf | app_id=374 | action=view
```

**What to verify:**
- The `file=` parameter should show the decrypted file name
- It should NOT show encrypted values like `file=eyJpdiI6IkpjSDBVYS9IVWxkMEFlYThsWHV2cEE9PSIsInZhbHVl...`

### Test 3: Security Log via AJAX
**How to test:**
1. Open browser developer tools (F12)
2. Go to Network tab
3. Navigate to an application page and click on a file link
4. Check for XHR/Fetch requests to `/log-file-access`
5. After clicking, check the security log file

**Expected Result:**
- The security log should show the decrypted file name
- Format should match Test 2 above

### Test 4: Secure File Download Route
**How to test:**
1. Navigate to an application page
2. Right-click on a file link and copy the URL
3. The URL might look like: `http://localhost:8000/admin/secure-download/...`
4. Access the file by clicking or opening in a new tab
5. Check the security log after download

**Expected Result:**
- File should download correctly
- Security log should show the decrypted file name in the log entry

## Verification Commands

### View Today's Security Log
```bash
tail -50 storage/logs/security/$(date +%Y-%m)/$(date +%Y-%m-%d).log
```

### Search for File Downloads
```bash
grep "DOWNLOAD_FILE" storage/logs/security/$(date +%Y-%m)/$(date +%Y-%m-%d).log
```

### Search for Specific Application
```bash
grep "app_id=374" storage/logs/security/$(date +%Y-%m)/$(date +%Y-%m-%d).log
```

### Check if Encryption Strings Exist in Logs (Should return empty)
```bash
grep "eyJpdiI" storage/logs/security/$(date +%Y-%m)/$(date +%Y-%m-%d).log
```

## Rollback Instructions

If issues occur, you can rollback by reverting these files:
1. `app/Helper/Helper.php`
2. `app/Http/Controllers/TendersController.php`

**Git command:**
```bash
git checkout HEAD -- app/Helper/Helper.php app/Http/Controllers/TendersController.php
```

## Technical Details

### Encryption Service Usage
The implementation uses the existing `EncryptionService` class:
- `isEncrypted($value)` - Checks if a value is encrypted
- `decrypt($value)` - Decrypts an encrypted value
- Returns original value if decryption fails (backward compatibility)

### Error Handling
- All decryption attempts are wrapped in try-catch blocks
- If decryption fails, the original value is used
- Warnings are logged to Laravel's log for debugging

### Performance Impact
- Minimal - decryption only occurs when:
  1. Displaying files on the application view page
  2. Logging file access in security logs
- No impact on file storage or upload processes

## Success Criteria

✅ **Implementation is successful if:**
1. Application view page shows human-readable file names
2. Security logs contain decrypted file names
3. No encrypted strings (starting with `eyJpdiI`) appear in logs or UI
4. File downloads still work correctly
5. No errors in Laravel log files (`storage/logs/laravel.log`)

## Troubleshooting

### Issue: Files not displaying on application page
**Solution:** 
- Check if encryption service is working: `php artisan tinker` then test `app(\App\Services\EncryptionService::class)->decrypt('encrypted_value')`
- Check Laravel log for decryption errors

### Issue: Security logs still show encrypted values
**Solution:**
- Clear cache: `php artisan config:clear && php artisan cache:clear`
- Restart web server
- Check if the security_log function changes were applied correctly

### Issue: File downloads not working
**Solution:**
- The decryption should only affect logging, not the actual file path resolution
- Check if `uploadFileSearch()` function is working correctly
- Verify file permissions in `public/upload/` directory

## Additional Notes

- The implementation maintains backward compatibility with non-encrypted file names
- Files uploaded before encryption was implemented will still work
- The ApplicationFiles model already uses the Encryptable trait, so Eloquent queries automatically decrypt
- Raw DB queries in the controller now manually decrypt file names

## Date Implemented
January 22, 2026

## Implemented By
Senior Software Engineer - AI Assistant
