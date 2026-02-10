<?php

namespace App\Listeners;

use App\Models\SessionHistory;
use Illuminate\Auth\Events\Login;

/**
 * Log User Login Listener
 * 
 * Listens to Laravel's Login event and performs two actions:
 * 1. Logs the login event to the activity log for audit purposes
 * 2. Creates a session history record for tracking active sessions
 */
class LogUserLogin
{
    /**
     * Handle the login event.
     * 
     * Records the login event in the activity log and creates a new
     * session history entry with IP address, user agent, and session ID.
     * 
     * @param Login $event The login event
     * @return void
     */
    public function handle(Login $event): void
    {
        activity()
            ->causedBy($event->user)
            ->event('login')
            ->log(__('login'));

        SessionHistory::create([
            'user_id' => $event->user->id,
            'session_id' => session()->getId(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'login_at' => now(),
        ]);
    }
}
