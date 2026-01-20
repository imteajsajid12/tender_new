<?php

namespace App\Auth;

use App\Services\EncryptionService;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Support\Facades\DB;

class EncryptedUserProvider extends EloquentUserProvider
{
    protected EncryptionService $encryptionService;

    public function __construct(HasherContract $hasher, $model)
    {
        parent::__construct($hasher, $model);
        $this->encryptionService = app(EncryptionService::class);
    }

    /**
     * Retrieve a user by the given credentials.
     * This method handles encrypted email lookup.
     *
     * @param array $credentials
     * @return Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
            (count($credentials) === 1 &&
             str_contains(key($credentials), 'password'))) {
            return null;
        }

        // If email is in credentials, we need to search differently
        if (isset($credentials['email'])) {
            $email = $credentials['email'];
            unset($credentials['email']);

            // Get all users and find the one with matching decrypted email
            $query = $this->newModelQuery();

            // Apply any additional credentials (like status)
            foreach ($credentials as $key => $value) {
                if (str_contains($key, 'password')) {
                    continue;
                }
                $query->where($key, $value);
            }

            // Fetch all matching users and check email by decrypting
            $users = $query->get();

            foreach ($users as $user) {
                $decryptedEmail = $this->encryptionService->decrypt($user->getAttributes()['email'] ?? '');

                // Compare case-insensitively
                if (strtolower($decryptedEmail) === strtolower($email)) {
                    return $user;
                }
            }

            return null;
        }

        // Fall back to parent implementation for non-email lookups
        return parent::retrieveByCredentials($credentials);
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param Authenticatable $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return parent::validateCredentials($user, $credentials);
    }
}
