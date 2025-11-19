<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class RolesController extends Controller
{
    /**
     * Display role listing.
     */
    public function index() : View
    {
        $roles = Role::withCount('users')->paginate(10);
        return view('dashboard.admin.roles.index')->with([
            'roles' => $roles
        ]);
    }

    /**
     * Show create new role form.
     */
    public function create() : View
    {
        return view('dashboard.admin.roles.create');
    }

    /**
     * Store a newly created role in the storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'string|distinct|exists:permissions,name'
        ]);

        $role = Role::create([
            'name' => $request->input('name')
        ]);
        $role->syncPermissions($request->input('permissions', []));

        return redirect()->route('dashboard.admin.roles.index')
            ->with('status', "Role $role->name created successfully.");
    }

    /**
     * Display the specified roles.
     */
    public function show(string $id) : View
    {
        // Get roles and sort where super admin is first and then by name
        $roles = Role::all()->sortByDesc(function ($role) {
            return $role->name === 'Super Admin' ? 1 : 0;
        })->sortBy('name');
        
        $role = Role::findOrFail($id);
        return view('dashboard.admin.roles.show')->with([
            'roles' => $roles,
            'role' => $role,
        ]);
    }

    /**
     * Show the form for editing the specified roles.
     */
    public function edit(string $id) : View
    {
        if (in_array($id, config('permission.role_permission.protected.edit'))) {
            return redirect()->route('dashboard.admin.roles.index')
                ->with('status', "This role is protected and cannot be edited.");
        }

        $role = Role::findOrFail($id);
        return view('dashboard.admin.roles.edit')->with([
            'role' => $role
        ]);
    }

    /**
     * Update the specified role in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        if (in_array($role->name, config('permission.role_permission.protected.delete'))) {
            return redirect()->route('dashboard.admin.roles.index')
                ->with('status', "This role is protected and cannot be deleted.");
        }

        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'permissions' => 'array',
            'permissions.*' => 'string|distinct|exists:permissions,name'
        ]);

        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permissions', []));

        return redirect()->route('dashboard.admin.roles.index')
            ->with('status', "Role $role->name updated successfully.");
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        if (in_array($role->name, config('permission.role_permission.protected.delete'))) {
            return redirect()->route('dashboard.admin.roles.index')
                ->with('status', "This role is protected and cannot be deleted.");
        }

        $roleName = $role->name;
        $role->delete();

        return redirect()->route('dashboard.admin.roles.index')
            ->with('status', "Role $roleName deleted successfully.");
    }
}
