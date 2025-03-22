<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth.login');
    }

    public function registerView()
    {
        return view('auth.register');
    }

    public function login(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($validatedData, $remember)) {

            if(Auth::user()->role == 'client'){
                return redirect()->route('home');
            }elseif(Auth::user()->role == 'publisher'){
                return redirect()->route('publisher.index');
            }

            return redirect()->route('admin.index');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'role' => 'required|in:client,publisher',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        $remember = $request->has('remember');

        Auth::login($user, $remember);

        if($user->role == 'client'){
            return redirect()->route('home');
        }

        return redirect()->route('publisher.index');
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('loginView');
    }
}

