<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class LogUserLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        activity()
            ->causedBy($event->user)
            ->event('login')
            ->log(__('login'));
    }
}
