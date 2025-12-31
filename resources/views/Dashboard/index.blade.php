<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Etos Kerja - Dashboard</title>

    <link rel="stylesheet" href="{{ asset('css/menu_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    @include('navbar.navbar')

    <div class="dashboard-container">

        <h2>Dashboard Sistem Etos Kerja</h2>

        <!-- JAM REALTIME -->
        <div class="clock-box">
            <h3 id="clock">00:00:00</h3>
            <p id="date">-</p>
        </div>

        <!-- STAT GRID -->
        <div class="stat-grid">

            <div class="stat-card">
                <h4>Total Karyawan</h4>
                <p>{{ $totalKaryawan }}</p>
            </div>

            <div class="stat-card success">
                <h4>Karyawan Aktif</h4>
                <p>{{ $karyawanAktif }}</p>
            </div>

            <div class="stat-card danger">
                <h4>Karyawan Nonaktif</h4>
                <p>{{ $karyawanNonaktif }}</p>
            </div>

            <div class="stat-card">
                <h4>Hadir Hari Ini</h4>
                <p>{{ $hadirHariIni }}</p>
            </div>

        </div>
        <h3>Status Jobdesk Karyawan</h3>

        <table class="jobdesk-table">
            <thead>
                <tr>
                    <th>Nama Karyawan</th>
                    <th>Status Karyawan</th>
                    <th>Jobdesk</th>
                </tr>
            </thead>
            <tbody>
                @foreach($karyawans as $karyawan)
                @if($karyawan->jobdesks->count())
                @foreach($karyawan->jobdesks as $jobdesk)
                <tr>
                    <td>{{ $karyawan->nama }}</td>
                    <td><span class="badge {{ strtolower($karyawan->status) }}">
                            {{ $karyawan->status }}
                        </span></td>
                    <td>{{ $jobdesk->nama_jobdesk }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td>{{ $karyawan->nama }}</td>
                    <td><span class="badge {{ strtolower($karyawan->status) }}">
                            {{ $karyawan->status }}
                        </span></td>
                    <td colspan="2">Belum ada jobdesk</td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="{{ asset('js/dashboard.js') }}"></script>

</body>

</html>