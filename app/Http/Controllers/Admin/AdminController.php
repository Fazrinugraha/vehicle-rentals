<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Kendaraan;
use App\Models\Peminjaman;
use App\Models\User;


class AdminController extends Controller
{
    public function dashboard()
    {
        $admins = Admin::count();
        $kendaraans = Kendaraan::count();
        $peminjaman = Peminjaman::count();
        $users = User::count();

        return view('pages.admin.index', compact('admins', 'kendaraans', 'peminjaman','users'));
    }
}