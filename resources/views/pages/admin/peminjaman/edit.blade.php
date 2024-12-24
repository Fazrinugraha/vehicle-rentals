@extends('layouts.admin.main') 
@section('title', 'Admin Edit Peminjaman') 
@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1>Edit Peminjaman</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.peminjaman') }}">Peminjaman</a>
                </div> 
                <div class="breadcrumb-item">Edit Peminjaman</div> 
            </div> 
        </div>
        
        <a href="{{ route('admin.peminjaman') }}" class="btn btn-icon icon-left btn-warning">Kembali</a>
        
        <div class="card mt-4">
            <form action="{{ route('admin.peminjaman.update', $peminjaman->id) }}" class="needs-validation" novalidate="" method="POST">
                @csrf
                @method('PUT') <!-- Menambahkan method PUT untuk update -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-6"> 
                            <div class="form-group"> 
                                <label for="nama_peminjam">Nama Peminjam</label> 
                                <input id="nama_peminjam" type="text" class="form-control" name="nama_peminjam" required="" value="{{ $peminjaman->nama_peminjam }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Kendaraan</label>
                                <input type="text" class="form-control" value="{{ $peminjaman->kendaraan->nama_kendaraan }}" readonly>
                                <small class="form-text text-muted">Kendaraan yang dipinjam.</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                                <input id="tanggal_peminjaman" type="date" class="form-control" name="tanggal_peminjaman" required="" value="{{ $peminjaman->tanggal_peminjaman }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                                <input id="tanggal_pengembalian" type="date" class="form-control" name="tanggal_pengembalian" required="" value="{{ $peminjaman->tanggal_pengembalian }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status">Status Peminjaman</label>
                                <select id="status" name="status" class="form-control" required="">
                                    <option value="dipinjam" {{ $peminjaman->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                    <option value="dikembalikan" {{ $peminjaman->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </section> 
</div> 
@endsection