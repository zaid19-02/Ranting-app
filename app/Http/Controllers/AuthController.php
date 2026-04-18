<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if ($request->role == 'admin') {
            return redirect()->route('login.admin.form');
        } else {
            session(['role' => 'user', 'login' => true]);
            return redirect('/dashboard');
        }
    }

    public function showAdminLoginForm()
    {
        return view('admin_login');
    }

    public function adminLogin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if ($username == 'admin' && $password == 'admin123') {
            session(['role' => 'admin', 'login' => true, 'user_name' => 'Administrator']);
            return redirect('/dashboard')->with('success', 'Selamat datang, Administrator!');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
