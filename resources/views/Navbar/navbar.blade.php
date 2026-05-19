@php
    use App\Models\Karyawan;

    $karyawan = null;

    if (auth()->check()) {
        $karyawan = Karyawan::where('email', auth()->user()->email)->first();
    }
@endphp

<div id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <img src="{{ asset('asset/img/logo2.jpg') }}" alt="SEK Logo" class="sidebar-logo">
        <h3 class="logo-text">SEK DASHBOARD</h3>
    </div>

    <nav class="sidebar-nav">
        <ul>
            <li><a href="{{ url('/dashboard') }}"><img src="{{ asset('asset/Icon/dashboard.png') }}"><span>Dashboard</span></a></li>
            <li><a href="{{ url('/absensi') }}"><img src="{{ asset('asset/Icon/absensi.png') }}"><span>Absensi</span></a></li>
            <li><a href="{{ url('/karyawan') }}"><img src="{{ asset('asset/Icon/data_karyawan.png') }}"><span>Data Karyawan</span></a></li>
            <li><a href="{{ url('/jobdesk') }}"><img src="{{ asset('asset/Icon/data_jobdesk.png') }}"><span>Data Jobdesk</span></a></li>
            <li><a href="{{ url('/penggajian') }}"><img src="{{ asset('asset/Icon/penggajihan.png') }}"><span>Penggajian</span></a></li>

            <li class="menu-divider">ACCOUNT PAGES</li>

            <li><a href="{{ url('/profile') }}"><img src="{{ asset('asset/Icon/profile.png') }}"><span>Profile</span></a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-link">
                        <img src="{{ asset('asset/Icon/logout.png') }}"><span>Log Out</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</div>

<header class="top-navbar">
    <button id="sidebar-toggle" class="toggle-btn">
        <i class="fas fa-bars"></i>
    </button>

    <div class="navbar-right">
        <div class="user-profile">
            <img src="{{ asset('asset/Icon/profile.png') }}" class="profile-img">
            <span>
                {{ $karyawan->nama ?? 'Nama Karyawan' }},
                {{ ucfirst($karyawan->role ?? auth()->user()->role ?? 'User') }}
            </span>
        </div>
    </div>
</header>

<script src="{{ asset('js/navbar.js') }}"></script>