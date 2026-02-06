<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Notifications\NewUserCredentials;
use App\Notifications\PasswordUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:users:read')->only(['index', 'show']);
        $this->middleware('can:users:create')->only(['create', 'store']);
        $this->middleware('can:users:update')->only(['edit', 'update']);
        $this->middleware('can:users:delete')->only(['destroy']);
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $query = User::with('roles');
        
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }
        
        if ($roles = $request->input('roles')) {
            $query->whereHas('roles', function($q) use ($roles) {
                $q->whereIn('name', $roles);
            });
        }
        
        $users = $query->paginate($perPage)->appends($request->only(['search', 'per_page', 'roles']));
        $roles = Role::all();
        return view('dashboard.admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('dashboard.admin.users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $password = $request->input('password');
        
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($password),
            'must_change_password' => $request->has('must_change_password'),
        ]);

        if ($request->has('roles')) {
            $roles = Role::whereIn('id', $request->input('roles'))->get();
            $user->syncRoles($roles);
        }

        $user->notify(new NewUserCredentials($password));

        return redirect()->route('dashboard.admin.users.index')
            ->with('status', __("User :name record created successfully.", ['name' => $user->name]));
    }

    public function show($id)
    {
        $user = User::with('roles')->findOrFail($id);
        return view('dashboard.admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        
        if ($user->email === config('app.super_admin')) {
            return redirect()->route('dashboard.admin.users.index')
                ->with('error', __('Super admin cannot be edited.'));
        }
        
        $roles = Role::all();
        return view('dashboard.admin.users.edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->email === config('app.super_admin')) {
            return redirect()->route('dashboard.admin.users.index')
                ->with('error', __('Super admin cannot be updated.'));
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->must_change_password = $request->has('must_change_password');

        if ($request->filled('password')) {
            $newPassword = $request->input('password');
            $user->password = Hash::make($newPassword);
            $passwordChanged = true;
        } else {
            $passwordChanged = false;
        }

        $user->save();

        if ($request->has('roles')) {
            $roles = Role::whereIn('id', $request->input('roles'))->get();
            $user->syncRoles($roles);
        } else {
            $user->syncRoles([]);
        }

        if ($passwordChanged) {
            $user->notify(new PasswordUpdated($newPassword));
        }

        return redirect()->back()
            ->with('status', __('User record updated successfully.'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->email === config('app.super_admin')) {
            return redirect()->route('dashboard.admin.users.index')
                ->with('error', __('Super admin cannot be deleted.'));
        }
        
        if ($user->id === auth()->id()) {
            return redirect()->route('dashboard.admin.users.index')
                ->with('error', __('You cannot delete your own account.'));
        }
        
        $userName = $user->name;
        $user->delete();
        
        return redirect()->route('dashboard.admin.users.index')
            ->with('status', __("User :name record deleted successfully.", ['name' => $userName]));
    }
}
