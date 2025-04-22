<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        session(['user' => [
            'email' => $request->email,
            'name' => 'Dummy User',
        ]]);

        return redirect()->route('restaurant.dashboard');

        // // Coba autentikasi
        // $credentials = $request->only('email', 'password');

        // if (Auth::attempt($credentials)) {
        //     // Jika berhasil login
        //     $request->session()->regenerate();
        //     return redirect()->route('restaurant.dashboard');
        // }

        // // Jika gagal login
        // return back()->withErrors([
        //     'email' => 'Email atau password salah.',
        // ])->withInput();
    }
}
