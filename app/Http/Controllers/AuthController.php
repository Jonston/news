<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show login form
     *
     * @return View
     */
    public function loginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Login user
     *
     * @param LoginRequest $request
     * @return  RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (auth()->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('login-form');
        }

        return redirect()->back()->withErrors([
            'email' => 'Invalid credentials',
            'password' => 'Invalid credentials',
        ]);
    }

    /**
     * Logout user
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-form');
    }
}
