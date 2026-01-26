<?php

namespace App\Listeners;

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
    }
}
