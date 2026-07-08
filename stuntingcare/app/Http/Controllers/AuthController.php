<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
     * Tampilkan halaman register.
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.register');
    }

    /**
     * Proses form register (role default: pengguna_umum).
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'unique:users,email'],
            'phone_number'          => ['nullable', 'string', 'max:20'],
            'city'                  => ['nullable', 'string', 'max:100'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required'         => 'Nama lengkap wajib diisi.',
            'email.required'        => 'Alamat email wajib diisi.',
            'email.unique'          => 'Email ini sudah terdaftar.',
            'password.min'          => 'Kata sandi minimal 8 karakter.',
            'password.confirmed'    => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        User::create([
            'name'         => $validated['name'],
            'email'        => $validated['email'],
            'phone_number' => $validated['phone_number'] ?? null,
            'city'         => $validated['city'] ?? null,
            'password'     => Hash::make($validated['password']),
            'role'         => 'pengguna_umum',
            'is_active'    => true,
        ]);

        return redirect()->route('login')
            ->with('success', 'Akun berhasil dibuat! Silakan masuk untuk melanjutkan.');
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
