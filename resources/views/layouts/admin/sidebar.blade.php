<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Teknik Informatika | KSI5A</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">FAZRI</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <!-- Dashboard Menu -->
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-chart-line" style="color: #3F51B5;"></i>                    
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- Kendaraan Menu -->
            <li class="{{ Route::is('admin.kendaraan') || Route::is('admin.kendaraan.create') || Route::is('admin.kendaraan.edit') || Route::is('admin.kendaraan.detail') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.kendaraan') }}">
                    <i class="fas fa-car" style="color: #3F51B5;"></i>                    
                    <span>Kendaraan</span>
                </a>
            </li>
            <!-- Peminjaman Menu -->
            <li class="{{ Route::is('admin.peminjaman') || Route::is('admin.peminjaman.create') || Route::is('admin.peminjaman.edit') || Route::is('admin.peminjaman.detail') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.peminjaman') }}">
                    <i class="fas fa-handshake" style="color: #3F51B5;"></i>                    
                    <span>Peminjaman</span>
                </a>
            </li>
        </ul>
    </aside>
</div>