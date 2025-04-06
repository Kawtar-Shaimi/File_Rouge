<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmailLink;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin')->except(['changePasswordView', 'changePassword', 'editProfile', 'updateProfile']);
        $this->middleware('authAll')->only(['changePasswordView', 'changePassword', 'editProfile', 'updateProfile']);
    }

    public function index()
    {
        try {
            $users = User::paginate(10);
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

    public function changePasswordView(User $user){
        return view('users.change-password', compact('user'));
    }

    public function changePassword(Request $request, User $user)
    {
        try {
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

            return match ($user->role) {
                'admin' => redirect()->route('admin.profile')->with('success', 'Password updated successfully.'),
                'publisher' => redirect()->route('publisher.profile')->with('success', 'Password updated successfully.'),
                default => redirect()->route('client.index')->with('success', 'Password updated successfully.')
            };
        }catch (Exception $e) {
            return redirect()->back()->with('error', value: 'Error while updating password try again later.');
        }
    }

    public function editProfile(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function updateProfile(Request $request, User $user)
    {
        try {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' .  $user->id,
                'phone' => 'required|unique:users,phone,' .  $user->id,
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
                    'user' => $user,
                    'token' => $token,
                ]);

                Mail::to($request->email)->send(new VerifyEmailLink($url));

                return redirect()->route('verify.notice', $user)->with('success', 'Profile updated successfully, please verify your new email address.');
            }

            return match ($user->role) {
                'admin' => redirect()->route('admin.profile')->with('success', 'Profile updated successfully'),
                'publisher' => redirect()->route('publisher.profile')->with('success', 'Profile updated successfully'),
                default => redirect()->route('client.index')->with('success', 'Profile updated successfully')
            };
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while updating profile try again later.');
        }
    }
}