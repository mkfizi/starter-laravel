<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Session History Model
 * 
 * Tracks user login/logout sessions for security auditing and monitoring.
 * Records IP addresses, user agents, and session lifecycle events.
 * 
 * @property int $id
 * @property string $user_id ULID foreign key to users table
 * @property string $session_id Laravel session ID
 * @property string|null $ip_address User's IP address during login
 * @property string|null $user_agent User's browser/device user agent string
 * @property \Illuminate\Support\Carbon $login_at Login timestamp
 * @property \Illuminate\Support\Carbon|null $logout_at Logout timestamp (null if still active)
 * @property string|null $logout_type Type of logout: 'manual', 'expired', or 'forced'
 */
class SessionHistory extends Model
{
    /**
     * Indicates if the model should be timestamped.
     * Disabled because we manually manage login_at and logout_at.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'session_id',
        'ip_address',
        'user_agent',
        'login_at',
        'logout_at',
        'logout_type',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'login_at' => 'datetime',
        'logout_at' => 'datetime',
    ];

    /**
     * Get the user that owns the session history.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Determine the session status.
     * 
     * Returns a human-readable status based on the session state:
     * - 'Logged out', 'Expired', or 'Forced' if logout_at is set
     * - 'Expired' if session lifetime has passed
     * - 'Active' if session is still valid
     *
     * @return string Session status
     */
    public function getStatusAttribute(): string
    {
        if ($this->logout_at) {
            return $this->logout_type === 'manual' ? 'Logged out' : ucfirst($this->logout_type);
        }

        // Check if session has expired based on session lifetime
        $sessionLifetime = config('session.lifetime', 120);
        $expiresAt = $this->login_at->addMinutes($sessionLifetime);

        if (now()->greaterThan($expiresAt)) {
            return 'Expired';
        }

        return 'Active';
    }
}
