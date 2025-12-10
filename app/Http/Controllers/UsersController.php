<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        // List users
        $users = User::with('roles')->paginate();
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
