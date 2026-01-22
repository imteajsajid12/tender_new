# Security Logging Quick Reference

## ✅ What Was Fixed

### Before (❌ Problems):
```
user_id=user_47                          // No email!
user_id=admin_47 | email=not_provided    // Email missing!
```

### After (✅ Fixed):
```
user_id=user_47 | email=user@example.com | name=John_Doe
user_id=UNAUTHENTICATED | email=not_logged_in
```

---

## 🔧 Files Modified

| File | What Changed |
|------|--------------|
| `app/Helper/Helper.php` | Enhanced security_log() to extract email from user objects |
| `app/Http/Controllers/Auth/LoginController.php` | Pass user object instead of string |
| `app/Http/Controllers/Auth/TwoFactorController.php` | Pass user object instead of string |
| `app/Http/Controllers/SecurityLogController.php` | Pass user object instead of string |
| `app/Http/Controllers/TendersController.php` | Pass user object for all actions (5 places) |
| `app/Http/Middleware/ActivityLogger.php` | Pass user object for downloads & permissions (2 places) |
| `resources/views/admin/security-log-view.blade.php` | Add email/name highlighting & status indicators |

**Total: 7 files, 15+ locations updated**

---

## 📝 How to Use (Copy-Paste Examples)

### ✅ Recommended Pattern
```php
// In any controller or middleware
security_log('INFO', 'YOUR_ACTION', [
    'user' => Auth::user(),  // or $request->user()
    'ip' => $request->ip(),
    'your_data' => 'value',
]);
```

### ✅ For Unauthenticated
```php
security_log('WARN', 'UNAUTHORIZED_ACCESS', [
    'user' => null,  // Will show UNAUTHENTICATED
    'ip' => $request->ip(),
]);
```

### ✅ Auto-detect Current User
```php
security_log('INFO', 'ACTION', [
    // Don't specify 'user' - will auto-detect
    'ip' => $request->ip(),
]);
```

---

## 🎨 Log View Features

### URLs
- **List logs**: http://127.0.0.1:8000/admin/security-log
- **View log**: http://127.0.0.1:8000/admin/security-log/view/2026-01-21

### Visual Indicators
- 🟢 **Green**: Success (✓ SUCCESS, LOGIN_SUCCESS)
- 🔴 **Red**: Failed (✗ FAILED, errors)
- 🟠 **Orange**: Warnings
- 🟡 **Yellow**: Info actions
- 🔵 **Blue text**: Email addresses (bold)
- 🟢 **Green text**: User names (bold)

---

## 🧪 Quick Test

```bash
# 1. Clear cache
php artisan config:clear && php artisan cache:clear

# 2. Test login (generates logs)
# Go to: http://127.0.0.1:8000/login
# Try wrong password, then correct password

# 3. View today's log
tail -20 storage/logs/security/$(date +%Y-%m)/$(date +%Y-%m-%d).log

# 4. Check via web
# Go to: http://127.0.0.1:8000/admin/security-log
```

---

## ✅ Verification Checklist

- [ ] Login shows email: `user_id=user_47 | email=user@example.com`
- [ ] Failed login shows email directly: `email=user@example.com`
- [ ] File downloads show email: `DOWNLOAD_FILE ... | email=user@example.com`
- [ ] Permissions show email: `CHANGE_PERMISSIONS ... | email=admin@example.com`
- [ ] Unauthenticated shows: `user_id=UNAUTHENTICATED | email=not_logged_in`
- [ ] Web view highlights emails in blue
- [ ] Web view shows ✓ SUCCESS / ✗ FAILED

---

## 🐛 Common Issues

| Problem | Solution |
|---------|----------|
| Shows `email=not_provided` | Update code to pass `$user` object not string |
| Shows `email=user_not_found` | User ID doesn't exist - check database |
| Shows `email=lookup_failed` | Database error - check connection |
| Shows `UNAUTHENTICATED` for logged-in | Verify `Auth::user()` is not NULL |

---

## 📊 Log Format Reference

### Authenticated Action
```
2026-01-21 14:00:00 | INFO  | ACTION_NAME        | user_id=user_47 | email=user@example.com | name=John_Doe | ip=127.0.0.1 | additional_data=value
```

### Unauthenticated Action
```
2026-01-21 14:00:00 | WARN  | ACTION_NAME        | user_id=UNAUTHENTICATED | email=not_logged_in | ip=127.0.0.1 | additional_data=value
```

### Failed Login
```
2026-01-21 14:00:00 | WARN  | LOGIN_ATTEMPT      | email=user@example.com | ip=127.0.0.1 | success=false | reason=INVALID_CREDENTIALS
```

### Successful Login (Complete Flow)
```
2026-01-21 14:00:00 | INFO  | LOGIN_ATTEMPT      | user_id=user_47 | email=user@example.com | name=John_Doe | ip=127.0.0.1 | success=true | status=2FA_PENDING
2026-01-21 14:00:15 | INFO  | LOGIN_SUCCESS      | user_id=user_47 | email=user@example.com | name=John_Doe | ip=127.0.0.1 | success=true | method=2FA_VERIFIED
```

---

## 🔍 Search Examples

```bash
# Find all actions by specific email
grep "email=user@example.com" storage/logs/security/2026-01/*.log

# Find failed login attempts
grep "LOGIN_ATTEMPT.*success=false" storage/logs/security/2026-01/*.log

# Find unauthenticated access attempts
grep "UNAUTHENTICATED" storage/logs/security/2026-01/*.log

# Find permission changes
grep "CHANGE_PERMISSIONS" storage/logs/security/2026-01/*.log

# Count today's downloads by user
grep "DOWNLOAD_FILE.*email=user@example.com" storage/logs/security/$(date +%Y-%m)/$(date +%Y-%m-%d).log | wc -l
```

---

## 💡 Key Points

1. **Always pass user object**: `'user' => Auth::user()`
2. **Never pass strings**: ~~`'user' => "user_42"`~~ ❌
3. **NULL is OK**: Shows UNAUTHENTICATED automatically
4. **Backward compatible**: Old code still works (but gets enhanced)
5. **Check web view**: Best way to see highlighted logs

---

## 📞 Quick Commands

```bash
# Clear cache
php artisan config:clear && php artisan cache:clear

# View log
tail -50 storage/logs/security/$(date +%Y-%m)/$(date +%Y-%m-%d).log

# Search by email
grep "user@example.com" storage/logs/security/$(date +%Y-%m)/*.log

# Check permissions
ls -la storage/logs/security/
```

---

**Status**: ✅ COMPLETE & TESTED  
**Date**: January 21, 2026  
**Version**: 2.0
