@extends('layouts.admin.main') 
@section('title', 'Admin Dashboard') 

@section('content') 
    <div class="main-content"> 
        <section class="section"> 
            <div class="section-header"> 
                <h1>Dashboard</h1> 
                <div class="section-header-breadcrumb"> 
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </div> 
                </div> 
            </div> 
            <div class="row">
                <!-- Total Admin -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="card card-statistic-1"> 
                        <div class="card-icon" style="background-color: #3F51B5;"> 
                            <i class="fas fa-user-shield"></i> 
                        </div> 
                        <div class="card-wrap"> 
                            <div class="card-header"> 
                                <h4>Total Admin</h4> 
                            </div> 
                            <div class="card-body"> 
                                {{ $admins }} 
                            </div> 
                        </div> 
                    </div> 
                </div> 

                <!-- Total Pengguna -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="card card-statistic-1"> 
                        <div class="card-icon" style="background-color: #4CAF50;">
                            <i class="fas fa-users"></i> 
                        </div> 
                        <div class="card-wrap"> 
                            <div class="card-header"> 
                                <h4>Total Pengguna</h4> 
                            </div> 
                            <div class="card-body"> 
                                {{ $users }} 
                            </div> 
                        </div> 
                    </div> 
                </div> 

                <!-- Total Kendaraan -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="card card-statistic-1"> 
                        <div class="card-icon" style="background-color: #FFC107;"> 
                            <i class="fas fa-car"></i> 
                        </div> 
                        <div class="card-wrap"> 
                            <div class="card-header"> 
                                <h4>Total Kendaraan</h4> 
                            </div> 
                            <div class="card-body"> 
                                {{ $totalKendaraans }} 
                            </div> 
                        </div> 
                    </div> 
                </div>

                <!-- Total Peminjaman -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="card card-statistic-1"> 
                        <div class="card-icon" style="background-color: #00BCD4;"> 
                            <i class="fas fa-book"></i> 
                        </div> 
                        <div class="card-wrap"> 
                            <div class="card-header"> 
                                <h4>Total Peminjaman</h4> </div> 
                            <div class="card-body"> 
                                {{ $peminjaman }} 
                            </div> 
                        </div> 
                    </div> 
                </div>
            </div>
            <!-- Filter Form -->
            <div class="card mt-3">
                <div class="card-header">
                    <h4>Filter Kendaraan</h4>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.dashboard') }}">
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
                                <th>Status</th> 
                                <th>Gambar</th>
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
                                <td>{{ $kendaraan->status }}</td>  
                                <td>
                                    @if($kendaraan->images)
                                        <img src="{{ asset('images/' . $kendaraan->images) }}" alt="Gambar {{ $kendaraan->nama_kendaraan }}" style="width: 100px; height: auto;">
                                    @else
                                        <span>Tidak ada gambar</span>
                                    @endif
                                </td>
                            </tr> 
                        @empty 
                            <tr>
                                <td colspan="5" class="text-center">Data Kendaraan Kosong</td> 
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