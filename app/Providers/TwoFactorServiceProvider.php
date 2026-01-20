<?php

namespace App\Providers;

use App\Services\TwoFactor\OtpService;
use Illuminate\Support\ServiceProvider;

/**
 * Two-Factor Authentication Service Provider
 *
 * This provider registers the OTP service and publishes configuration files.
 * Copy this provider to other Laravel projects for easy 2FA setup.
 */
class TwoFactorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Merge default config
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/twofactor.php',
            'twofactor'
        );

        // Register OTP Service as singleton
        $this->app->singleton(OtpService::class, function ($app) {
            return new OtpService();
        });

        // Alias for easier access
        $this->app->alias(OtpService::class, 'otp');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish configuration
        $this->publishes([
            __DIR__ . '/../../config/twofactor.php' => config_path('twofactor.php'),
        ], 'twofactor-config');

        // Publish views
        $this->publishes([
            __DIR__ . '/../../resources/views/auth/two-factor-verify.blade.php' => resource_path('views/auth/two-factor-verify.blade.php'),
            __DIR__ . '/../../resources/views/emails/otp.blade.php' => resource_path('views/emails/otp.blade.php'),
        ], 'twofactor-views');

        // Publish migrations
        $this->publishes([
            __DIR__ . '/../../database/migrations/2025_01_20_000001_create_otp_codes_table.php' => database_path('migrations/2025_01_20_000001_create_otp_codes_table.php'),
        ], 'twofactor-migrations');

        // Publish language files
        $this->publishes([
            __DIR__ . '/../../lang/en/twofactor.php' => lang_path('en/twofactor.php'),
            __DIR__ . '/../../lang/he/twofactor.php' => lang_path('he/twofactor.php'),
        ], 'twofactor-lang');

        // Load language files
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'twofactor');

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                \App\Console\Commands\CleanupExpiredOtps::class,
            ]);
        }
    }
}
