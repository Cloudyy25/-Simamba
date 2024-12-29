<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Handle user login
     */
    public function login(Request $request)
    {
        // Validasi input dari request
        $request->validate([
            'username_or_email' => 'required|string|max:50',
            'pass' => 'required|string|max:50',
        ], [
            'username_or_email.required' => 'Username atau email wajib diisi.',
            'pass.required' => 'Password wajib diisi.',
        ]);

        // Ambil input username/email dan password
        $credentials = $request->only('username_or_email', 'pass');

        // Cek apakah user dengan username atau email ada
        $user = User::where('username', $credentials['username_or_email'])
            ->orWhere('email', $credentials['username_or_email'])
            ->first();

        if (!$user) {
            // Jika user tidak ditemukan
            return redirect('/login')->withErrors([
                'username_or_email' => 'Tidak ditemukan akun dengan Username/Email yang dimasukkan.',
            ]);
        }

        // Validasi password
        if (!Hash::check($credentials['pass'], $user->password)) {
            // Jika password salah
            return redirect('/login')->withErrors([
                'pass' => 'Password salah, harap input kembali.',
            ]);
        }

        // Jika berhasil, login user
        Auth::login($user);
        Log::info('User berhasil login', ['user_id' => $user->id]);

        // Redirect berdasarkan jabatan user
        switch ($user->id_jabatan) {
            case 1:
                return redirect('/pimpinan/dashboard');
            case 2:
                return redirect('/pj/dashboard');
            case 3:
                return redirect('/anggota/dashboard');
            default:
                return redirect('/login')->withErrors([
                    'id_jabatan' => 'Akses tidak diizinkan untuk jabatan Anda.',
                ]);
        }
    }

    /**
     * Handle user logout
     */
    public function logout()
    {
        // Log aktivitas logout
        if (Auth::check()) {
            Log::info('User logged out', ['user_id' => Auth::id()]);
        }

        // Logout user
        Auth::logout();
        session()->flush();

        // Redirect ke halaman login
        return redirect('/login')->with('success', 'Anda telah berhasil logout.');
    }
}
