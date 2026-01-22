<?php
/**
 * generate file name of tender application's submitted files
 * @param mixed $applicant_name
 * @param mixed $fileTitle label of submitted file input filed from Form.php
 * @param int $primaryMax maxIdOf table primary key
 * @param mixed $fileExtension file extension name
 * @return string
 */
function makeFileName($applicant_name, $fileTitle,$fileExtension='pdf'){
    $publicPathLength = strlen(public_path());
    $__name = Str::
    of(uniqid("",true)." ".time()." ".
    
    Str::limit($fileTitle,150 - $publicPathLength,'_')
    
    )
    ->slug("_",null,[
        '@' => 'ok'
        ])
    
    ->limit(200,'')
    ;
    return Str::limit($__name->value()."@".\Str::limit($applicant_name,80,'' ).".{$fileExtension}",250,'' );
}

/**
 * search tender application's submitted file if name mismatch issue occur
 * @param mixed $file file basename only
 * @return mixed
 */
function uploadFileSearch($file){
    if(!file_exists(public_path(('upload/' .$file))) || preg_match("/\t/", $file)){
        $parts = explode('_',$file);

        if(isset($parts[0], $parts[1])){
            $initName = $parts[0].'_'.$parts[1].'_';
            $searchFile = glob(public_path(('upload/'.$initName.'*.*')));
            if(count($searchFile)){
                $file = str_replace("\t",'%09',basename($searchFile[0]));
            }
        }else{
            return $file;
        }
    }
    return $file;
}

/**
 * Log security activity to the security channel.
 *
 * Format: 2026-01-18 10:15:32 | INFO  | LOGIN_ATTEMPT      | user=user_123 | email=user@example.com | ip=192.168.1.45 | success=true
 *
 * @param string $level Log level: INFO, WARN, ERROR, DEBUG
 * @param string $action Action type: LOGIN_ATTEMPT, DOWNLOAD_FILE, CHANGE_PERMISSIONS
 * @param array $data Additional data to log (key-value pairs)
 * @return void
 */
function security_log(string $level, string $action, array $data = []): void
{
    $timestamp = now()->format('Y-m-d H:i:s');

    // Pad level to 5 characters for alignment
    $levelPadded = str_pad(strtoupper($level), 5, ' ', STR_PAD_RIGHT);

    // Pad action to 18 characters for alignment
    $actionPadded = str_pad(strtoupper($action), 18, ' ', STR_PAD_RIGHT);

    // Enhance user identification - add email/name if user object or ID is provided
    if (isset($data['user'])) {
        $userIdentifier = $data['user'];
        
        // Handle null or unauthenticated user
        if ($userIdentifier === null || $userIdentifier === 'guest' || $userIdentifier === 'unknown') {
            $data['user_id'] = 'UNAUTHENTICATED';
            $data['email'] = 'not_logged_in';
            unset($data['user']);
        }
        // If user is an object (User model instance)
        elseif (is_object($userIdentifier) && method_exists($userIdentifier, 'getAttribute')) {
            $userId = $userIdentifier->id;
            $userEmail = $userIdentifier->email;
            $userName = $userIdentifier->name ?? null;
            
            $data['user_id'] = "user_{$userId}";
            $data['email'] = $userEmail;
            if ($userName) {
                $data['name'] = $userName;
            }
            unset($data['user']); // Remove the object
        }
        // If user is numeric ID
        elseif (is_numeric($userIdentifier)) {
            try {
                $user = \App\Models\User::find($userIdentifier);
                if ($user) {
                    $data['user_id'] = "user_{$userIdentifier}";
                    $data['email'] = $user->email;
                    if ($user->name) {
                        $data['name'] = $user->name;
                    }
                    unset($data['user']);
                } else {
                    // User ID doesn't exist in database
                    $data['user_id'] = "user_{$userIdentifier}";
                    $data['email'] = 'user_not_found';
                    unset($data['user']);
                }
            } catch (\Exception $e) {
                // Keep original if lookup fails
                $data['user_id'] = is_numeric($userIdentifier) ? "user_{$userIdentifier}" : $userIdentifier;
                $data['email'] = 'lookup_failed';
                unset($data['user']);
            }
        }
        // If user is string like "user_123", "user_guest", etc
        elseif (is_string($userIdentifier)) {
            // Try to extract user ID and look up email
            if (preg_match('/^user_(\d+)$/', $userIdentifier, $matches)) {
                $userId = $matches[1];
                try {
                    $user = \App\Models\User::find($userId);
                    if ($user) {
                        $data['user_id'] = "user_{$userId}";
                        $data['email'] = $user->email;
                        if ($user->name) {
                            $data['name'] = $user->name;
                        }
                    } else {
                        $data['user_id'] = $userIdentifier;
                        $data['email'] = 'user_not_found';
                    }
                } catch (\Exception $e) {
                    $data['user_id'] = $userIdentifier;
                    $data['email'] = 'lookup_failed';
                }
            } else {
                // Keep as is - might be email or other identifier
                $data['user_id'] = $userIdentifier;
                if (!isset($data['email'])) {
                    $data['email'] = 'not_provided';
                }
            }
            unset($data['user']);
        }
        // Fallback for any other type
        else {
            $data['user_id'] = 'UNKNOWN_TYPE';
            $data['email'] = 'invalid_user_data';
            unset($data['user']);
        }
    }
    // If no user provided, check if currently authenticated
    elseif (!isset($data['user_id']) && !isset($data['email'])) {
        try {
            $currentUser = \Illuminate\Support\Facades\Auth::user();
            if ($currentUser) {
                $data['user_id'] = "user_{$currentUser->id}";
                $data['email'] = $currentUser->email;
                if ($currentUser->name) {
                    $data['name'] = $currentUser->name;
                }
            } else {
                $data['user_id'] = 'UNAUTHENTICATED';
                $data['email'] = 'not_logged_in';
            }
        } catch (\Exception $e) {
            $data['user_id'] = 'AUTH_CHECK_FAILED';
            $data['email'] = 'error_checking_auth';
        }
    }

    // Decrypt file parameter if it's encrypted (for file download/access logs)
    if (isset($data['file'])) {
        try {
            $encryptionService = app(\App\Services\EncryptionService::class);
            // Check if the file value is encrypted
            if ($encryptionService->isEncrypted($data['file'])) {
                $decryptedFileName = $encryptionService->decrypt($data['file']);
                $data['file'] = $decryptedFileName;
            }
        } catch (\Exception $e) {
            // If decryption fails, keep original value
            \Illuminate\Support\Facades\Log::warning("Failed to decrypt file name in security log: " . $e->getMessage());
        }
    }

    // Build data string with pipe separators
    $dataString = '';
    foreach ($data as $key => $value) {
        // Sanitize values to prevent log injection
        $sanitizedValue = str_replace(["\n", "\r", "|"], ['', '', ''], (string)$value);
        $dataString .= " | {$key}={$sanitizedValue}";
    }

    // Final log message format
    $message = "{$timestamp} | {$levelPadded} | {$actionPadded}{$dataString}";

    // Write to security channel
    \Illuminate\Support\Facades\Log::channel('security')->info($message);
}

/**
 * Get the current security log file path.
 *
 * @return string
 */
function get_security_log_path(): string
{
    $date = now();
    $monthFolder = $date->format('Y-m');
    $dailyFile = $date->format('Y-m-d') . '.log';

    return storage_path("logs/security/{$monthFolder}/{$dailyFile}");
}

/**
 * Get security log directory path for a specific month.
 *
 * @param string|null $month Format: Y-m (e.g., 2026-01). Defaults to current month.
 * @return string
 */
function get_security_log_directory(?string $month = null): string
{
    $month = $month ?? now()->format('Y-m');
    return storage_path("logs/security/{$month}");
}

?>
