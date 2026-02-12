<?php

namespace App\Listeners;

use Spatie\Permission\Events\PermissionAttachedEvent;

/**
 * Log Permission Attached Listener
 * 
 * Listens to the PermissionAttachedEvent event from Spatie Permission package
 * and logs it to the activity log for audit purposes.
 */
class LogPermissionAttached
{
    /**
     * Handle the permission attached event.
     * 
     * Records when a permission is attached to a model in the activity log.
     * 
     * @param PermissionAttachedEvent $event The permission attached event
     * @return void
     */
    public function handle(PermissionAttachedEvent $event): void
    {
        // Get permission models from IDs
        $permissionClass = config('permission.models.permission');
        $permissions = $permissionClass::whereIn('id', (array) $event->permissionsOrIds)->get();
        
        foreach ($permissions as $permission) {
            activity()
                ->performedOn($event->model)
                ->causedBy(auth()->user())
                ->event('updated')
                ->withProperties([
                    'permission_id' => $permission->id,
                    'permission_name' => $permission->name,
                ])
                ->log("Permission '{$permission->name}' attached to {$event->model->name}");
        }
    }
}
