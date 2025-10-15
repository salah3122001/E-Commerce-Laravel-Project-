<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Override the default redirect after login.
     *
     * @return string
     */
    protected function redirectTo()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return '/admin/dashboard';
        }

        return '/';
    }
}
