<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Kalau belum login
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        // Kalau bukan admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')
                ->with('error', 'Akses ditolak! Hanya admin.');
        }

        return $next($request);
    }
}
