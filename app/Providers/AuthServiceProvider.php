<?php

namespace App\Providers;

use App\Auth\EncryptedUserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Register custom encrypted user provider for handling encrypted email authentication
        Auth::provider('encrypted', function ($app, array $config) {
            return new EncryptedUserProvider(
                $app['hash'],
                $config['model']
            );
        });
    }
}
