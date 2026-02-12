<?php

namespace App\Listeners;

use App\Models\SessionHistory;
use Illuminate\Auth\Events\Logout;

/**
 * Log User Logout Listener
 * 
 * Listens to Laravel's Logout event and performs two actions:
 * 1. Logs the logout event to the activity log for audit purposes
 * 2. Updates the session history record to mark when the user logged out
 */
class LogUserLogout
{
    /**
     * Handle the logout event.
     * 
     * Records the logout event in the activity log and updates the corresponding
     * session history record with the logout timestamp and type (manual).
     * 
     * @param Logout $event The logout event
     * @return void
     */
    public function handle(Logout $event): void
    {
        activity()
            ->causedBy($event->user)
            ->event('logout')
            ->log("User '{$event->user->name}' ({$event->user->email}) logged out");

        SessionHistory::where('user_id', $event->user->id)
            ->where('session_id', session()->getId())
            ->whereNull('logout_at')
            ->update([
                'logout_at' => now(),
                'logout_type' => 'manual',
            ]);
    }
}
