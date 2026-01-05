<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Etos Kerja - Data Penggajian</title>

    {{-- CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/menu_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/formAddEdit.css') }}">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    {{-- NAVBAR --}}
    @include('Navbar.navbar')

    <div class="main-wrapper">
        <main class="page-content">

            <h2>Data Penggajian</h2>

            {{-- FILTER --}}
            <div class="card-content">
                <div>
                    <label>Nama Karyawan</label>
                    <select id="filterNama" class="searchCategory">
                        <option value="">Semua</option>
                        @foreach($karyawans as $k)
                            <option value="{{ strtolower($k->nama) }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>

                    <label>Tanggal</label>
                    <input type="date" id="filterTanggal" class="searchCategory">
                </div>
            </div>

            {{-- BUTTON TAMBAH --}}
            @auth
                <div class="d-flex justify-content-between align-items-center mb-3">

                    {{-- KIRI: Tambah Penggajian --}}
                    @if(auth()->user()->role === 'admin')
                        <button id="btnAddPenggajian" class="btn btn-primary btn-long">
                            <i class="fas fa-plus"></i> Tambah Data Penggajian
                        </button>
                    @endif

                    {{-- KANAN: Export --}}
                    <button type="button" class="btn btn-export-pill" onclick="window.location.href='/export/penggajian'">
                        <i class="fas fa-file-excel"></i> Export Penggajian
                    </button>

                </div>
            @endauth


            {{-- TABLE --}}
            <div class="card-content">
                <h3>Tabel Data Penggajian</h3>

                <table class="table-absensi">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Karyawan</th>
                            <th>Tanggal</th>
                            <th>Gaji Pokok</th>
                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penggajians as $pg)
                            <tr data-nama="{{ strtolower($pg->karyawan->nama) }}" data-tanggal="{{ $pg->tanggal }}">
                                <td>{{ $pg->kode_penggajian }}</td>
                                <td>{{ optional($pg->karyawan)->nama ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($pg->tanggal)->format('d-m-Y') }}</td>
                                <td>Rp {{ number_format($pg->gaji_pokok, 0, ',', '.') }}</td>

                                @if(auth()->check() && auth()->user()->role === 'admin')
                                    <td class="aksi-icon">
                                        <button class="btnEdit icon-btn edit" data-id="{{ $pg->id }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button class="btnDelete icon-btn delete" data-id="{{ $pg->id }}" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center">
                                    Data penggajian belum tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- MODAL --}}
            <div id="popupContainer"></div>

        </main>
    </div>

    {{-- JS --}}
    <script src="{{ asset('js/load_navbar.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/penggajian.js') }}"></script>

</body>

</html>