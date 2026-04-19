<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // FORM LOGIN
    public function showLoginForm()
    {
        return view('login');
    }

    // PROSES LOGIN
    public function login(Request $request)
    {
        // VALIDASI
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // DATA LOGIN
        $credentials = $request->only('email', 'password');

        // CEK LOGIN
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // 🔥 REDIRECT BERDASARKAN ROLE
            if ($user->role === 'admin') {
                return redirect()->route('dashboard')
                    ->with('success', 'Selamat datang Admin!');
            }

            return redirect()->route('dashboard')
                ->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Email atau password salah');
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
