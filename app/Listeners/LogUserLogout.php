<?php

namespace App\Listeners;

use App\Models\SessionHistory;
use Illuminate\Auth\Events\Logout;

class LogUserLogout
{
    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        activity()
            ->causedBy($event->user)
            ->event('logout')
            ->log(__('logout'));

        SessionHistory::where('user_id', $event->user->id)
            ->where('session_id', session()->getId())
            ->whereNull('logout_at')
            ->update([
                'logout_at' => now(),
                'logout_type' => 'manual',
            ]);
    }
}
