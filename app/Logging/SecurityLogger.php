<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Illuminate\Support\Facades\File;

class SecurityLogger
{
    /**
     * Create a custom Monolog instance for security logging.
     * Creates folder structure: storage/logs/security/YYYY-MM/YYYY-MM-DD.log
     *
     * @param array $config
     * @return Logger
     */
    public function __invoke(array $config): Logger
    {
        $date = now();
        $monthFolder = $date->format('Y-m');
        $dailyFile = $date->format('Y-m-d') . '.log';

        $logPath = storage_path("logs/security/{$monthFolder}");

        // Create directory if it doesn't exist
        if (!File::isDirectory($logPath)) {
            File::makeDirectory($logPath, 0755, true);
        }

        $fullPath = "{$logPath}/{$dailyFile}";

        $logger = new Logger('security');

        // Create handler with custom formatter (no default format - we format in helper)
        $handler = new StreamHandler($fullPath, Logger::DEBUG);

        // Use a simple formatter that just outputs the message
        $formatter = new LineFormatter("%message%\n", null, true, true);
        $handler->setFormatter($formatter);

        $logger->pushHandler($handler);

        return $logger;
    }
}
