<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman; // Menggunakan model Peminjaman
use App\Models\Kendaraan; // Menggunakan model Kendaraan
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanController extends Controller
{
    // Menampilkan daftar peminjaman
    public function index()
    {
        // Mengambil semua peminjaman dengan relasi kendaraan, diurutkan berdasarkan tanggal peminjaman dan tanggal pengembalian
        $peminjaman = Peminjaman::with('kendaraan')
            ->orderBy('tanggal_peminjaman', 'desc') // Urutkan berdasarkan tanggal peminjaman terbaru
            ->orderBy('tanggal_pengembalian', 'desc') // Jika tanggal peminjaman sama, urutkan berdasarkan tanggal pengembalian terbaru
            ->get();

        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?'); // Konfirmasi Hapus Distributor

        return view('pages.admin.peminjaman.index', compact('peminjaman'));
    }

    // Menampilkan form tambah peminjaman
    public function create()
    {
        $kendaraans = Kendaraan::where('status', 'tersedia')->get(); // Mengambil kendaraan yang tersedia
        return view('pages.admin.peminjaman.create', compact('kendaraans'));
    }

    // Menyimpan peminjaman baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kendaraan' => 'required|exists:kendaraans,id', // Validasi untuk kendaraan
            'nama_peminjam' => 'required|string|max:100',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after:tanggal_peminjaman',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the peminjaman
        $peminjaman = Peminjaman::create([
            'id_kendaraan' => $request->id_kendaraan,
            'nama_peminjam' => $request->nama_peminjam,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status' => 'dipinjam', // Status default
        ]);

        if ($peminjaman) {
            // Update status kendaraan menjadi tidak tersedia
            $kendaraan = Kendaraan::find($request->id_kendaraan);
            $kendaraan->status = 'dipinjam';
            $kendaraan->save();

            Alert::success('Berhasil!', 'Peminjaman berhasil ditambahkan!');
            return redirect()->route('admin.peminjaman');
        } else {
            Alert::error('Gagal!', 'Peminjaman gagal ditambahkan!');
            return redirect()->back();
        }
    }

    // Menampilkan detail peminjaman
    public function detail($id)
    {
        $peminjaman = Peminjaman::with('kendaraan')->findOrFail($id); // Mengambil peminjaman beserta kendaraan
        return view('pages.admin.peminjaman.detail', compact('peminjaman'));
    }

    // Menampilkan form edit peminjaman
    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $kendaraans = Kendaraan::where('status', 'tersedia')->get(); // Mengambil kendaraan yang tersedia
        return view('pages.admin.peminjaman.edit', compact('peminjaman', 'kendaraans'));
    }

    // Memperbarui peminjaman
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_peminjam' => 'required|string|max:100',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after:tanggal_peminjaman',
            'status' => 'required|string|in:dipinjam,dikembalikan', // Validasi untuk status
        ]);
    
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $peminjaman = Peminjaman::findOrFail($id);
    
        // Hanya memperbarui informasi peminjam dan tanggal
        $peminjaman->update([
            'nama_peminjam' => $request->nama_peminjam,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status' => $request->status, // Memperbarui status
        ]);
    
        // Jika status diubah menjadi 'dikembalikan', update status kendaraan
        if ($request->status == 'dikembalikan') {
            $kendaraan = Kendaraan::find($peminjaman->id_kendaraan);
            $kendaraan->status = 'tersedia'; // Mengubah status kendaraan menjadi tersedia
            $kendaraan->save();
        }
    
        Alert::success('Berhasil!', 'Peminjaman berhasil diperbarui!');
        return redirect()->route('admin.peminjaman');
    }
    // Menghapus peminjaman
    public function delete($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
    
        if ($peminjaman) {
            // Update status kendaraan menjadi tersedia
            $kendaraan = Kendaraan::find($peminjaman->id_kendaraan);
            $kendaraan->status = 'tersedia';
            $kendaraan->save();
    
            $peminjaman->delete(); // Menghapus data peminjaman dari database
            Alert::success('Berhasil!', 'Peminjaman berhasil dihapus!');
            return redirect()->route('admin.peminjaman');
        } else {
            Alert::error('Gagal!', 'Peminjaman gagal dihapus!');
            return redirect()->back();
        }
    }
}