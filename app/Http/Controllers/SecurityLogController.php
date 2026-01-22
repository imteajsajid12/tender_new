<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SecurityLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Download the security log file for a specific date.
     *
     * Route: /admin/security-log/download
     * Query params:
     *   - date: Y-m-d format (optional, defaults to today)
     *
     * @param Request $request
     * @return BinaryFileResponse|\Illuminate\Http\RedirectResponse
     */
    public function download(Request $request)
    {
        // Check if user has admin privileges (role 4 or has specific permission)
        $user = Auth::user();
        if (!$this->canAccessSecurityLogs($user)) {
            abort(403, 'Unauthorized access to security logs.');
        }

        // Get requested date or default to today
        $date = $request->input('date', now()->format('Y-m-d'));

        // Validate date format
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return back()->with('error', 'Invalid date format. Use Y-m-d.');
        }

        // Build file path
        $monthFolder = substr($date, 0, 7); // Y-m
        $fileName = "{$date}.log";
        $filePath = storage_path("logs/security/{$monthFolder}/{$fileName}");

        // Check if file exists
        if (!File::exists($filePath)) {
            return back()->with('error', "Security log for {$date} not found.");
        }

        // Download file with date-based name
        $downloadName = "{$date}.log";

        // Log this download action
        security_log('INFO', 'DOWNLOAD_FILE', [
            'user' => $user, // Pass user object for better logging
            'ip' => $request->ip(),
            'file' => "security_log_{$date}.log",
        ]);

        return response()->download($filePath, $downloadName, [
            'Content-Type' => 'text/plain',
        ]);
    }

    /**
     * List available security log files.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if (!$this->canAccessSecurityLogs($user)) {
            abort(403, 'Unauthorized access to security logs.');
        }

        $securityLogPath = storage_path('logs/security');
        $logs = [];

        if (File::isDirectory($securityLogPath)) {
            // Get all month directories
            $monthDirs = File::directories($securityLogPath);

            foreach ($monthDirs as $monthDir) {
                $month = basename($monthDir);
                $files = File::files($monthDir);

                foreach ($files as $file) {
                    $logs[] = [
                        'month' => $month,
                        'date' => pathinfo($file->getFilename(), PATHINFO_FILENAME),
                        'filename' => $file->getFilename(),
                        'size' => $file->getSize(),
                        'modified' => date('Y-m-d H:i:s', $file->getMTime()),
                    ];
                }
            }

            // Sort by date descending
            usort($logs, fn($a, $b) => strcmp($b['date'], $a['date']));
        }

        if ($request->wantsJson()) {
            return response()->json(['logs' => $logs]);
        }

        return view('admin.security-logs', [
            'logs' => $logs,
            'pageTitle' => 'Security Logs',
        ]);
    }

    /**
     * View log content for a specific date.
     *
     * @param Request $request
     * @param string $date
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function show(Request $request, string $date)
    {
        $user = Auth::user();
        if (!$this->canAccessSecurityLogs($user)) {
            abort(403, 'Unauthorized access to security logs.');
        }

        // Validate date format
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return response()->json(['error' => 'Invalid date format'], 400);
        }

        $monthFolder = substr($date, 0, 7);
        $filePath = storage_path("logs/security/{$monthFolder}/{$date}.log");

        if (!File::exists($filePath)) {
            return response()->json(['error' => 'Log file not found'], 404);
        }

        $content = File::get($filePath);
        $lines = array_filter(explode("\n", $content));

        if ($request->wantsJson()) {
            return response()->json([
                'date' => $date,
                'entries' => $lines,
                'total' => count($lines),
            ]);
        }

        return view('admin.security-log-view', [
            'date' => $date,
            'entries' => $lines,
            'pageTitle' => "Security Log - {$date}",
        ]);
    }

    /**
     * Check if user can access security logs.
     *
     * Based on the application's role system:
     * - User ID 1 is super admin (always has access)
     * - users.role column contains comma-separated permission numbers
     * - users_meta.user_role contains role title (e.g., "מנהל")
     *
     * @param mixed $user
     * @return bool
     */
    protected function canAccessSecurityLogs($user): bool
    {
        if (!$user) {
            return false;
        }

        // Super admin (user ID 1) always has access
        if ($user->id == 1) {
            return true;
        }

        // Check if user has any admin permissions in their role field
        // The role field contains comma-separated permission values
        $permissions = explode(',', $user->role ?? '');

        // Allow if user has any permissions (meaning they are an admin user)
        // You can customize this to check for specific permission numbers
        // For example: in_array('5', $permissions) for a "security_logs" permission
        if (!empty($user->role) && count(array_filter($permissions)) > 0) {
            return true;
        }

        // Alternative: Check user_role from users_meta for admin titles
        $userMeta = \DB::table('users_meta')
            ->where('user_id', $user->id)
            ->where('meta_name', 'user_role')
            ->first();

        if ($userMeta) {
            $adminTitles = ['מנהל', 'מנהל מערכת', 'admin', 'administrator'];
            if (in_array($userMeta->meta_value, $adminTitles)) {
                return true;
            }
        }

        return false;
    }
}
