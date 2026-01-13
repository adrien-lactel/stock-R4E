<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        // =====================
        // VALIDATION
        // =====================
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // =====================
        // AUTHENTIFICATION
        // =====================
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Identifiants incorrects.',
            ]);
        }

        // =====================
        // SESSION
        // =====================
        $request->session()->regenerate();

        // =====================
        // REDIRECTION PAR RÔLE
        // =====================
        // If the authenticated user is an admin, always send them to the admin dashboard
        if (Auth::user() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->intended($this->redirectTo());
    }

    /**
     * Détermine la redirection après login selon le rôle
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        // =====================
        // ADMIN
        // =====================
        if ($user->role === 'admin') {
            return route('admin.dashboard');
        }

        // =====================
        // MAGASIN
        // =====================
        if ($user->role === 'store' && $user->store_id) {
            return route('store.dashboard', $user->store_id);
        }

        // =====================
        // FALLBACK
        // =====================
        return route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to login page after logout
        return redirect()->route('login');
    }
}
