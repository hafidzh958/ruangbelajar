<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * AdminLoginController: Menangani autentikasi admin.
 * - showLoginForm(): tampil halaman login
 * - login(): proses login (validasi + authenticate)
 * - logout(): proses logout dan redirect ke login
 */
class AdminLoginController extends Controller
{
    /**
     * Tampilkan halaman login admin (GET /admin/login).
     * Jika sudah login, langsung redirect ke dashboard.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Proses login (POST /admin/login).
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Regenerate session untuk mencegah session fixation attack
            $request->session()->regenerate();

            return redirect()
                ->intended(route('admin.dashboard'))
                ->with('success', '👋 Selamat datang, ' . Auth::user()->name . '!');
        }

        // Login gagal → kembali ke form dengan error
        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'Email atau password yang Anda masukkan salah.',
            ]);
    }

    /**
     * Logout admin (POST /admin/logout).
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.login')
            ->with('success', 'Anda berhasil logout. Sampai jumpa! 👋');
    }
}
