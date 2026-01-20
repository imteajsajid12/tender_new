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
 * Format: 2026-01-18 10:15:32 | INFO  | LOGIN_ATTEMPT      | user=user_123  | ip=192.168.1.45 | success=true
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

    // Build data string with pipe separators
    $dataString = '';
    foreach ($data as $key => $value) {
        $dataString .= " | {$key}={$value}";
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
