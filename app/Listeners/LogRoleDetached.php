<?php

namespace App\Listeners;

use Spatie\Permission\Events\RoleDetachedEvent;

/**
 * Log Role Detached Listener
 * 
 * Listens to the RoleDetachedEvent event from Spatie Permission package
 * and logs it to the activity log for audit purposes.
 */
class LogRoleDetached
{
    /**
     * Handle the role detached event.
     * 
     * Records when a role is detached from a model in the activity log.
     * 
     * @param RoleDetachedEvent $event The role detached event
     * @return void
     */
    public function handle(RoleDetachedEvent $event): void
    {
        // Get role models from IDs
        $roleClass = config('permission.models.role');
        $roles = $roleClass::whereIn('id', (array) $event->rolesOrIds)->get();
        
        foreach ($roles as $role) {
            activity()
                ->performedOn($event->model)
                ->causedBy(auth()->user())
                ->event('updated')
                ->withProperties([
                    'role_id' => $role->id,
                    'role_name' => $role->name,
                ])
                ->log("Role '{$role->name}' detached from {$event->model->name}");
        }
    }
}
