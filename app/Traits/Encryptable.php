<?php

namespace App\Traits;

use App\Services\EncryptionService;

/**
 * Trait for encrypting/decrypting model attributes automatically.
 *
 * Usage: Add `use Encryptable;` to your model and define:
 * protected $encryptable = ['name', 'email'];
 */
trait Encryptable
{
    /**
     * Boot the encryptable trait for a model.
     */
    public static function bootEncryptable(): void
    {
        // Encrypt attributes before saving
        static::saving(function ($model) {
            $model->encryptAttributes();
        });

        // Decrypt attributes after retrieving from database
        static::retrieved(function ($model) {
            $model->decryptAttributes();
        });
    }

    /**
     * Get the encryptable attributes for the model.
     *
     * @return array
     */
    public function getEncryptableAttributes(): array
    {
        return $this->encryptable ?? [];
    }

    /**
     * Encrypt the encryptable attributes.
     */
    public function encryptAttributes(): void
    {
        $encryptionService = app(EncryptionService::class);

        foreach ($this->getEncryptableAttributes() as $attribute) {
            if (isset($this->attributes[$attribute]) && $this->attributes[$attribute] !== null) {
                // Only encrypt if not already encrypted
                if (!$encryptionService->isEncrypted($this->attributes[$attribute])) {
                    $this->attributes[$attribute] = $encryptionService->encrypt($this->attributes[$attribute]);
                }
            }
        }

        // Set the encryption key slot
        $this->attributes['encryption_key_slot'] = $encryptionService->getCurrentKeySlot();
    }

    /**
     * Decrypt the encryptable attributes.
     */
    public function decryptAttributes(): void
    {
        $encryptionService = app(EncryptionService::class);

        foreach ($this->getEncryptableAttributes() as $attribute) {
            if (isset($this->attributes[$attribute]) && $this->attributes[$attribute] !== null) {
                $this->attributes[$attribute] = $encryptionService->decrypt($this->attributes[$attribute]);
            }
        }
    }

    /**
     * Get an attribute value (with decryption).
     *
     * @param string $key
     * @return mixed
     */
    public function getEncryptedAttribute(string $key)
    {
        $value = $this->attributes[$key] ?? null;

        if ($value === null) {
            return null;
        }

        $encryptionService = app(EncryptionService::class);

        if ($encryptionService->isEncrypted($value)) {
            return $encryptionService->decrypt($value);
        }

        return $value;
    }

    /**
     * Set an attribute value (with encryption).
     *
     * @param string $key
     * @param mixed $value
     */
    public function setEncryptedAttribute(string $key, $value): void
    {
        if ($value === null) {
            $this->attributes[$key] = null;
            return;
        }

        $encryptionService = app(EncryptionService::class);
        $this->attributes[$key] = $encryptionService->encrypt($value);
        $this->attributes['encryption_key_slot'] = $encryptionService->getCurrentKeySlot();
    }
}
