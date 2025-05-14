<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Prosi
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Informasi Umum</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-columns"></i>
                    <span>Data Dosen</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-columns"></i>
                    <span>Data Mahasiswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-columns"></i>
                    <span>Data Program Studi</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-columns"></i>
                    <span>Data Ruangan</span>
                </a>
            </li>

            <li class="menu-header">Informasi Sidang</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i>
                    <span>Tahun Akademik</span></a>
                <ul class="dropdown-menu">
                    <li class="active">
                        <a class="nav-link" href="{{ url('components-article') }}">2024-2025</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
