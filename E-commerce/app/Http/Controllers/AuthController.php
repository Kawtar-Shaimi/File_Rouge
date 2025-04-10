<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendResetPasswordRequest;
use App\Mail\EmailVerified;
use App\Mail\PasswordReseted;
use App\Mail\ResetPasswordToken;
use App\Mail\VerifyEmailLink;
use App\Models\Client;
use App\Models\EmailVerificationToken;
use App\Models\PasswordResetToken;
use App\Models\Publisher;
use App\Models\User;
use App\Notifications\EmailVerified as NotificationsEmailVerified;
use App\Notifications\PasswordReseted as NotificationsPasswordReseted;
use App\Notifications\VerifyEmailLink as NotificationsVerifyEmailLink;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guestAll')->except('logout', 'verifyEmail', 'verifyNotice', 'resendVerificationEmail', 'generateEmailVerificationToken');
        $this->middleware('authAll')->only('logout', 'verifyEmail', 'verifyNotice', 'resendVerificationEmail', 'generateEmailVerificationToken');
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();

        $remember = $request->has('remember');

        $guards = ['client', 'publisher', 'admin'];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->attempt($validatedData, $remember)) {

                $user = Auth::guard($guard)->user();

                Auth::guard($guard)->login($user, $remember);

                return match ($guard) {
                    'client' => redirect()->route('home'),
                    'publisher' => redirect()->route('publisher.index'),
                    'admin' => redirect()->route('admin.index'),
                    default => redirect()->back()->with('error', 'Error while logging in, try again later.')
                };
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['uuid'] = Str::uuid();

        $remember = $request->has('remember');

        switch ($request->role) {
            case 'client': {
                    $user = Client::create($validatedData);

                    Auth::guard('client')->login($user, $remember);

                    break;
                }
            case 'publisher': {
                    $user = Publisher::create($validatedData);

                    Auth::guard('publisher')->login($user, $remember);

                    break;
                }

            default: {
                    return redirect()->back()->with('error', 'Error while register try again later.');
                }
        }


        $token = $this->generateEmailVerificationToken($user->uuid);


        $url = route('verify.email', [
            'uuid' => $user->uuid,
            'token' => $token,
        ]);

        Mail::to($user->email)->send(new VerifyEmailLink($url));

        Notification::send($user, new NotificationsVerifyEmailLink());

        return redirect()->route('verify.notice', $user->uuid)->with('success', 'Registration successful.');
    }

    public function logout($guard)
    {
        if (!in_array($guard, ['client', 'publisher', 'admin'])) {
            return redirect()->back()->with('error', 'Invalid user type for logout.');
        }

        Auth::guard($guard)->logout();

        return redirect()->route('loginView');
    }

    public static function generateEmailVerificationToken(string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        EmailVerificationToken::where('user_id', $user->id)->delete();

        $token = Str::random(64);
        $expiresAt = now()->addMinutes(15);

        EmailVerificationToken::create([
            'user_id' => $user->id,
            'token' => hash('sha256', $token),
            'expires_at' => $expiresAt,
        ]);

        return $token;
    }

    public function verifyEmail(string $uuid, $token)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        if (!$user) {
            return redirect()->route('verify.notice', $user->uuid)->with('error', 'User not found.');
        }

        $hash = EmailVerificationToken::where('user_id', $user->id)
            ->where('expires_at', '>', now())
            ->first();

        if (!$token || !hash_equals($hash->token, hash('sha256', $token))) {
            return redirect()->route('verify.notice', $user->uuid)->with('error', 'Invalid or expired token.');
        }

        $isUpdated = $user->update([
            'email_verified_at' => now(),
        ]);

        if (!$isUpdated) {
            return redirect()->route('verify.notice', $user->uuid)->with('error', 'Error while verifying email, try again later.');
        }

        $isDeleted = $hash->delete();

        if (!$isDeleted) {
            return redirect()->route('verify.notice', $user->uuid)->with('error', 'Error while deleting token, try again later.');
        }

        Mail::to($user->email)->send(new EmailVerified($user, $user->role));

        Notification::send($user, new NotificationsEmailVerified($user, $user->role));

        return redirect()->route('home')->with('success', 'Email verified successfully.');
    }

    public function verifyNotice(string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if ($user->email_verified_at) {
            return redirect()->route('home')->with('success', 'Email already verified.');
        }

        return view('auth.verify-notice', compact('user'));
    }

    public function resendVerificationEmail(string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if ($user->email_verified_at) {
            return redirect()->route('home')->with('success', 'Email already verified.');
        }

        $token = $this->generateEmailVerificationToken($user->uuid);

        $url = route('verify.email', [
            'uuid' => $user->uuid,
            'token' => $token,
        ]);

        Mail::to($user->email)->send(new VerifyEmailLink($url));

        Notification::send($user, new NotificationsVerifyEmailLink());

        return redirect()->back()->with('success', 'Verification email resent successfully.');
    }

    public function forgetPassword()
    {
        return view('auth.forget-password');
    }

    public static function generateResetPasswordToken(string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        PasswordResetToken::where('user_id', $user->id)->delete();


        $token = Str::random(64);
        $expiresAt = now()->addMinutes(15);

        PasswordResetToken::create([
            'user_id' => $user->id,
            'token' => hash('sha256', $token),
            'expires_at' => $expiresAt,
        ]);

        return $token;
    }

    public function sendResetPassword(SendResetPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email not found.');
        }

        $token = $this->generateResetPasswordToken($user->uuid);

        $url = route('reset.password', [
            'uuid' => $user->uuid,
            'token' => $token,
        ]);

        Mail::to($user->email)->send(new ResetPasswordToken($url));

        return redirect()->route('reset.notice', $user->uuid)->with('success', 'Reset password email sent successfully.');
    }

    public function resetNotice(string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        return view('auth.reset-notice', compact('user'));
    }

    public function resendResetPasswordEmail(string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $token = $this->generateResetPasswordToken($user->uuid);

        $url = route('reset.password', [
            'uuid' => $user->uuid,
            'token' => $token,
        ]);

        Mail::to($user->email)->send(new ResetPasswordToken($url));

        return redirect()->back()->with('success', 'Reset password email resent successfully.');
    }

    public function verifyResetPassword(string $uuid, $token)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        if (!$user) {
            return redirect()->route('reset.notice', $user->uuid)->with('error', 'User not found.');
        }

        $hash = PasswordResetToken::where('user_id', $user->id)
            ->where('expires_at', '>', now())
            ->first();

        if (!$token || !hash_equals($hash->token, hash('sha256', $token))) {
            return redirect()->route('reset.notice', $user->uuid)->with('error', 'Invalid or expired token.');
        }

        return view('auth.auth.reset-password', compact('user'));
    }

    public function resetPassword(ResetPasswordRequest $request, string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        PasswordResetToken::where('user_id', $user->id)->delete();

        Mail::to($user->email)->send(new PasswordReseted($user));

        Notification::send($user, new NotificationsPasswordReseted($user->role));

        return redirect()->route('loginView')->with('success', 'Password reset successfully.');
    }
}
