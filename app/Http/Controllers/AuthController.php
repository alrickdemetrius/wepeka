<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    //

    public function showLoginForm()
    {
        if (auth()->check()) {
            $user = auth()->user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('client.headquarters'); // arahkan langsung ke HQ
            }
        }

        return view('auth.login');
    }


    // Proses login
    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Redirect berdasarkan peran pengguna
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard'); // dari 'admin.dashboard'
            } else {
                return redirect()->route('client.headquarters');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->except('password'));
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
