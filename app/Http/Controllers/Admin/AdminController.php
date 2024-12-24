<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Kendaraan;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Get counts for Admins, Users, and Peminjaman
        $admins = Admin::count();
        $users = User::count();
        $peminjaman = Peminjaman::count();
        
        // Initialize the query for Kendaraan
        $kendaraans = Kendaraan::query();
        
        // Filter based on status
        if ($request->has('status') && $request->status != '') {
            $kendaraans->where('status', $request->status);
        }
    
        // Get the filtered vehicles with pagination
        $kendaraans = $kendaraans->paginate(10); 

        // Get total count of vehicles (this can be filtered as well if needed)
        $totalKendaraans = Kendaraan::count(); 

        return view('pages.admin.index', compact('admins', 'users', 'kendaraans', 'peminjaman', 'totalKendaraans'));
    }
}