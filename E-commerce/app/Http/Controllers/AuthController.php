<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmailLink;
use App\Models\Client;
use App\Models\EmailVerificationToken;
use App\Models\Publisher;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guestAll')->except('logout', 'verifyEmail', 'verifyNotice', 'resendVerificationEmail');
        $this->middleware('authAll')->only('logout', 'verifyEmail', 'verifyNotice', 'resendVerificationEmail');
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function login(Request $request){
        try {
            $validatedData = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

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

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while logging in, try again later.');
        }
    }

    public function register(Request $request){
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|unique:users,phone',
                'role' => 'required|in:client,publisher',
                'password' => 'required|confirmed'
            ]);

            $validatedData['password'] = Hash::make($validatedData['password']);

            $remember = $request->has('remember');

            switch ($request->role) {
                case 'client':{
                    $user = Client::create($validatedData);

                    Auth::guard('client')->login($user, $remember);

                    break;
                }
                case 'publisher':{
                    $user = Publisher::create($validatedData);

                    Auth::guard('publisher')->login($user, $remember);

                    break;
                }

                default:{
                    return redirect()->back()->with('error', 'Error while register try again later.');
                }
            }

            $token = $this->generateEmailVerificationToken($user);

            $url = route('verify.email', [
                'id' => $user->id,
                'token' => $token,
            ]);

            Mail::to($user->email)->send(new VerifyEmailLink($url));

            return redirect()->route('verify.notice', $user->id)->with('success', 'Registration successful.');

        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while register try again later.');
        }
    }

    public function logout($guard){
        try {
            if (!in_array($guard, ['client', 'publisher', 'admin'])) {
                return redirect()->back()->with('error', 'Invalid user type for logout.');
            }

            Auth::guard($guard)->logout();

            return redirect()->route('loginView');

        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while logout try again later.');
        }
    }

    public static function generateEmailVerificationToken($userId)
    {

        $user = Client::find($userId) ?? Publisher::find($userId);

        EmailVerificationToken::where('user_id', $user->id)->delete();


        $token = Str::random(64);
        $expiresAt = now()->addMinutes(15);

        $user->emailVerificationTokens()->create([
            'user_id' => $user->id,
            'token' => hash('sha256', $token),
            'expires_at' => $expiresAt,
        ]);

        return $token;
    }

    public function verifyEmail($id, $token)
    {
        $user = Client::find($id) ?? Publisher::find($id);

        if (!$user) {
            return redirect()->route('verify.notice', $user->id)->with('error', 'User not found.');
        }

        $hash = EmailVerificationToken::where('user_id', $user->id)
        ->where('expires_at', '>', now())
        ->first();

        if (!$token || !hash_equals($hash->token, hash('sha256', $token))) {
            return redirect()->route('verify.notice', $user->id)->with('error', 'Invalid or expired token.');
        }

        $isUpdated = $user->update([
            'email_verified_at' => now(),
        ]);

        if (!$isUpdated) {
            return redirect()->route('verify.notice', $user->id)->with('error', 'Error while verifying email, try again later.');
        }

        $isDeleted = $hash->delete();

        if (!$isDeleted) {
            return redirect()->route('verify.notice', $user->id)->with('error', 'Error while deleting token, try again later.');
        }

        return redirect()->route('home')->with('success', 'Email verified successfully.');
    }

    public function verifyNotice($userId)
    {
        $user = Client::find($userId) ?? Publisher::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if ($user->email_verified_at) {
            return redirect()->route('home')->with('success', 'Email already verified.');
        }

        return view('auth.verify-notice', compact('user'));
    }
    
    public function resendVerificationEmail($userId)
    {
        $user = Client::find($userId) ?? Publisher::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if ($user->email_verified_at) {
            return redirect()->route('home')->with('success', 'Email already verified.');
        }

        $token = $this->generateEmailVerificationToken($user->id);

        $url = route('verify.email', [
            'id' => $user->id,
            'token' => $token,
        ]);

        Mail::to($user->email)->send(new VerifyEmailLink($url));

        return redirect()->back()->with('success', 'Verification email resent successfully.');
    }
}

