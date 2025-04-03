<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Publisher;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guestAll')->except('logout');
        $this->middleware('authAll')->only('logout');
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
                    $client = Client::create($validatedData);

                    Auth::guard('client')->login($client, $remember);

                    return redirect()->route('home');
                }
                case 'publisher':{
                    $publisher = Publisher::create($validatedData);

                    Auth::guard('publisher')->login($publisher, $remember);

                    return redirect()->route('publisher.index');
                }

                default:{
                    return redirect()->back()->with('error', 'Error while register try again later.');
                }
            }

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
}

