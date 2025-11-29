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
            // kirimkan pesan berhasil login
            return redirect()->intended('/admin/dashboard')->with('success', 'Anda Berhasil Login berhasil'); // halaman setelah login
        }

        // ... di dalam Auth::attempt gagal
        return back()->with('error', 'Username atau password salah.'); // Menggunakan 'error'
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
