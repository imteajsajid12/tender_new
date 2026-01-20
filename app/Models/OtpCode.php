<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

/**
 * OTP Code Model
 *
 * Handles storage and retrieval of OTP codes for two-factor authentication.
 * This model is designed to be reusable across different Laravel projects.
 *
 * @property int $id
 * @property int $user_id
 * @property string $email
 * @property string $otp_code
 * @property string $purpose
 * @property bool $is_verified
 * @property Carbon $expires_at
 * @property int $attempts
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class OtpCode extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'otp_codes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'email',
        'otp_code',
        'purpose',
        'is_verified',
        'expires_at',
        'attempts',
        'ip_address',
        'user_agent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_verified' => 'boolean',
        'expires_at' => 'datetime',
        'attempts' => 'integer',
    ];

    /**
     * OTP Purpose Constants
     */
    public const PURPOSE_LOGIN = 'login';
    public const PURPOSE_PASSWORD_RESET = 'password_reset';
    public const PURPOSE_EMAIL_VERIFY = 'email_verify';
    public const PURPOSE_TRANSACTION = 'transaction';

    /**
     * Get the user that owns the OTP code.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the OTP code is expired.
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        return Carbon::now()->greaterThan($this->expires_at);
    }

    /**
     * Check if the OTP code is valid (not expired and not verified).
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return !$this->isExpired() && !$this->is_verified;
    }

    /**
     * Check if max attempts exceeded.
     *
     * @param int $maxAttempts
     * @return bool
     */
    public function hasExceededMaxAttempts(int $maxAttempts = 5): bool
    {
        return $this->attempts >= $maxAttempts;
    }

    /**
     * Increment the attempt count.
     *
     * @return void
     */
    public function incrementAttempts(): void
    {
        $this->increment('attempts');
    }

    /**
     * Mark the OTP as verified.
     *
     * @return bool
     */
    public function markAsVerified(): bool
    {
        return $this->update(['is_verified' => true]);
    }

    /**
     * Scope a query to only include valid OTP codes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeValid($query)
    {
        return $query->where('is_verified', false)
                     ->where('expires_at', '>', Carbon::now());
    }

    /**
     * Scope a query to only include OTP codes for a specific purpose.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $purpose
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForPurpose($query, string $purpose)
    {
        return $query->where('purpose', $purpose);
    }

    /**
     * Scope a query to only include OTP codes for a specific user.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope a query to only include expired OTP codes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<=', Carbon::now());
    }
}
