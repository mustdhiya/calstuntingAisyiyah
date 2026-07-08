<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLogin()
    {
        // Jika sudah login, redirect ke dashboard admin
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Proses form login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        // Coba autentikasi
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            // Pastikan user aktif
            if (! $user->is_active) {
                Auth::logout();
                return back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => 'Akun Anda dinonaktifkan. Hubungi administrator.']);
            }

            // Hanya admin_wilayah dan koordinator_cabang yang bisa akses dashboard
            $allowedRoles = ['admin_wilayah', 'koordinator_cabang'];
            if (! in_array($user->role, $allowedRoles)) {
                Auth::logout();
                return back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => 'Anda tidak memiliki akses ke panel admin.']);
            }

            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Email atau kata sandi salah. Silakan coba lagi.',
            ]);
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah keluar dari sistem.');
    }
}
