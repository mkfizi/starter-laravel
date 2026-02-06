<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:roles:read')->only(['index', 'show']);
        $this->middleware('can:roles:create')->only(['create', 'store']);
        $this->middleware('can:roles:update')->only(['edit', 'update']);
        $this->middleware('can:roles:delete')->only(['destroy']);
    }

    /**
     * Display role listing.
     */
    public function index(Request $request): View
    {
        $perPage = $request->input('per_page', 10);

        $query = Role::withCount('users');
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%$search%");
        }
        $roles = $query->paginate($perPage)->appends(['search' => $search]);
        return view('dashboard.admin.roles.index')->with([
            'roles' => $roles
        ]);
    }

    /**
     * Show create new role form.
     */
    public function create(): View
    {
        return view('dashboard.admin.roles.create');
    }

    /**
     * Store a newly created role in the storage.
     */
    public function store(RoleRequest $request): RedirectResponse
    {
        $role = Role::create([
            'name' => $request->input('name')
        ]);
        $role->syncPermissions($request->input('permissions', []));

        return redirect()->route('dashboard.admin.roles.index')
            ->with('status', __("Role :name record created successfully.", ['name' => $role->name]));
    }

    /**
     * Display the specified roles.
     */
    public function show(string $id): View
    {
        $role = Role::findOrFail($id);

        // Get roles and sort where super admin is first and then by name
        $roles = Role::all()->sortByDesc(function ($role) {
            return $role->name === 'Super Admin' ? 1 : 0;
        })->sortBy('name');
        
        return view('dashboard.admin.roles.show')->with([
            'roles' => $roles,
            'role' => $role,
        ]);
    }

    /**
     * Show the form for editing the specified roles.
     */
    public function edit(string $id): View|RedirectResponse
    {
        $role = Role::findOrFail($id);

        if ($this->isProtectedFromEdit($role)) {
            return redirect()->route('dashboard.admin.roles.index')
                ->with('status', __("This role is protected and cannot be edited."));
        }

        return view('dashboard.admin.roles.edit')->with([
            'role' => $role
        ]);
    }

    /**
     * Update the specified role in storage.
     */
    public function update(RoleRequest $request, string $id): RedirectResponse
    {
        $role = Role::findOrFail($id);

        if ($this->isProtectedFromEdit($role)) {
            return redirect()->route('dashboard.admin.roles.index')
                ->with('status', __("This role is protected and cannot be edited."));
        }

        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permissions', []));

        return redirect()->back()
            ->with('status', __('Role record updated successfully.'));
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $role = Role::findOrFail($id);

        if ($this->isProtectedFromDelete($role)) {
            return redirect()->route('dashboard.admin.roles.index')
                ->with('status', __("This role is protected and cannot be deleted."));
        }

        $roleName = $role->name;
        $role->delete();

        return redirect()->route('dashboard.admin.roles.index')
            ->with('status', __("Role :name record deleted successfully.", ['name' => $roleName]));
    }

    /**
     * Check if role is protected from editing.
     */
    private function isProtectedFromEdit(Role $role): bool
    {
        return in_array($role->name, config('permission.role_permission.protected.edit', []));
    }

    /**
     * Check if role is protected from deletion.
     */
    private function isProtectedFromDelete(Role $role): bool
    {
        return in_array($role->name, config('permission.role_permission.protected.delete', []));
    }
}
