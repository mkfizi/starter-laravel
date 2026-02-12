<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Failed;

/**
 * Log Failed Login Listener
 * 
 * Listens to Laravel's Failed authentication event and logs the failed login
 * attempt to the activity log. This provides an audit trail of authentication
 * failures for security monitoring.
 */
class LogFailedLogin
{
    /**
     * Handle the failed authentication event.
     * 
     * Logs a failed login attempt with the attempted email and guard name.
     * If the email exists in the system, the activity is attributed to that user.
     * 
     * @param Failed $event The failed authentication event
     * @return void
     */
    public function handle(Failed $event): void
    {
        $user = User::where('email', $event->credentials['email'] ?? null)->first();

        activity()
            ->causedBy($user)
            ->event('failed_login')
            ->withProperties([
                'email' => $event->credentials['email'] ?? null,
                'guard' => $event->guard,
            ])
            ->log('Failed login attempt');
    }
}
