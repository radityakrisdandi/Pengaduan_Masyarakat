<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function toLogin()
    {
        return view('Auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],

            [
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',

                'password.required' => 'Password wajib diisi',
            ]
        );

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // SINKRONISASI RUTE REDIRECT (Sesuai Ketentuan Incremental & Perbaikan Bug Petugas)
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role == 'petugas') {
                // Mengubah dari "return 'ini petugas';" ke halaman dashboard petugas yang sesungguhnya
                return redirect('/petugas');
            } elseif (Auth::user()->role == 'user') {
                // Menjaga rute dashboard masyarakat tetap berjalan utuh tanpa modifikasi destruktif
                return redirect()->route('masyarakat.dashboard');
            }
        }

        return back()->with('error', 'Email atau password salah')->withInput();
    }

    public function register(Request $request){
        $validasi = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);


        $validasi['password'] = bcrypt($validasi['password']);
        $validasi['role'] = 'user';
        User::create($validasi);
        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login');

    }   

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}