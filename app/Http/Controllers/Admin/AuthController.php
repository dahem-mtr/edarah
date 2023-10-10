<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{

    public function login()
    {
        return Inertia::render('Login');
    }

    public function authenticate(Request $request)
    {

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            // Authentication passed...
            $user = User::where('email', $request['email'])->firstOrFail();
            Auth::login($user, $request['remember']);

            return redirect()->route('admin.index');
        }
        return redirect()->back()->with('error',  __('admin/main.wrong-email-or-password'));

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
