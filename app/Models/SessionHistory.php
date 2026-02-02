<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionHistory extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'session_id',
        'ip_address',
        'user_agent',
        'login_at',
        'logout_at',
        'logout_type',
    ];

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
