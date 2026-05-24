<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StoreController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function showAdminLoginForm(): View
    {
        return view('auth.admin-login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        ActivityLogger::log('login');
        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function adminLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            if (StoreController::userIsAdmin()) {
                $request->session()->regenerate();
                ActivityLogger::log('login');
                return redirect()->intended(route('dashboard', absolute: false));
            }
            Auth::guard('web')->logout();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records or you are not authorized as admin.',
        ]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        ActivityLogger::log('logout');
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}