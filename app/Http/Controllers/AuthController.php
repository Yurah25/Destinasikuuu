<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Tampilkan Halaman Login
    public function index()
    {
        return view('login');
    }

    // 2. Proses Login (Sesuai Diagram Sequence)
    public function authenticate(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Cek ke Database (Auth::attempt otomatis hash checking)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Jika sukses, redirect ke Dashboard
            return redirect()->intended('/dashboard');
        }

        // Jika gagal, kembalikan dengan pesan error
        return back()->with('loginError', 'Login gagal! Username atau password salah.');
    }

    // 3. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}