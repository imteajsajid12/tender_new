<?php

/**
 * Test script for security logging improvements
 * Run this via: php artisan tinker
 * Then paste the code below
 */

// Test 1: Log with User object
echo "Test 1: Logging with User object\n";
$user = App\Models\User::find(47); // Change ID as needed
if ($user) {
    security_log('INFO', 'TEST_USER_OBJECT', [
        'user' => $user,
        'ip' => '127.0.0.1',
        'test' => 'user_object_test',
    ]);
    echo "✓ Logged with user object: {$user->email}\n";
} else {
    echo "✗ User not found\n";
}

// Test 2: Log with user ID (numeric)
echo "\nTest 2: Logging with numeric user ID\n";
security_log('INFO', 'TEST_USER_ID', [
    'user' => 47, // Will be converted to user object
    'ip' => '127.0.0.1',
    'test' => 'numeric_id_test',
]);
echo "✓ Logged with numeric user ID: 47\n";

// Test 3: Log with email string (failed login)
echo "\nTest 3: Logging with email string\n";
security_log('WARN', 'TEST_EMAIL_STRING', [
    'email' => 'test@example.com',
    'ip' => '127.0.0.1',
    'success' => 'false',
    'reason' => 'TEST_FAILED_LOGIN',
]);
echo "✓ Logged with email string\n";

// Test 4: Log with old format (backward compatibility)
echo "\nTest 4: Logging with old format (backward compatibility)\n";
security_log('INFO', 'TEST_OLD_FORMAT', [
    'user' => 'user_47',
    'ip' => '127.0.0.1',
    'action' => 'old_format_test',
]);
echo "✓ Logged with old format\n";

echo "\n✓ All tests completed!\n";
echo "Check the log file: storage/logs/security/" . date('Y-m') . "/" . date('Y-m-d') . ".log\n";

// View the last 10 lines of the log
echo "\nLast 10 log entries:\n";
echo "--------------------\n";
$logPath = storage_path('logs/security/' . date('Y-m') . '/' . date('Y-m-d') . '.log');
if (file_exists($logPath)) {
    $lines = file($logPath);
    $lastLines = array_slice($lines, -10);
    foreach ($lastLines as $line) {
        echo $line;
    }
} else {
    echo "Log file not found.\n";
}
