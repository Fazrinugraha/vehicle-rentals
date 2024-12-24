@extends('layouts.admin.main')
@section('title', 'Admin Edit Kendaraan')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Kendaraan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.kendaraan') }}">Kendaraan</a>
                </div>
                <div class="breadcrumb-item">Edit Kendaraan</div>
            </div>
        </div>
        <a href="{{ route('admin.kendaraan') }}" class="btn btn-icon icon-left btn-warning">Kembali</a>
        <div class="card mt-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.kendaraan.update', $kendaraan->id) }}" class="needs-validation" novalidate=""
                enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT') 
                <div class="card-body">
                    <div class="row">
                        <div class="col-6"> 
                            <div class="form-group"> 
                                <label for="nama_kendaraan">Nama Kendaraan</label> 
                                <input id="nama_kendaraan" type="text" class="form-control" name="nama_kendaraan" required=""
                                    value="{{ $kendaraan->nama_kendaraan }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jenis_kendaraan">Jenis Kendaraan</label>
                                <select id="jenis_kendaraan" name="jenis_kendaraan" class="form-control" required="">
                                    <option value="mobil" {{ $kendaraan->jenis_kendaraan == 'mobil' ? 'selected' : '' }}>Mobil</option>
                                    <option value="motor" {{ $kendaraan->jenis_kendaraan == 'motor' ? 'selected' : '' }}>Motor</option>
                                </select>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="no_plat">No Plat</label>
                                <input id="no_plat" type="text" class="form-control" name="no_plat" required=""
                                    value="{{ $kendaraan->no_plat }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi dan harus unik!
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status">Status Kendaraan</label>
                                <select id="status" name="status" class="form-control" required="">
                                    <option value="tersedia" {{ $kendaraan->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                    <option value="dipinjam" {{ $kendaraan->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                </select>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="customFile">Gambar Kendaraan</label>
                                <div class="custom-file">
                                    <input class="custom-file-input" name="images" id="customFile" type="file">
                                    <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                                </div>
                                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                                @if ($kendaraan->images) 
                                    <div class="mt-2">
                                        <img src="{{ asset('images/' . $kendaraan->images) }}" alt="Current Image" style="max-width: 150px; max-height: 150px;">
                                    </div>
                                @endif
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