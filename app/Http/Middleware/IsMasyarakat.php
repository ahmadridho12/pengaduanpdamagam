<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsMasyarakat
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah rute saat ini adalah rute yang diizinkan untuk diakses tanpa autentikasi
        if ($request->is('laporan')) {
            return $next($request);
        }

        // Pemeriksaan autentikasi untuk pengguna 'masyarakat'
        if (Auth::guard('masyarakat')->check()) {
            return $next($request);
        }

        return redirect('/');
    }
}
