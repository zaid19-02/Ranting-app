<?php
// app/Http/Middleware/AdminMiddleware.php (Opsional)
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (session('role') !== 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak! Hanya admin yang bisa mengakses halaman ini.');
        }
        return $next($request);
    }
}
