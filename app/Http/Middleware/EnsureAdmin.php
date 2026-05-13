<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * EnsureAdmin: Middleware proteksi halaman admin.
 * Semua route di bawah prefix /admin wajib melewati middleware ini.
 *
 * Best practice Laravel 12+: daftarkan di bootstrap/app.php (withMiddleware).
 */
class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login → redirect ke halaman login admin
        if (!Auth::check()) {
            return redirect()
                ->route('admin.login')
                ->with('info', 'Silakan login terlebih dahulu untuk mengakses area admin.');
        }

        return $next($request);
    }
}
