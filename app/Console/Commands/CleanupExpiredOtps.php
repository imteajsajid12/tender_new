<?php

namespace App\Console\Commands;

use App\Services\TwoFactor\OtpService;
use Illuminate\Console\Command;

/**
 * Cleanup Expired OTP Codes Command
 *
 * This command removes expired OTP codes from the database.
 * Should be scheduled to run daily via Laravel's task scheduler.
 *
 * Usage:
 *   php artisan otp:cleanup
 *   php artisan otp:cleanup --days=14
 */
class CleanupExpiredOtps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'otp:cleanup
                            {--days= : Number of days to keep OTP records (default: from config)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove expired OTP codes from the database';

    /**
     * Execute the console command.
     */
    public function handle(OtpService $otpService): int
    {
        $days = $this->option('days') ?? config('twofactor.cleanup.older_than_days', 7);

        $this->info("Cleaning up OTP codes older than {$days} days...");

        $deleted = $otpService->cleanup((int) $days);

        $this->info("Successfully deleted {$deleted} expired OTP records.");

        return Command::SUCCESS;
    }
}
