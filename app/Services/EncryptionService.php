<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Log;

class EncryptionService
{
    /**
     * The current encryption key slot identifier.
     * This is stored with encrypted data to track which APP_KEY was used.
     */
    protected string $currentKeySlot;

    public function __construct()
    {
        // Use a hash of the APP_KEY as the slot identifier
        // This allows tracking which key was used for encryption
        $this->currentKeySlot = substr(hash('sha256', config('app.key')), 0, 8);
    }

    /**
     * Encrypt a value using Laravel's encryption (which uses APP_KEY).
     *
     * @param string|null $value The value to encrypt
     * @return string|null The encrypted value, or null if input is null/empty
     */
    public function encrypt(?string $value): ?string
    {
        if ($value === null || $value === '') {
            return $value;
        }

        try {
            return Crypt::encryptString($value);
        } catch (\Exception $e) {
            Log::error('Encryption failed: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Decrypt a value using Laravel's encryption.
     *
     * @param string|null $value The encrypted value
     * @return string|null The decrypted value, or null if input is null/empty
     */
    public function decrypt(?string $value): ?string
    {
        if ($value === null || $value === '') {
            return $value;
        }

        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            Log::warning('Decryption failed - data may not be encrypted: ' . $e->getMessage());
            // Return original value if decryption fails (for backward compatibility)
            return $value;
        } catch (\Exception $e) {
            Log::error('Decryption error: ' . $e->getMessage());
            return $value;
        }
    }

    /**
     * Check if a string appears to be encrypted.
     * Laravel's encrypted strings are base64-encoded JSON with specific structure.
     *
     * @param string|null $value
     * @return bool
     */
    public function isEncrypted(?string $value): bool
    {
        if ($value === null || $value === '') {
            return false;
        }

        // Laravel encryption produces base64 strings that decode to JSON
        $decoded = base64_decode($value, true);
        if ($decoded === false) {
            return false;
        }

        $data = json_decode($decoded, true);

        // Laravel encrypted data has 'iv', 'value', 'mac' keys
        return is_array($data) &&
               isset($data['iv']) &&
               isset($data['value']) &&
               isset($data['mac']);
    }

    /**
     * Get the current encryption key slot identifier.
     *
     * @return string
     */
    public function getCurrentKeySlot(): string
    {
        return $this->currentKeySlot;
    }

    /**
     * Encrypt a value only if it's not already encrypted.
     *
     * @param string|null $value
     * @return string|null
     */
    public function encryptIfNotEncrypted(?string $value): ?string
    {
        if ($this->isEncrypted($value)) {
            return $value;
        }
        return $this->encrypt($value);
    }

    /**
     * Encrypt multiple attributes of an array.
     *
     * @param array $data The data array
     * @param array $attributes The attributes to encrypt
     * @return array The data with encrypted attributes
     */
    public function encryptAttributes(array $data, array $attributes): array
    {
        foreach ($attributes as $attribute) {
            if (isset($data[$attribute])) {
                $data[$attribute] = $this->encrypt($data[$attribute]);
            }
        }
        return $data;
    }

    /**
     * Decrypt multiple attributes of an array.
     *
     * @param array $data The data array
     * @param array $attributes The attributes to decrypt
     * @return array The data with decrypted attributes
     */
    public function decryptAttributes(array $data, array $attributes): array
    {
        foreach ($attributes as $attribute) {
            if (isset($data[$attribute])) {
                $data[$attribute] = $this->decrypt($data[$attribute]);
            }
        }
        return $data;
    }
}
