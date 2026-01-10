<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // bikin file resources/views/login.blade.php
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            switch ($user->role) {
                case 'Admin':
                case 'Admin 1':
                case 'Admin 2':
                case 'Super Admin': // super admin sama dengan admin
                    return redirect('/admin/dashboard')->with('success', 'Login berhasil sebagai Admin');
                case 'Owner':
                    return redirect('/owner-dashboard')->with('success', 'Login berhasil sebagai Owner');
                case 'Supervisor':
                    return redirect('/gudang')->with('success', 'Login berhasil sebagai Supervisor');
                case 'Kepala Proyek':
                    return redirect('/kepala-proyek')->with('success', 'Login berhasil sebagai Kepala Proyek');
                default:
                    return redirect('/')->with('success', 'Login berhasil');
            }
        }

        return back()->with('error', 'Username atau password salah.');
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
