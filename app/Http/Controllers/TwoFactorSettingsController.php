<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TwoFactorSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get current 2FA settings
     */
    public function getSettings()
    {
        $settings = [
            'enabled' => env('TWOFACTOR_ENABLED', true),
            'otp_length' => env('TWOFACTOR_OTP_LENGTH', 6),
            'otp_expiry' => env('TWOFACTOR_OTP_EXPIRY', 10),
            'max_attempts' => env('TWOFACTOR_MAX_ATTEMPTS', 5),
            'rate_limit' => env('TWOFACTOR_RATE_LIMIT', 10),
            'resend_cooldown' => env('TWOFACTOR_RESEND_COOLDOWN', 60),
            'remember_device' => env('TWOFACTOR_REMEMBER_DEVICE', true),
            'remember_days' => env('TWOFACTOR_REMEMBER_DAYS', 30),
            'email_locale' => env('TWOFACTOR_EMAIL_LOCALE', 'he'),
            'email_direction' => env('TWOFACTOR_EMAIL_DIRECTION', 'rtl'),
            'subject_login' => env('TWOFACTOR_SUBJECT_LOGIN', 'קוד אימות כניסה'),
            'redirect_after_verify' => env('TWOFACTOR_REDIRECT_AFTER_VERIFY', '/admin'),
            'redirect_on_failure' => env('TWOFACTOR_REDIRECT_ON_FAILURE', '/login'),
            'exempt_roles' => env('TWOFACTOR_EXEMPT_ROLES', ''),
            'ip_whitelist' => env('TWOFACTOR_IP_WHITELIST', ''),
        ];

        return response()->json($settings);
    }

    /**
     * Update 2FA settings
     */
    public function updateSettings(Request $request)
    {
        // Check user permissions (only admin can change settings)
        $user = Auth::user();
        if (!$this->canManageSettings($user)) {
            return response()->json([
                'success' => false,
                'message' => 'אין לך הרשאה לשנות הגדרות'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'enabled' => 'required|boolean',
            'otp_length' => 'required|integer|min:4|max:8',
            'otp_expiry' => 'required|integer|min:1|max:60',
            'max_attempts' => 'required|integer|min:1|max:10',
            'rate_limit' => 'required|integer|min:1|max:50',
            'resend_cooldown' => 'required|integer|min:30|max:300',
            'remember_device' => 'required|boolean',
            'remember_days' => 'required|integer|min:1|max:90',
            'exempt_roles' => 'nullable|string',
            'ip_whitelist' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }

        try {
            $this->updateEnvFile([
                'TWOFACTOR_ENABLED' => $request->enabled ? 'true' : 'false',
                'TWOFACTOR_OTP_LENGTH' => $request->otp_length,
                'TWOFACTOR_OTP_EXPIRY' => $request->otp_expiry,
                'TWOFACTOR_MAX_ATTEMPTS' => $request->max_attempts,
                'TWOFACTOR_RATE_LIMIT' => $request->rate_limit,
                'TWOFACTOR_RESEND_COOLDOWN' => $request->resend_cooldown,
                'TWOFACTOR_REMEMBER_DEVICE' => $request->remember_device ? 'true' : 'false',
                'TWOFACTOR_REMEMBER_DAYS' => $request->remember_days,
                'TWOFACTOR_EXEMPT_ROLES' => $request->exempt_roles ?? '',
                'TWOFACTOR_IP_WHITELIST' => $request->ip_whitelist ?? '',
            ]);

            // Clear config cache
            \Artisan::call('config:clear');

            return response()->json([
                'success' => true,
                'message' => 'הגדרות האימות הדו-שלבי עודכנו בהצלחה'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'אירעה שגיאה בעדכון ההגדרות: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update .env file with new values
     */
    private function updateEnvFile(array $data)
    {
        $envPath = base_path('.env');
        $envContent = File::get($envPath);

        foreach ($data as $key => $value) {
            // Handle values that might contain special characters
            $escapedValue = $this->escapeEnvValue($value);

            // Check if key exists
            if (preg_match("/^{$key}=.*/m", $envContent)) {
                // Update existing key
                $envContent = preg_replace(
                    "/^{$key}=.*/m",
                    "{$key}={$escapedValue}",
                    $envContent
                );
            } else {
                // Add new key
                $envContent .= "\n{$key}={$escapedValue}";
            }
        }

        File::put($envPath, $envContent);
    }

    /**
     * Escape value for .env file
     */
    private function escapeEnvValue($value)
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (is_numeric($value)) {
            return $value;
        }

        // Wrap in quotes if contains spaces or special characters
        if (preg_match('/[\s#]/', $value)) {
            return '"' . str_replace('"', '\\"', $value) . '"';
        }

        return $value;
    }

    /**
     * Check if user can manage 2FA settings
     */
    private function canManageSettings($user)
    {
        // Super admin (ID 1)
        if ($user->id === 1) {
            return true;
        }

        // Check for settings permission in role
        $role = $user->role ?? '';
        $permissions = explode(',', $role);

        return in_array('1', $permissions); // Permission 1 = settings access
    }

    /**
     * Get 2FA statistics
     */
    public function getStatistics()
    {
        $stats = [
            'total_otp_sent_today' => \App\Models\OtpCode::whereDate('created_at', today())->count(),
            'total_otp_verified_today' => \App\Models\OtpCode::whereDate('created_at', today())
                ->where('is_verified', true)->count(),
            'failed_attempts_today' => \App\Models\OtpCode::whereDate('created_at', today())
                ->where('attempts', '>', 0)
                ->where('is_verified', false)->sum('attempts'),
        ];

        return response()->json($stats);
    }
}
