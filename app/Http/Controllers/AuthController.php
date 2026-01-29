<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard');
            }
            return redirect('/user/dashboard');
        }

        return back()->withErrors(['username' => 'Login failed.']);
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $req = $request->validate([
            'name' => 'required',
            'nis' => 'nullable|numeric',
            'username' => 'required|unique:users',
            'password' => 'required|min:4',
            'address' => 'required'
        ]);

        $req['password'] = bcrypt($req['password']);
        $req['role'] = 'user';

        $user = User::create($req);

        Auth::login($user);

        return redirect('/user/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
