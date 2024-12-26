<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Kendaraan;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $admins = Admin::count();
        $peminjaman = Peminjaman::count();
        
        // Data Kendaraan
        $kendaraans = Kendaraan::query();
        
        // Filter kendaraan berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $kendaraans->where('status', $request->status);
        }
    
        // Membatasi tampilan data kendaraan
        $kendaraans = $kendaraans->paginate(10); 
        $totalKendaraans = Kendaraan::count(); 

        return view('pages.admin.index', compact('admins',  'kendaraans', 'peminjaman', 'totalKendaraans'));
    }
}