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
            <li class="nav-item {{ request()->is('lectures*') ? 'active' : '' }}">
                <a href="{{ route('lectures.index') }}" class="nav-link">
                    <i class="far fa-user"></i>
                    <span>Dosen</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('students*') ? 'active' : '' }}">
                <a href="{{ route('students.index') }}" class="nav-link">
                    <i class="far fa-user"></i>
                    <span>Mahasiswa</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('study-programs*') ? 'active' : '' }}">
                <a href="{{ route('study-programs.index') }}" class="nav-link">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Program Studi</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('rooms*') ? 'active' : '' }}">
                <a href="{{ route('rooms.index') }}" class="nav-link">
                    <i class="fas fa-building"></i>
                    <span>Ruangan</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('academic-calendars*') ? 'active' : '' }}">
                <a href="{{ route('academic-calendars.index') }}" class="nav-link">
                    <i class="fas fa-calendar-days"></i>
                    <span>Tahun Akademik</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('proposals*') ? 'active' : '' }}">
                <a href="{{ route('proposals.index') }}" class="nav-link">
                    <i class="fas fa-book-open-reader"></i>
                    <span>Seminar Proposal</span>
                </a>
            </li>

            <li class="menu-header">Informasi Sidang</li>
            @foreach ($academicCalendars as $academicCalendar)
                <li class="nav-item {{ request()->is('academic-calendars*') ? 'active' : '' }}">
                    <a href="{{ route('proposals.show', ['proposal' => $academicCalendar->id]) }}" class="nav-link">
                        <i class="fas fa-calendar"></i>
                        <span>{{ $academicCalendar->periode_year }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </aside>
</div>
