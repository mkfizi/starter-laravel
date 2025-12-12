<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewUserCredentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
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
        $users = $query->paginate($perPage)->appends($request->only(['search', 'per_page']));
        return view('dashboard.admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('dashboard.admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'array',
            'roles.*' => 'exists:roles,id'
        ]);

        $password = $request->input('password');
        
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($password),
            'must_change_password' => $request->has('must_change_password'),
        ]);

        if ($request->has('roles')) {
            $user->syncRoles($request->input('roles'));
        }

        $user->notify(new NewUserCredentials($password));

        return redirect()->route('dashboard.admin.users.index')
            ->with('status', "User {$user->name} created successfully.");
    }

    public function show($id)
    {
        $user = User::with('roles')->findOrFail($id);
        return view('dashboard.admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        // $user = User::with('roles')->findOrFail($id);
        // $roles = Role::all();
        // return view('dashboard.admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        // Handle user update
    }

    public function destroy($id)
    {
        // Handle user deletion
    }
}
