<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|confirmed',
            'role' => 'required|string|in:admin,publisher'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        if (!$user) {
            return back()->with('error', 'User not created.');
        }

        return redirect()->route('admin.users.index')->with('success', 'User created.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|string|in:admin,publisher,client'
        ]);

        $isUpdated = $user->update([
            'role' => $request->role
        ]);

        if (!$isUpdated) {
            return back()->with('error', 'User not updated.');
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        $isDeleted = $user->delete();

        if (!$isDeleted) {
            return back()->with('error', 'User not deleted.');
        }

        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }
}
