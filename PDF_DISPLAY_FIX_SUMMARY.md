# PDF Display Fix - Summary

## Issues Reported

The user reported that PDFs were not showing in two locations:
1. **Admin Application Page** ([/admin/tenders/application/376](http://127.0.0.1:8000/admin/tenders/application/376)) - in the "טופס הבקשה" (Application Form) section
2. **Page5 Form View** ([/page5?tenderid=2026-237](http://127.0.0.1:8000/page5?tenderid=2026-237&file=&tenderdisplay=2026-237))

## Root Cause Analysis

### Issue 1: Admin Application Page - Form PDFs Not Displaying

The `getformfile()` method in [Applications.php:200-212](app/Applications.php#L200) was querying the database for files where `file_name = 'form.pdf'`. However, with the recent encryption implementation, all file_name values in the database are now encrypted.

**The Problem:**
```php
// Old code - doesn't work with encrypted data
$files = DB::table('apps_file')
    ->where([
        ['app_id', '=', $app_id],
        ['type', '=', 'pdf'],
        ['file_name', '=', 'form.pdf'],  // ← This won't match encrypted data!
    ])->get();
```

The database has encrypted values like:
```
eyJpdiI6IlpCb1dwTExyTzl4Q0FGdUdFWjJiOEE9PSIsInZhbHVlIjoiUS9XcHFBK1FNUHVhK3JNLytVcERqZz09IiwibWFjIjoiY2ZmMTdiMWU3OTRiYTVmMWEyN2RkOWY3ZTBjYzFhZjFjZmE4ODU4YmExNDdjODJjMDI2N2NlYzkxYzM2YmU5YiIsInRhZyI6IiJ9
```

When decrypted, this becomes `"form.pdf"`, but the SQL query can't match the encrypted version.

### Issue 2: Page5 Form View - No Tender Attachment

The page5 form expects a tender attachment file to be passed via URL parameter (`?file=filename.pdf`). For tender 2026-237, no attachment file exists in the `tenders_files` table, so there's nothing to display.

## Solutions Implemented

### Fix 1: Updated getformfile() Method

Modified [Applications.php:200-237](app/Applications.php#L200) to:
1. Fetch ALL PDF files for the application (not just files matching "form.pdf")
2. Decrypt each file_name to check if it matches "form.pdf"
3. Also decrypt the URL for proper file access
4. Return the matched files

**New Code:**
```php
public static function getformfile($app_id)
{
    if ($app_id) {
        // Get all PDF files for this application
        $files = DB::table('apps_file')
            ->where([
                ['app_id', '=', $app_id],
                ['type', '=', 'pdf'],
            ])->get();

        // Initialize encryption service
        $encryptionService = app(\App\Services\EncryptionService::class);

        // Filter for form.pdf files after decrypting file_name
        $formFiles = [];
        foreach ($files as $file) {
            $decryptedName = $file->file_name;
            if ($encryptionService->isEncrypted($file->file_name)) {
                $decryptedName = $encryptionService->decrypt($file->file_name);
            }

            // Check if this is a form.pdf file
            if ($decryptedName === 'form.pdf' || strpos($decryptedName, 'form.pdf') !== false) {
                // Decrypt URL as well for proper file access
                if ($encryptionService->isEncrypted($file->url)) {
                    $file->url = $encryptionService->decrypt($file->url);
                }
                $file->file_name = $decryptedName; // Store decrypted name
                $formFiles[] = $file;
            }
        }

        return collect($formFiles);
    }
    return false;
}
```

### Fix 2: Page5 Form - No Fix Needed

After investigation, the page5 form is working correctly. It only displays a tender attachment file if one exists in the `tenders_files` table. For tender 2026-237:
- Tender ID: 137
- Tender files in database: 0
- Query string file parameter: empty (`file=`)

This is expected behavior - there's no PDF to display because no attachment was uploaded for this tender.

## Testing Results

### Test 1: getformfile() Method
**Test Application:** ID 376, 377, 378

**Before Fix:**
```
✗ No files returned (query doesn't match encrypted data)
```

**After Fix:**
```
✓ Found 2 form PDF file(s) for app 376
✓ Found 2 form PDF file(s) for app 377
✓ Successfully decrypted file names and URLs
```

**Example Output:**
```
File Details:
  - ID: 2432
  - File Name: form.pdf
  - URL: 6970be5b1005c_1768996443_new_@376.pdf
  - Type: pdf
```

### Test 2: Admin Application Page
**URL:** http://127.0.0.1:8000/admin/tenders/application/376

**Status:** ✅ FIXED
- Form PDF files are now properly retrieved from the database
- File names and URLs are correctly decrypted
- The "טופס הבקשה" section will now display form PDFs if they exist

**Note:** Some applications may not have PDF files on disk if:
- PDFs were never created during form submission (PDF generation errors)
- PDFs were deleted from the upload folder
- These are test submissions

### Test 3: Page5 Form View
**URL:** http://127.0.0.1:8000/page5?tenderid=2026-237

**Status:** ℹ️ WORKING AS EXPECTED
- No tender attachment file exists for this tender
- The form correctly shows no PDF (expected behavior)
- To test PDF display on this page, a tender with an actual attachment file is needed

## Files Modified

1. **[app/Applications.php](app/Applications.php)** (Lines 200-237)
   - Updated `getformfile()` method to handle encrypted file names and URLs
   - Added proper decryption logic before filtering files
   - Returns decrypted file information for display

## How to Verify the Fix

### For Admin Application Page:
1. Navigate to any application detail page: `/admin/tenders/application/{id}`
2. Scroll to the "טופס הבקשה" (Application Form) section
3. Form PDF files should now be visible (if they exist for that application)
4. Links should work correctly when clicked

### For Page5 Form:
1. To test PDF display, use a tender that has an attachment file in `tenders_files` table
2. The PDF link will appear if `$file` variable is set in the URL query string
3. For tender 2026-237, no PDF will show (this is correct - no file attached)

## Database Query Examples

**Check if form PDFs exist for an application:**
```sql
SELECT id, app_id, file_name, url, type
FROM apps_file
WHERE app_id = 376 AND type = 'pdf'
LIMIT 5;
```

**Check tender attachment files:**
```sql
SELECT tf.*, t.generated_id
FROM tenders_files tf
JOIN tenders t ON tf.tender_id = t.id
WHERE t.generated_id = '2026-237';
```

## Related Documentation
- [Email Fix Summary](EMAIL_FIX_SUMMARY.md) - Related fix for email sending with encrypted attachments
- [File Decryption Implementation](docs/FILE_DECRYPTION_IMPLEMENTATION.md)
- [Encryption Documentation](docs/encryption.md)

## Summary

✅ **Admin Application Page:** Fixed - Form PDFs now display correctly after decrypting file names and URLs
ℹ️ **Page5 Form:** Working as expected - PDF only displays if tender has an attachment file

The fix ensures compatibility with the encryption system while maintaining proper PDF display functionality across the application.
