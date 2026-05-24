<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the customer login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Show the admin login form.
     */
    public function showAdminLoginForm(): View
    {
        return view('auth.admin-login');
    }

    /**
     * Handle an incoming authentication request for customers.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Optional: redirect admins to different page
        // if (auth()->user()->role === 'admin') {
        //     return redirect()->intended('/dashboard');
        // }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Handle an authentication request for admin.
     */
    public function adminLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');
        $credentials['role'] = 'admin';

        if (auth()->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redirect admin to dashboard (or admin dashboard if you want a separate one)
            return redirect()->intended(route('dashboard', absolute: false));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records or you are not authorized as admin.',
        ]);
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