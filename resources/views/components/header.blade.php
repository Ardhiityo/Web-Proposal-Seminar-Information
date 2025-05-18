<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="mr-auto form-inline" action="{{ route('proposals.index') }}" method="GET">
        <ul class="mr-3 navbar-nav">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
            </li>
            <li>
                <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i>
                </a>
            </li>
        </ul>
        <div class="search-element">
            <input class="form-control" type="search" name="keyword" placeholder="Cek jadwal via NIM"
                aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            @if (!$histories->isEmpty())
                <div class="search-result">
                    <div class="search-header">
                        Riwayat
                    </div>
                    @foreach ($histories as $history)
                        <div class="search-item">
                            <a href="{{ route('proposals.index', ['keyword' => $history->keyword]) }}">
                                <div class="mr-3 text-white search-icon bg-primary">
                                    <i class="fas fa-clock-rotate-left"></i>
                                </div>
                                {{ $history->keyword }}
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="mr-1 rounded-circle">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="features-activities.html" class="dropdown-item has-icon">
                    <i class="fas fa-bolt"></i> Activities
                </a>
                <div class="dropdown-divider"></div>
                <a role="button" class="dropdown-item has-icon text-danger" id="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form action="{{ route('logout') }}" method="post" id="logout-form">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

@push('scripts')
    <script>
        const logoutBtn = document.getElementById('logout-btn');
        const logoutForm = document.getElementById('logout-form');

        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            logoutForm.submit();
        });
    </script>
@endpush
