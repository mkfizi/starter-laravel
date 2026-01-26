<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach(config('permission.role_permission.permissions') as $module) {
            foreach ($module['permissions'] as $permission) {
                Permission::create(['name' => $permission['name']]);
            }
        }

        // update cache to know about the newly created permissions (required if using WithoutModelEvents in seeders)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create super admin role and assign all permissions
        $role = Role::create(['name' => 'Super Admin']);

        // Explicitly assign all permissions for database consistency
        $role->givePermissionTo(Permission::all());

        // Create predefined roles with permissions
        $roles = [
            [
                'name' => 'User',
                'permissions' => [
                    'dashboard-user:read',
                ]
            ],
        ];

        foreach($roles as $roleData) {
            $role = Role::create(['name' => $roleData['name']]);
            foreach ($roleData['permissions'] as $permission) {
                $role->givePermissionTo($permission);
            }
        }
    }
}
