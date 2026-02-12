<?php

namespace App\Listeners;

use Spatie\Permission\Events\PermissionDetachedEvent;

/**
 * Log Permission Detached Listener
 * 
 * Listens to the PermissionDetachedEvent event from Spatie Permission package
 * and logs it to the activity log for audit purposes.
 */
class LogPermissionDetached
{
    /**
     * Handle the permission detached event.
     * 
     * Records when a permission is detached from a model in the activity log.
     * 
     * @param PermissionDetachedEvent $event The permission detached event
     * @return void
     */
    public function handle(PermissionDetachedEvent $event): void
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
                ->log("Permission '{$permission->name}' detached from {$event->model->name}");
        }
    }
}
