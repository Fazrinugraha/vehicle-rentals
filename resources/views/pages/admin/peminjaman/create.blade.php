@extends('layouts.admin.main') 
@section('title', 'Admin Tambah Peminjaman') 
@section('content') 
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Peminjaman</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard')}}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.peminjaman') }}">Peminjaman</a></div>
                <div class="breadcrumb-item">Tambah Peminjaman</div>
            </div>
        </div>
        <a href="{{ route('admin.peminjaman') }}" class="btn btn-icon icon-left btn-warning"> Kembali</a>
        <div class="card mt-4">
            <form action="{{ route('admin.peminjaman.store') }}" class="needs-validation" novalidate="" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6"> 
                            <div class="form-group"> 
                                <label for="nama_peminjam">Nama Peminjam</label> 
                                <input id="nama_peminjam" type="text" class="form-control" name="nama_peminjam" required="">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id_kendaraan">Kendaraan</label>
                                <select id="id_kendaraan" name="id_kendaraan" class="form-control" required="">
                                    <option value="">Pilih Kendaraan</option>
                                    @foreach ($kendaraans as $kendaraan)
                                        <option value="{{ $kendaraan->id }}">{{ $kendaraan->nama_kendaraan }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                                <input id="tanggal_peminjaman" type="date" class="form-control" name="tanggal_peminjaman" required="">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                                <input id="tanggal_pengembalian" type="date" class="form-control" name="tanggal_pengembalian" required="">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection