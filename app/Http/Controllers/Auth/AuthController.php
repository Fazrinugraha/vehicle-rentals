<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Login function for both admin
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:dns',
            'password' => 'required|min:8|max:15',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'Pastikan semua email dan password terisi dengan benar!');
            return redirect()->back();
        }

        // Check for admin login 
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $admin = Auth::guard('admin')->user();
            toast('Selamat datang, ' . $admin->name . '!', 'success');
            return redirect()->route('admin.dashboard');
        } 
        // Login failed
        else {
            Alert::error('Login Gagal!', 'Email atau password tidak valid!');
            return redirect()->back();
        }
    }

    // Admin logout function
    public function admin_logout() 
    {
        Auth::guard('admin')->logout();
        toast('Berhasil logout!', 'success');
        return redirect('/');
    }
}