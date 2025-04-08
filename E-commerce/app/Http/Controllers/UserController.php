<?php

namespace App\Http\Controllers;

use App\Mail\PasswordUpdated;
use App\Mail\VerifyNewEmail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->except(['changePasswordView', 'changePassword', 'editProfile', 'updateProfile']);
        $this->middleware('authAll')->only(['changePasswordView', 'changePassword', 'editProfile', 'updateProfile']);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function show(string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
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
            'uuid' => Str::uuid(),
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
    }

    public function edit(string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

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
    }

    public function destroy(string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        $isDeleted = $user->delete();

        if (!$isDeleted) {
            return back()->with('error', 'User not deleted.');
        }

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function changePasswordView(string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        return view('users.change-password', compact('user'));
    }

    public function changePassword(Request $request, string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Old password is incorrect.');
        }

        $isUpdated = $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        if (!$isUpdated) {
            return back()->with('error', 'Password not updated.');
        }

        Mail::to($user->email)->send(new PasswordUpdated($user, $user->role));

        return match ($user->role) {
            'admin' => redirect()->route('admin.profile')->with('success', 'Password updated successfully.'),
            'publisher' => redirect()->route('publisher.profile')->with('success', 'Password updated successfully.'),
            default => redirect()->route('client.index')->with('success', 'Password updated successfully.')
        };
    }

    public function editProfile(string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        return view('users.edit', compact('user'));
    }

    public function updateProfile(Request $request, string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email," .  $user->id,
            "phone" => "required|unique:users,phone," .  $user->id,
        ]);

        $isEmailUpdated = $request->email !== $user->email;

        $isUpdated = $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if (!$isUpdated) {
            return redirect()->back()->with('error', 'Error while updating profile try again later.');
        }

        if ($isEmailUpdated) {

            $user->email_verified_at = null;
            $user->save();
            $token = AuthController::generateEmailVerificationToken($user);
            $url = route('verify.email', [
                'uuid' => $user->uuid,
                'token' => $token,
            ]);

            Mail::to($request->email)->send(new VerifyNewEmail($url));

            return redirect()->route('verify.notice', $user->uuid)->with('success', 'Profile updated successfully, please verify your new email address.');
        }
    }
}
