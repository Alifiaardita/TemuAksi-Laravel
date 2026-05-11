<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Ambil user manual karena kolom password bukan 'password'
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.'])->withInput();
        }

        if ($user->status === 'blokir') {
            return back()->withErrors(['email' => 'Akun kamu diblokir admin.']);
        }

        if ($user->status === 'suspend') {
            return back()->withErrors(['email' => 'Akun kamu disuspend sementara.']);
        }

        if (!password_verify($request->password, $user->password_hash)) {
            return back()->withErrors(['password' => 'Password salah.'])->withInput();
        }

        Auth::login($user);
        $request->session()->regenerate();

        return match($user->role) {
            'admin'     => redirect()->route('admin.dashboard'),
            'perusahaan'=> redirect()->route('perusahaan.dashboard'),
            default     => redirect()->route('home'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

