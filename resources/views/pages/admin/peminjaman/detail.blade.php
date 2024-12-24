@extends('layouts.admin.main') 
@section('title', 'Admin Detail Peminjaman') 
@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <!-- Header Section -->
        <div class="section-header"> 
            <h1>Detail Peminjaman</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.peminjaman') }}">Peminjaman</a>
                </div> 
                <div class="breadcrumb-item">Detail Peminjaman</div> 
            </div> 
        </div>
        
        <!-- Back Button -->
        <a href="{{ route('admin.peminjaman') }}" class="btn btn-icon icon-left btn-warning">
            <i class="fas fa-arrow-left"></i> Kembali
        </a> 
        
        <!-- Peminjaman Detail -->
        <div class="row mt-4"> 
            <div class="col-12 col-md-8 m-auto"> 
                <article class="article article-style-c"> 
                    <div class="article-header"> 
                        <div class="article-image" data-background="{{ asset('images/' . $peminjaman->kendaraan->images) }}">  
                    </div> 
                    </div> 
                    <div class="article-details"> 
                        <h2 class="article-title">{{ $peminjaman->kendaraan->nama_kendaraan }}</h2>
                        <hr> 
                        <div class="article-category">
                            <strong>Jenis Kendaraan:</strong> {{ $peminjaman->kendaraan->jenis_kendaraan }}
                        </div> 
                        <div class="article-category">
                            <strong>Status Kendaraan:</strong> {{ $peminjaman->kendaraan->status }}
                        </div> 
                        <div class="article-category">
                            <strong>No Plat:</strong> {{ $peminjaman->kendaraan->no_plat }} 
                        </div> 
                        <hr>
                        <h4>Informasi Peminjaman</h4>
                        <ul>
                            <li>
                                <strong>Nama Peminjam:</strong> {{ $peminjaman->nama_peminjam }} <br>
                                <strong>Tanggal Peminjaman:</strong> {{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->translatedFormat('d F Y') }} <br>
                                <strong>Tanggal Pengembalian:</strong> {{ \Carbon\Carbon::parse($peminjaman->tanggal_pengembalian)->translatedFormat('d F Y') }} <br>
                                <strong>Status:</strong> {{ ucfirst($peminjaman->status) }}
                            </li>
                        </ul>
                    </div> 
                </article> 
            </div> 
        </div> 
    </section> 
</div> 
@endsection