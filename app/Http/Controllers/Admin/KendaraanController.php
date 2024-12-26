<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan; 
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil status dari query string, jika ada
        $status = $request->get('status');
    
        // Ambil semua kendaraan, jika status tidak ada, ambil semua
        $kendaraans = Kendaraan::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->paginate(10);
    
        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?'); 
    
        return view('pages.admin.kendaraan.index', compact('kendaraans', 'status'));
    }
    
    // Function Tambah Kendaraan
    public function create()
    {
        return view('pages.admin.kendaraan.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kendaraan' => 'required|string|max:255', 
            'jenis_kendaraan' => 'required|in:mobil,motor',
            'images' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'no_plat' => 'required|string|max:20|unique:kendaraans,no_plat',
            ],[
                'no_plat.unique' => 'No Plat sudah ada. Silakan gunakan No Plat yang lain.', 
            ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Proses penyimpanan gambar
        $imageName = null;
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); 
            $image->move(public_path('images'), $imageName); 
        }

        // Create kendaraan
        $kendaraan = Kendaraan::create([
            'nama_kendaraan' => $request->nama_kendaraan,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'status' => 'tersedia',
            'images' => $imageName, 
            'no_plat' => $request->no_plat,
        ]);

        if ($kendaraan) {
            Alert::success('Berhasil!', 'Kendaraan berhasil ditambahkan!');
            return redirect()->route('admin.kendaraan');
        } else {
            Alert::error('Gagal!', 'Kendaraan gagal ditambahkan!');
            return redirect()->back();
        }
    }

    // Function Detail Kendaraan
    public function detail($id)
    {
        $kendaraan = Kendaraan::findOrFail($id); 
        return view('pages.admin.kendaraan.detail', compact('kendaraan'));
    }

    // Function Edit dan Update Kendaraan
    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('pages.admin.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kendaraan' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|in:mobil,motor',
            'status' => 'required|in:tersedia,dipinjam',
            'images' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'no_plat' => 'required|string|max:20|unique:kendaraans,no_plat,' . $id, 
        ], [
            'no_plat.unique' => 'No Plat sudah ada. Silakan gunakan No Plat yang lain.',
        ]);
    
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update($request->except('images')); 
    
        // Proses penyimpanan gambar jika ada
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); 
            $image->move(public_path('images'), $imageName); 
            $kendaraan->images = $imageName; 

            // Jika tidak ada gambar baru, tetap gunakan gambar yang lama
            $kendaraan->images = $kendaraan->images; 
        }
    
        $kendaraan->no_plat = $request->no_plat; 
        $kendaraan->save();
    
        Alert::success('Berhasil!', 'Kendaraan berhasil diperbarui!');
        return redirect()->route('admin.kendaraan');
    }

   // Function Hapus Kendaraan
    public function delete($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        if ($kendaraan) {
            // Hapus semua peminjaman yang terkait dengan kendaraan ini
            $kendaraan->peminjaman()->delete(); 

            // Jika ada gambar, hapus file gambar dari server
            if ($kendaraan->images) {
                $imagePath = public_path('images/' . $kendaraan->images);
                if (file_exists($imagePath)) {
                    unlink($imagePath); 
                }
            }

            $kendaraan->delete(); 
            Alert::success('Berhasil!', 'Kendaraan berhasil dihapus!');
            return redirect()->route('admin.kendaraan');
        } else {
            Alert::error('Gagal!', 'Kendaraan gagal dihapus!');
            return redirect()->back();
        }
    }
}