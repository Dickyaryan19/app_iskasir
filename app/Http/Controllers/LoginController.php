<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan formulir login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Memproses permintaan login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek kredensial pengguna
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Jika berhasil, redirect ke halaman dashboard
            return redirect()->intended('dashboard')->with('success', 'Login berhasil!');
        }

        // Jika gagal, redirect kembali dengan pesan error
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }
    // Logout pengguna
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
