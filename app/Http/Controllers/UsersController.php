<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        // $roles = Role::all();
        // return view('dashboard.admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Handle user creation
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
