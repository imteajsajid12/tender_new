<?php
/**
 * Test Security Logging System
 * 
 * This script tests all scenarios for the enhanced security logging system:
 * 1. Authenticated user logging
 * 2. Unauthenticated user logging
 * 3. User object logging
 * 4. User ID string logging
 * 5. Null/guest user logging
 * 
 * Run: php artisan tinker < test_security_logging.php
 */

echo "\n=== TESTING ENHANCED SECURITY LOGGING SYSTEM ===\n\n";

// Test 1: Authenticated User with User Object
echo "Test 1: Logging with authenticated user object...\n";
$user = App\Models\User::find(47);
if ($user) {
    security_log('INFO', 'TEST_USER_OBJECT', [
        'user' => $user,
        'ip' => '127.0.0.1',
        'test' => 'with_user_object'
    ]);
    echo "✓ Logged with user object (ID: {$user->id}, Email: {$user->email})\n\n";
} else {
    echo "✗ User 47 not found\n\n";
}

// Test 2: Logging with User ID (numeric)
echo "Test 2: Logging with numeric user ID...\n";
security_log('INFO', 'TEST_USER_ID', [
    'user' => 47,
    'ip' => '127.0.0.1',
    'test' => 'with_user_id'
]);
echo "✓ Logged with numeric user ID\n\n";

// Test 3: Logging with formatted user string
echo "Test 3: Logging with formatted user string...\n";
security_log('INFO', 'TEST_USER_STRING', [
    'user' => 'user_47',
    'ip' => '127.0.0.1',
    'test' => 'with_user_string'
]);
echo "✓ Logged with user string format\n\n";

// Test 4: Logging with NULL user (unauthenticated)
echo "Test 4: Logging with NULL user (unauthenticated)...\n";
security_log('INFO', 'TEST_NULL_USER', [
    'user' => null,
    'ip' => '127.0.0.1',
    'test' => 'with_null_user'
]);
echo "✓ Logged with NULL user - should show UNAUTHENTICATED\n\n";

// Test 5: Logging with 'guest' user
echo "Test 5: Logging with 'guest' user...\n";
security_log('INFO', 'TEST_GUEST_USER', [
    'user' => 'guest',
    'ip' => '127.0.0.1',
    'test' => 'with_guest_string'
]);
echo "✓ Logged with 'guest' - should show UNAUTHENTICATED\n\n";

// Test 6: Logging with 'unknown' user
echo "Test 6: Logging with 'unknown' user...\n";
security_log('INFO', 'TEST_UNKNOWN_USER', [
    'user' => 'unknown',
    'ip' => '127.0.0.1',
    'test' => 'with_unknown_string'
]);
echo "✓ Logged with 'unknown' - should show UNAUTHENTICATED\n\n";

// Test 7: Logging without user parameter (auto-detect)
echo "Test 7: Logging without user parameter (auto-detect auth)...\n";
security_log('INFO', 'TEST_AUTO_DETECT', [
    'ip' => '127.0.0.1',
    'test' => 'without_user_param'
]);
echo "✓ Logged without user param - should auto-detect or show UNAUTHENTICATED\n\n";

// Test 8: Simulate DOWNLOAD_FILE action
echo "Test 8: Simulating DOWNLOAD_FILE action...\n";
security_log('INFO', 'DOWNLOAD_FILE', [
    'user' => $user,
    'ip' => '127.0.0.1',
    'file' => 'test_document.pdf',
    'app_id' => 365,
    'action' => 'view'
]);
echo "✓ Logged file download with user object\n\n";

// Test 9: Simulate APP_DECISION action
echo "Test 9: Simulating APP_DECISION action...\n";
security_log('INFO', 'APP_DECISION', [
    'user' => $user,
    'ip' => '127.0.0.1',
    'app_id' => 365,
    'decision' => 'APPROVED',
    'stage' => 'approve_stage_1'
]);
echo "✓ Logged application decision with user object\n\n";

// Test 10: Simulate FILE_APPROVED action
echo "Test 10: Simulating FILE_APPROVED action...\n";
security_log('INFO', 'FILE_APPROVED', [
    'user' => $user,
    'ip' => '127.0.0.1',
    'app_id' => 365,
    'file_id' => 123,
    'file' => 'document.pdf'
]);
echo "✓ Logged file approval with user object\n\n";

echo "=== ALL TESTS COMPLETED ===\n";
echo "Check today's security log to verify all entries show email addresses\n";
echo "Log file: storage/logs/security/" . date('Y-m') . "/" . date('Y-m-d') . ".log\n\n";

// Display the last 15 lines of today's log
$logPath = storage_path('logs/security/' . date('Y-m') . '/' . date('Y-m-d') . '.log');
if (file_exists($logPath)) {
    echo "\n=== LAST 15 LOG ENTRIES ===\n";
    $lines = file($logPath);
    $lastLines = array_slice($lines, -15);
    foreach ($lastLines as $i => $line) {
        echo ($i + 1) . ". " . $line;
    }
} else {
    echo "Log file not found at: $logPath\n";
}

echo "\n=== END OF TEST ===\n";
