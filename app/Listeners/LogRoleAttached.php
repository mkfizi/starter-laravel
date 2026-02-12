<?php

namespace App\Listeners;

use Spatie\Permission\Events\RoleAttachedEvent;

/**
 * Log Role Attached Listener
 * 
 * Listens to the RoleAttachedEvent event from Spatie Permission package
 * and logs it to the activity log for audit purposes.
 */
class LogRoleAttached
{
    /**
     * Handle the role attached event.
     * 
     * Records when a role is attached to a model in the activity log.
     * 
     * @param RoleAttachedEvent $event The role attached event
     * @return void
     */
    public function handle(RoleAttachedEvent $event): void
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
                ->log("Role '{$role->name}' attached to {$event->model->name}");
        }
    }
}
