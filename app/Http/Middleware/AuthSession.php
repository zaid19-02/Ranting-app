<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthSession
{
    public function handle(Request $request, Closure $next)
    {
        // hanya admin yang boleh akses route ini
        if (session('role') !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses hanya untuk admin!');
        }

        return $next($request);
    }
}
