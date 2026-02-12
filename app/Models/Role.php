<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

/**
 * Role Model
 * 
 * Extends Spatie's Role model to provide role-based access control.
 * Uses ULID instead of auto-incrementing integers for primary keys.
 * All role changes are logged for audit purposes.
 * 
 * @property string $id ULID primary key
 * @property string $name Role name (e.g., 'Super Admin', 'User')
 * @property string $guard_name Guard name (default: 'web')
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Role extends SpatieRole
{
    use HasUlids, LogsActivity;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Get the activity log options.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'guard_name'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('role')
            ->setDescriptionForEvent(fn(string $eventName) => match($eventName) {
                'created' => "Role '{$this->name}' was created",
                'updated' => "Role '{$this->name}' was updated",
                'deleted' => "Role '{$this->name}' was deleted",
                default => "{$eventName} on role '{$this->name}'",
            });
    }
}
