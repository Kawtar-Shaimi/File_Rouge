<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        try {
            $users = User::all();
            return view('admin.users.index', compact('users'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', value: 'Error while getting users try again later.');
        }
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
        try {
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

            return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', value: 'Error while creating user try again later.');
        }
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'role' => 'required|string|in:admin,publisher,client'
            ]);

            $isUpdated = $user->update([
                'role' => $request->role
            ]);

            if (!$isUpdated) {
                return back()->with('error', 'User role not updated.');
            }

            return redirect()->route('admin.users.index')->with('success', 'User role updated successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', value: 'Error while updating user role try again later.');
        }
    }

    public function destroy(User $user)
    {
        try {
            $isDeleted = $user->delete();

            if (!$isDeleted) {
                return back()->with('error', 'User not deleted.');
            }

            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', value: 'Error while deleting user try again later.');
        }
    }
}
