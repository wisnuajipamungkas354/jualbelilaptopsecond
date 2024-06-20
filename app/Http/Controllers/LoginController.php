<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('katalog.login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ], [
            'email.email' => 'Masukkan email dengan format yang benar!',
            'password.required' => 'Masukkan Password!',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->role == 'Pelanggan') {
                return redirect()->intended('/')->with('loginSuccess', 'Login Berhasil!');
            } else {
                return redirect()->intended('/dashboard')->with('success', 'Login Berhasil!');
            }
        }

        return back()->with('loginError', 'Login Gagal!');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/')->with('logoutSuccess', 'Logout Berhasil!');
    }
}
