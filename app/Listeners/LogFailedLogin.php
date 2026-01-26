<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Failed;

class LogFailedLogin
{
    /**
     * Handle the event.
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
            ->log(__('failed login attempt'));
    }
}
