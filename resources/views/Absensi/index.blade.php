<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Etos Kerja - Absensi</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/menu_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/formAddEdit.css') }}">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    {{-- Navbar --}}
    @include('navbar.navbar')

    <div class="main-wrapper">

        <main class="page-content">

            <h1 class="page-title">Absensi</h1>

            {{-- BUTTON ABSENSI --}}
            <div class="card-content">
                <label for="selectKaryawan">Pilih Karyawan:</label>
                <select id="selectKaryawan" class="form-control">
                    @foreach($karyawans as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="button-group-horizontal">
                <button class="btn btn-primary btn-full" id="btnMasukKerja">
                    <i class="fas fa-sign-in-alt"></i> Masuk Kerja
                </button>
                <button class="btn btn-danger btn-full" id="btnKeluarKerja">
                    <i class="fas fa-sign-out-alt"></i> Selesai Kerja
                </button>
            </div>

            <table class="table-absensi">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($absensis as $a)
                    <tr>
                        <td>{{ $a->id }}</td>
                        <td>{{ $a->karyawan->nama }}</td>
                        <td>{{ $a->karyawan->email }}</td>
                        <td>{{ $a->tanggal }}</td>
                        <td>{{ $a->jam_masuk ?? '-' }}</td>
                        <td>{{ $a->jam_keluar ?? '-' }}</td>
                        <td>{{ $a->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>


        </main>

        {{-- Popup --}}
        <div id="popupContainer"></div>

    </div>

    {{-- JS --}}
    <script src="{{ asset('js/load_navbar.js') }}"></script>
    <script src="{{ asset('js/absensi.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>

</body>

</html>