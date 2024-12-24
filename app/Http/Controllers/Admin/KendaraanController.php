<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan; // Menggunakan model Kendaraan
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
    
        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?'); // Konfirmasi Hapus Distributor
    
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
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Proses penyimpanan gambar
        $imageName = null;
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Membuat nama gambar unik
            $image->move(public_path('images'), $imageName); // Pindahkan gambar ke folder public/images
        }

        // Create the kendaraan
        $kendaraan = Kendaraan::create([
            'nama_kendaraan' => $request->nama_kendaraan,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'status' => 'tersedia',
            'images' => $imageName, 
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
        $kendaraan = Kendaraan::findOrFail($id); // Fetch a single kendaraan by ID
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
            'images' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update($request->except('images')); // Update data lain

        // Proses penyimpanan gambar jika ada
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Membuat nama gambar unik
            $image->move(public_path('images'), $imageName); // Pindahkan gambar ke folder public/images
            $kendaraan->images = $imageName; // Update nama gambar
        }

        $kendaraan->save();

        Alert::success('Berhasil!', 'Kendaraan berhasil diperbarui!');
        return redirect()->route('admin.kendaraan');
    }

    // Function Hapus Kendaraan
    public function delete($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        if ($kendaraan) {
            // Jika ada gambar, hapus file gambar dari server
            if ($kendaraan->images) {
                $imagePath = public_path('images/' . $kendaraan->images);
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Menghapus file gambar
                }
            }

            $kendaraan->delete(); // Menghapus data kendaraan dari database
            Alert::success('Berhasil!', 'Kendaraan berhasil dihapus!');
            return redirect()->route('admin.kendaraan');
        } else {
            Alert::error('Gagal!', 'Kendaraan gagal dihapus!');
            return redirect()->back();
        }
    }
}