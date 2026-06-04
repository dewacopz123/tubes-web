@php
    use App\Models\Karyawan;

    $karyawan = null;

    if (auth()->check()) {
        $karyawan = Karyawan::where('email', auth()->user()->email)->first();
    }
@endphp

<div id="sidebar" class="sidebar">
    <div class="sidebar-header">
        <img src="/asset/img/logo2.jpg?v=20260521" alt="SEK Logo" class="sidebar-logo">
        <h3 class="logo-text">SEKP DASHBOARD</h3>
    </div>

    <nav class="sidebar-nav">
        <ul>
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><a href="{{ url('/dashboard') }}"><img
                        src="/asset/Icon/dashboard.png"><span>Dashboard</span></a></li>
            <li class="{{ request()->is('absensi*') ? 'active' : '' }}"><a href="{{ url('/absensi') }}"><img
                        src="/asset/Icon/absensi.png"><span>Absensi</span></a></li>
            <li class="{{ request()->is('karyawan*') ? 'active' : '' }}"><a href="{{ url('/karyawan') }}"><img
                        src="/asset/Icon/data_karyawan.png"><span>Data Karyawan</span></a></li>
            <li class="{{ request()->is('jobdesk*') ? 'active' : '' }}"><a href="{{ url('/jobdesk') }}"><img
                        src="/asset/Icon/data_jobdesk.png"><span>Data Jobdesk</span></a></li>
            <li class="{{ request()->is('penggajian*') ? 'active' : '' }}"><a href="{{ url('/penggajian') }}"><img
                        src="/asset/Icon/penggajihan.png"><span>Penggajian</span></a></li>

            <li class="menu-divider">ACCOUNT PAGES</li>

            <li class="{{ request()->routeIs('profile') || request()->is('profile*') ? 'active' : '' }}"><a
                    href="{{ url('/profile') }}"><img src="/asset/Icon/profile.png"><span>Profile</span></a></li>

            <li>
                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-link">
                        <img src="/asset/Icon/logout.png">
                        <span>Log Out</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</div>

<header class="top-navbar">
    <div class="navbar-left">
        <!-- TOGGLE BUTTON (FIXED ID) -->
        <button id="sidebar-toggle" class="toggle-btn">
            <i class="fas fa-bars"></i>
        </button>

        <h1 id="navbar-page-title" class="navbar-title">Dashboard</h1>
    </div>

    <div class="navbar-right">
        <div class="user-profile">
            <img src="/asset/Icon/profile.png" class="profile-img">
            <span>
                {{ $karyawan->nama ?? 'Nama Karyawan' }},
                {{ ucfirst($karyawan->role ?? auth()->user()->role ?? 'User') }}
            </span>
        </div>
    </div>
</header>