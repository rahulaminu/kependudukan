<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',  // Tambahkan validasi email
            'password' => 'required',
        ], [
            'email.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
            'email.email' => 'Format email tidak valid',  // Pesan untuk validasi email
        ]);

        // Mencari user berdasarkan email
        $user = User::where('email', $request->email)->first();
        // Jika user ditemukan dan password valid
        if ($user) {
            // Set session atau login manual (jika Anda ingin menyimpan sesi pengguna)
            Auth::login($user);

            // Redirect ke home setelah login sukses
            return redirect()->route('home');
        } else {
            // Jika login gagal, kembali ke halaman login dengan pesan error
            return redirect()->route('login')->with('failed', 'Username atau password salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Berhasil Logout');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_proses(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Membuat pengguna baru
        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Menggunakan Bcrypt
        $user->save();

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }

}