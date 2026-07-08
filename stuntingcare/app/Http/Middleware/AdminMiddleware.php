<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login, redirect ke halaman login
        if (! Auth::check()) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Silakan login terlebih dahulu untuk mengakses halaman ini.']);
        }

        $user = Auth::user();

        // Cek apakah user aktif
        if (! $user->is_active) {
            Auth::logout();
            return redirect()->route('login')
                ->withErrors(['email' => 'Akun Anda dinonaktifkan. Hubungi administrator.']);
        }

        // Hanya admin_wilayah dan koordinator_cabang yang bisa akses panel admin
        $allowedRoles = ['admin_wilayah', 'koordinator_cabang'];
        if (! in_array($user->role, $allowedRoles)) {
            Auth::logout();
            return redirect()->route('login')
                ->withErrors(['email' => 'Anda tidak memiliki akses ke panel admin.']);
        }

        return $next($request);
    }
}
