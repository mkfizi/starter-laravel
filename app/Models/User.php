<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Traits\HasRoles;

/**
 * User Model
 * 
 * Represents an authenticated user in the application with support for:
 * - Email verification (MustVerifyEmail)
 * - ULID-based primary keys for better distributed systems support
 * - Role-based permissions using Spatie Permission package
 * - Two-factor authentication via Laravel Fortify
 * - Activity logging for audit trails
 * - Notifications
 * 
 * @property string $id ULID primary key
 * @property string $name User's full name
 * @property string $email User's email address (unique)
 * @property string $locale User's preferred language locale (default: 'en')
 * @property \Illuminate\Support\Carbon|null $email_verified_at Email verification timestamp
 * @property bool $must_change_password Flag indicating if user must change password on next login
 * @property string $password Hashed password
 * @property string|null $remember_token Token for "remember me" functionality
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasUlids, HasRoles, TwoFactorAuthenticatable, Notifiable, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'locale',
        'must_change_password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the activity log options.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'must_change_password'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
