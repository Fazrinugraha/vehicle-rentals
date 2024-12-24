@extends('layouts.admin.main') 
@section('title', 'Admin Peminjaman') 

@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1>Peminjaman</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item">Peminjaman</div> 
            </div> 
        </div> 
        <a href="{{ route('admin.peminjaman.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="fas fa-plus"></i> Tambah Peminjaman
        </a>  
        <div class="card-body"> 
            <div class="table-responsive"> 
                <table class="table table-bordered table-md"> 
                    <thead>
                        <tr> 
                            <th>No</th> 
                            <th>Nama Peminjam</th> 
                            <th>Kendaraan</th> 
                            <th>Tanggal Peminjaman</th> 
                            <th>Tanggal Pengembalian</th> 
                            <th>Status</th> 
                            <th>Action</th> 
                        </tr> 
                    </thead>
                    <tbody>
                    @php 
                        $no = 0;
                    @endphp
                    @forelse ($peminjaman as $item) 
                        <tr> 
                            <td>{{ ++$no }}</td> 
                            <td>{{ $item->nama_peminjam }}</td> 
                            <td>{{ $item->kendaraan->nama_kendaraan }}</td> 
                            <td>{{ $item->tanggal_peminjaman }}</td> 
                            <td>{{ $item->tanggal_pengembalian }}</td> 
                            <td>{{ ucfirst($item->status) }}</td>  
                            <td> 
                                <a href="{{ route('admin.peminjaman.detail', $item->id) }}" class="badge badge-info">Detail</a> 
                                <a href="{{ route('admin.peminjaman.edit', $item->id) }}" class="badge badge-warning">Edit</a> 
                                <a href="{{ route('admin.peminjaman.delete', $item->id) }}" class="badge badge-danger" data-confirm-delete="true">Hapus</a> 
                            </td> 
                        </tr> 
                    @empty 
                        <tr>
                            <td colspan="7" class="text-center">Data Peminjaman Kosong</td> 
                        </tr>
                    @endforelse 
                    </tbody>
                </table> 
            </div> 
        </div> 
    </section> 
</div> 
@endsection