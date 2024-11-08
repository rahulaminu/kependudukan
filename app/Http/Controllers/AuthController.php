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

        $email = $request->input('email');
        $password = $request->input('password');

        // Hardcoded credentials
        $validEmail = 'admin@example.com';
        $validPassword = 'admin123';

        if ($email === $validEmail && $password === $validPassword) {
            // Simulate login success
            session(['user' => $validEmail]);
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login');
    }
} 