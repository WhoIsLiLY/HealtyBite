<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showCustomerLoginForm()
    {
        return view('customer.login');
    }
    public function showAdminLoginForm()
    {
        return view('admin.login');
    }
    public function customerLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('customer.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }
    public function adminLogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba login dengan email dan password
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Login berhasil, redirect ke dashboard
            return redirect()->route('restaurant.dashboard');
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }
    public function logout(){
        Auth::guard('customer')->logout();
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
