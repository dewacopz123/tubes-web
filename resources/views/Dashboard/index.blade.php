<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    {{-- VITE (INI PENTING DI RAILWAY) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- fallback asset kalau masih pakai public/css --}}
    <link rel="stylesheet" href="{{ asset('css/menu_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    {{-- NAVBAR AMAN --}}
    @include('navbar.navbar')

    <div class="dashboard-container">

        <h2>Dashboard Sistem Etos Kerja</h2>

        {{-- CLOCK --}}
        <div class="clock-box">
            <h3 id="clock">00:00:00</h3>
            <p id="date">-</p>
        </div>

        {{-- STAT --}}
        <div class="stat-grid">

            <div class="stat-card">
                <h4>Total Karyawan</h4>
                <p>{{ $totalKaryawan ?? 0 }}</p>
            </div>

            <div class="stat-card success">
                <h4>Karyawan Aktif</h4>
                <p>{{ $karyawanAktif ?? 0 }}</p>
            </div>

            <div class="stat-card danger">
                <h4>Karyawan Nonaktif</h4>
                <p>{{ $karyawanNonaktif ?? 0 }}</p>
            </div>

            <div class="stat-card">
                <h4>Hadir Hari Ini</h4>
                <p>{{ $hadirHariIni ?? 0 }}</p>
            </div>

        </div>

        {{-- HEADER --}}
        <div class="jobdesk-header">
            <h3>Status Jobdesk Karyawan</h3>

            @if(auth()->check() && auth()->user()->role === 'admin')
                <button type="button"
                        class="btn btn-export-pill"
                        onclick="window.location.href='/export/laporan'">
                    <i class="fas fa-file-excel"></i> Export Laporan Excel
                </button>
            @endif
        </div>

        {{-- TABLE --}}
        <table class="jobdesk-table">
            <thead>
                <tr>
                    <th>Nama Karyawan</th>
                    <th>Status</th>
                    <th>Jobdesk</th>
                </tr>
            </thead>

            <tbody>
                @foreach($karyawans ?? [] as $karyawan)

                    @php
                        $jobdesks = $karyawan->jobdesks ?? collect();
                    @endphp

                    @if($jobdesks->count() > 0)

                        @foreach($jobdesks as $jobdesk)
                            <tr>
                                <td>{{ $karyawan->nama }}</td>
                                <td>
                                    <span class="badge {{ strtolower($karyawan->status) }}">
                                        {{ $karyawan->status }}
                                    </span>
                                </td>
                                <td>{{ $jobdesk->nama_jobdesk }}</td>
                            </tr>
                        @endforeach

                    @else
                        <tr>
                            <td>{{ $karyawan->nama }}</td>
                            <td>
                                <span class="badge {{ strtolower($karyawan->status) }}">
                                    {{ $karyawan->status }}
                                </span>
                            </td>
                            <td>Belum ada jobdesk</td>
                        </tr>
                    @endif

                @endforeach
            </tbody>
        </table>

    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>

</body>
</html>