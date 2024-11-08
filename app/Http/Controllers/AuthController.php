<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Hardcoded credentials
        $validEmail = 'admin@gmail.com';
        $validPassword = '123456';

        if ($request->email === $validEmail && $request->password === $validPassword) {
            session(['user' => [
                'email' => $validEmail,
                'name' => 'Administrator'
            ]]);
            
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        session()->forget('user');
        return redirect()->route('login');
    }
} 