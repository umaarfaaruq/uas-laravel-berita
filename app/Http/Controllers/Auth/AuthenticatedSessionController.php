<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User; // Pastikan ini diimpor untuk mengakses model User

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate(); // Melakukan proses autentikasi

        $request->session()->regenerate(); // Regenerasi ID sesi

        $user = Auth::user(); // Dapatkan instance user yang sedang login

        // Logika pengalihan berdasarkan peran pengguna
        if ($user->hasAnyRole(['Admin', 'Editor', 'Wartawan'])) {
            // Jika user memiliki peran Admin, Editor, atau Wartawan, arahkan ke dashboard admin
            return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);
        } else if ($user->hasRole('User')) {
            // Jika user memiliki peran User, arahkan ke dashboard user biasa
            return redirect()->intended(RouteServiceProvider::USER_DASHBOARD);
        }

        // Fallback: Jika tidak ada peran yang cocok atau peran lain, arahkan ke halaman utama atau halaman default lainnya.
        // Anda bisa mengubah ini ke halaman yang lebih spesifik jika diperlukan.
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
