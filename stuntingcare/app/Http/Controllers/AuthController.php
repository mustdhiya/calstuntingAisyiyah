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
        if (Auth::check()) {
            return Auth::user()->isPenggunaUmum()
                ? redirect()->route('home')
                : redirect()->route('admin.dashboard');
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

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            // Pastikan user aktif
            if (! $user->is_active) {
                Auth::logout();
                return back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => 'Akun Anda dinonaktifkan. Hubungi administrator.']);
            }

            // Pastikan hanya role admin_wilayah yang diperbolehkan login
            if (! $user->isAdminWilayah()) {
                Auth::logout();
                return back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => 'Hanya Administrator yang diperbolehkan masuk.']);
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
