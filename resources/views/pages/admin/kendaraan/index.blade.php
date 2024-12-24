@extends('layouts.admin.main') 
@section('title', 'Admin Kendaraan') 

@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1>Kendaraan</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item">Kendaraan</div> 
            </div> 
        </div> 
        <a href="{{ route('admin.kendaraan.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>Tambah Kendaraan</a>  
        
        <!-- Filter Form -->
        <div class="card mt-3">
            <div class="card-header">
                <h4>Filter Kendaraan</h4>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.kendaraan') }}">
                    <div class="form-group">
                        <label for="status">Filter berdasarkan Status</label>
                        <select id="status" name="status" class="form-control" onchange="this.form.submit()">
                            <option value="">Semua</option>
                            <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body"> 
            <div class="table-responsive"> 
                <table class="table table-bordered table-md"> 
                    <thead>
                        <tr> 
                            <th>No</th> 
                            <th>Nama Kendaraan</th> 
                            <th>Jenis Kendaraan</th>
                            <th>No Plat</th> 
                            <th>Status</th> 
                            <th>Gambar</th>
                            <th>Action</th> 
                        </tr> 
                    </thead>
                    <tbody>
                    @php 
                        $no = 0;
                    @endphp
                    @forelse ($kendaraans as $kendaraan) 
                        <tr> 
                            <td>{{ $no += 1 }}</td> 
                            <td>{{ $kendaraan->nama_kendaraan }}</td> 
                            <td>{{ $kendaraan->jenis_kendaraan }}</td>
                            <td>{{ $kendaraan->no_plat }}</td>
                            <td>{{ $kendaraan->status }}</td>  
                            <td>
                                @if($kendaraan->images)
                                    <img src="{{ asset('images/' . $kendaraan->images) }}" alt="{{ $kendaraan->nama_kendaraan }}" style="width: 100px; height: auto;">
                                @else
                                    <span>Tidak ada gambar</span>
                                @endif
                            </td>
                            <td> 
                                <a href="{{ route('admin.kendaraan.detail', $kendaraan->id) }}" class="badge badge-info">Detail</a> 
                                <a href="{{ route('admin.kendaraan.edit', $kendaraan->id) }}" class="badge badge-warning">Edit</a> 
                                <a href="{{ route('admin.kendaraan.delete', $kendaraan->id) }}" class="badge badge-danger" data-confirm-delete="true">Hapus</a> 
                            </td> 
                        </tr> 
                    @empty 
                        <tr>
                            <td colspan="6" class="text-center">Data Kendaraan Kosong</td> 
                        </tr>
                    @endforelse 
                    </tbody>
                </table>
                    <!-- Pagination -->
                    <div class="mt-3 d-flex justify-content-center">
                        @if ($kendaraans->onFirstPage())
                            <span class="page-link disabled box">Sebelumnya</span>
                        @else
                            <a href="{{ $kendaraans->previousPageUrl() }}" class="page-link prev-next box">Sebelumnya</a>
                        @endif
                        <ul class="pagination">
                            @foreach ($kendaraans->getUrlRange(1, $kendaraans->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $kendaraans->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                        </ul>
                        @if ($kendaraans->hasMorePages())
                            <a href="{{ $kendaraans->nextPageUrl() }}" class="page-link prev-next box">Selanjutnya</a>
                        @else
                            <span class="page-link disabled box">Selanjutnya</span>
                        @endif
                    </div>
            </div> 
        </div> 
    </section> 
</div> 
@endsection