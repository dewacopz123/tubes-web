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
            <div class="button-group-horizontal">
                <button class="btn btn-primary btn-full" id="btnMasukKerja">
                    <i class="fas fa-sign-in-alt"></i> Masuk Kerja
                </button>

                <button class="btn btn-danger btn-full" id="btnKeluarKerja">
                    <i class="fas fa-sign-out-alt"></i> Selesai Kerja
                </button>
            </div>
        </div>

        {{-- TABLE ABSENSI --}}
        <div class="card-content">
            <h3>Data Absensi</h3>

            <table class="table-absensi">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal & Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- CONTOH DATA --}}
                    <tr>
                        <td>001</td>
                        <td>John Doe</td>
                        <td>john@example.com</td>
                        <td>2023-10-20 08:30</td>
                        <td>
                            <span class="status-badge active">Masuk</span>
                        </td>
                    </tr>

                    <tr>
                        <td>002</td>
                        <td>Jane Smith</td>
                        <td>jane@example.com</td>
                        <td>2023-10-20 17:00</td>
                        <td>
                            <span class="status-badge done">Selesai</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

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
