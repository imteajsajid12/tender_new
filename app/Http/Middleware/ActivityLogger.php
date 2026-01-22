<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ActivityLogger
{
    /**
     * Routes and patterns that indicate login attempts.
     */
    protected array $loginRoutes = ['login'];

    /**
     * Routes and patterns that indicate file downloads.
     */
    protected array $downloadRoutes = [
        'file.download',
        'template.download',
        'tenderListExcelDownload',
        'secure.download',
    ];

    /**
     * URI patterns that indicate file downloads.
     */
    protected array $downloadUriPatterns = [
        'download',
        'file-download',
        'cvfiledownload',
        'export',
        'secure-download',
    ];

    /**
     * Routes that indicate permission changes.
     */
    protected array $permissionRoutes = [
        'permissions.update',
    ];

    /**
     * URI patterns for permission/user changes.
     */
    protected array $permissionUriPatterns = [
        'admin/users/edit-user',
        'admin/users/create-user',
    ];

    /**
     * URI patterns for file approval/rejection (tender applications).
     */
    protected array $fileActionUriPatterns = [
        'admin/tenders/approve-file',
        'admin/tenders/cancelfile',
        'admin/tenders/decision',
    ];

    /**
     * HTTP status codes to skip logging (errors that shouldn't be logged as activities).
     */
    protected array $skipStatusCodes = [
        419, // CSRF token mismatch
        405, // Method not allowed
        500, // Server error
        503, // Service unavailable
    ];

    /**
     * URI patterns to exclude from logging entirely.
     */
    protected array $excludedPaths = [
        'sanctum',
        'livewire',
        '_ignition',
        'horizon',
        'telescope',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Process the request first - ALWAYS let the request through
        $response = $next($request);

        // Skip logging for excluded paths
        $path = $request->path();
        foreach ($this->excludedPaths as $excluded) {
            if (str_starts_with($path, $excluded)) {
                return $response;
            }
        }

        // Skip logging for certain error responses
        if (in_array($response->getStatusCode(), $this->skipStatusCodes)) {
            return $response;
        }

        // Skip logging for AJAX/API requests that might interfere with responses
        if ($request->expectsJson() && !$this->isSecurityRelevant($request)) {
            return $response;
        }

        // Log activities after the response (wrapped in try-catch to prevent affecting main flow)
        try {
            $this->logActivity($request, $response);
        } catch (\Throwable $e) {
            // Silently fail - logging should never break the application
            Log::error('ActivityLogger error: ' . $e->getMessage());
        }

        return $response;
    }

    /**
     * Check if request is security relevant (login, download, permission change).
     */
    protected function isSecurityRelevant(Request $request): bool
    {
        $routeName = $request->route()?->getName();
        $uri = $request->path();

        return $this->isLoginAttempt($request, $routeName, $uri)
            || $this->isDownloadRequest($request, $routeName, $uri)
            || $this->isPermissionChange($request, $routeName, $uri);
    }

    /**
     * Log the activity based on the request type.
     */
    protected function logActivity(Request $request, Response $response): void
    {
        $routeName = $request->route()?->getName();
        $uri = $request->path();
        $method = $request->method();

        // Only log POST/PUT/PATCH for certain actions, GET for downloads
        if ($this->isLoginAttempt($request, $routeName, $uri)) {
            $this->logLoginAttempt($request, $response);
        } elseif ($this->isDownloadRequest($request, $routeName, $uri)) {
            $this->logFileDownload($request, $response);
        } elseif ($this->isPermissionChange($request, $routeName, $uri)) {
            $this->logPermissionChange($request, $response);
        }
    }

    /**
     * Check if this is a login attempt.
     */
    protected function isLoginAttempt(Request $request, ?string $routeName, string $uri): bool
    {
        // Only POST requests to login routes
        if ($request->method() !== 'POST') {
            return false;
        }

        // Check route name
        if ($routeName && in_array($routeName, $this->loginRoutes)) {
            return true;
        }

        // Check URI
        return str_contains($uri, 'login');
    }

    /**
     * Check if this is a download request.
     */
    protected function isDownloadRequest(Request $request, ?string $routeName, string $uri): bool
    {
        // Check route name
        if ($routeName && in_array($routeName, $this->downloadRoutes)) {
            return true;
        }

        // Check URI patterns
        foreach ($this->downloadUriPatterns as $pattern) {
            if (str_contains(strtolower($uri), strtolower($pattern))) {
                return true;
            }
        }

        // Check for application file download (מסמכים לצירוף)
        // Route: /admin/tenders/application/{id} with file download action
        if (preg_match('/admin\/apps\/\d+\/file-download/', $uri)) {
            return true;
        }

        if (preg_match('/admin\/tenders\/\d+\/file-download/', $uri)) {
            return true;
        }

        return false;
    }

    /**
     * Check if this is a permission change.
     */
    protected function isPermissionChange(Request $request, ?string $routeName, string $uri): bool
    {
        // Only POST/PUT/PATCH requests
        if (!in_array($request->method(), ['POST', 'PUT', 'PATCH'])) {
            return false;
        }

        // Check route name
        if ($routeName && in_array($routeName, $this->permissionRoutes)) {
            return true;
        }

        // Check URI patterns for user management
        foreach ($this->permissionUriPatterns as $pattern) {
            if (str_contains($uri, $pattern)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Log a login attempt.
     */
    protected function logLoginAttempt(Request $request, Response $response): void
    {
        $username = $request->input('email', 'unknown');
        $ip = $request->ip();
        $success = $this->isSuccessfulResponse($response) && Auth::check();

        $data = [
            'user' => $this->sanitizeUsername($username),
            'ip' => $ip,
            'success' => $success ? 'true' : 'false',
        ];

        // Add failure reason if available
        if (!$success) {
            $data['reason'] = $this->getLoginFailureReason($request, $response);
        }

        $level = $success ? 'INFO' : 'WARN';
        security_log($level, 'LOGIN_ATTEMPT', $data);
    }

    /**
     * Log a file download.
     */
    protected function logFileDownload(Request $request, Response $response): void
    {
        // Only log successful downloads
        if (!$this->isSuccessfulResponse($response)) {
            return;
        }

        $user = Auth::user();
        $ip = $request->ip();

        // Try to determine the file name
        $fileName = $this->extractFileName($request, $response);

        $data = [
            'user' => $user, // Pass user object for better logging (handles null automatically)
            'ip' => $ip,
            'file' => $fileName,
        ];

        security_log('INFO', 'DOWNLOAD_FILE', $data);
    }

    /**
     * Log a permission change.
     */
    protected function logPermissionChange(Request $request, Response $response): void
    {
        // Only log successful changes
        if (!$this->isSuccessfulResponse($response)) {
            return;
        }

        $adminUser = Auth::user();
        $ip = $request->ip();

        // Get target user ID from route or request
        $targetUserId = $request->route('id') ?? $request->input('user_id', 'unknown');

        // Get permission changes
        $oldPermissions = $request->input('old_permissions', '');
        $newPermissions = $request->input('permissions', []);

        if (is_array($newPermissions)) {
            $newPermissions = implode(',', $newPermissions);
        }

        $data = [
            'user' => $adminUser, // Pass user object for better logging (handles null automatically)
            'ip' => $ip,
            'target' => "user_{$targetUserId}",
        ];

        // Only add from/to if we have permission data
        if (!empty($oldPermissions) || !empty($newPermissions)) {
            $data['from'] = $oldPermissions ?: 'NONE';
            $data['to'] = $newPermissions ?: 'NONE';
        }

        security_log('INFO', 'CHANGE_PERMISSIONS', $data);
    }

    /**
     * Check if the response indicates success.
     */
    protected function isSuccessfulResponse(Response $response): bool
    {
        $statusCode = $response->getStatusCode();
        return $statusCode >= 200 && $statusCode < 400;
    }

    /**
     * Determine the reason for login failure.
     */
    protected function getLoginFailureReason(Request $request, Response $response): string
    {
        // Check response status code first (safest method)
        $statusCode = $response->getStatusCode();

        if ($statusCode === 422) {
            return 'VALIDATION_ERROR';
        }

        if ($statusCode === 429) {
            return 'RATE_LIMITED';
        }

        if ($statusCode === 419) {
            return 'CSRF_TOKEN_EXPIRED';
        }

        // Try to check session for error messages (wrapped in try-catch)
        try {
            $errors = session('errors');
            if ($errors && method_exists($errors, 'has') && $errors->has('email')) {
                $errorMsg = $errors->first('email');
                if (str_contains($errorMsg, 'credentials')) {
                    return 'INVALID_CREDENTIALS';
                }
                if (str_contains($errorMsg, 'password')) {
                    return 'INVALID_PASSWORD';
                }
            }
        } catch (\Throwable $e) {
            // Ignore session access errors
        }

        return 'INVALID_CREDENTIALS';
    }

    /**
     * Extract file name from request or response.
     */
    protected function extractFileName(Request $request, Response $response): string
    {
        // Try to get from Content-Disposition header
        $contentDisposition = $response->headers->get('Content-Disposition');
        if ($contentDisposition) {
            if (preg_match('/filename[^;=\n]*=(["\']?)([^"\'\n]*)\1/', $contentDisposition, $matches)) {
                return $matches[2];
            }
        }

        // Try to get from route parameters
        $fileId = $request->route('id') ?? $request->route('app') ?? $request->route('template');
        if ($fileId) {
            return "file_id_{$fileId}";
        }

        // Get from URI
        $uri = $request->path();
        return basename($uri) ?: 'unknown_file';
    }

    /**
     * Sanitize username for logging.
     */
    protected function sanitizeUsername(string $username): string
    {
        // Remove special characters and limit length
        $sanitized = preg_replace('/[^a-zA-Z0-9@._-]/', '', $username);
        return substr($sanitized, 0, 50) ?: 'unknown';
    }
}
