@extends('layouts.admin.main') 
@section('title', 'Admin Detail Kendaraan') 
@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <!-- Header Section -->
        <div class="section-header"> 
            <h1>Detail Kendaraan</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.kendaraan') }}">Kendaraan</a>
                </div> 
                <div class="breadcrumb-item">Detail Kendaraan</div> 
            </div> 
        </div>
        
        <!-- Back Button -->
        <a href="{{ route('admin.kendaraan') }}" class="btn btn-icon icon-left btn-warning">
            <i class="fas fa-arrow-left"></i> Kembali
        </a> 
        
        <!-- Kendaraan Detail -->
        <div class="row mt-4"> 
            <div class="col-12 col-md-8 m-auto"> 
                <article class="article article-style-c"> 
                    <div class="article-header"> 
                            <div class="article-image" data-background="{{ asset('images/' . $kendaraan->images) }}">  
                            </div> 
                    </div> 
                    <div class="article-details"> 
                        <h2 class="article-title">{{ $kendaraan->nama_kendaraan }}</h2>
                        <hr> 
                        <div class="article-category">
                            <strong>Jenis Kendaraan:</strong> {{ $kendaraan->jenis_kendaraan }}
                        </div> 
                        <div class="article-category">
                            <strong>Status Kendaraan:</strong> {{ $kendaraan->status }}
                        </div> 
                        <div class="article-category">
                            <strong>No Plat:</strong> {{ $kendaraan->no_plat }}
                        </div> 
                    </div> 
                </article> 
            </div> 
        </div> 
    </section> 
</div> 
@endsection