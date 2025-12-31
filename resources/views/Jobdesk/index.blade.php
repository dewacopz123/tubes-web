<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistem Etos Kerja - Jobdesk</title>
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/menu_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/formAddEdit.css') }}">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    @include('navbar.navbar')

    <div id="main-wrapper" class="main-wrapper">

        <main class="page-content">
            <h2>Jobdesk Karyawan</h2>

            <div class="card-content">
                <div>
                    <label for="searchJobdeskName" class="">Nama Jobdesk</label>
                    <select class="searchCategory" id="searchJobdeskName">
                        <option value="">Choose</option>
                    </select>
                    <label for="searchKaryawanName" class="">Nama Karyawan</label>
                    <select class="searchCategory" id="searchKaryawanName">
                        <option value="">Choose</option>
                    </select>
                </div>
            </div>

            <button id="btnAddJobdesk" class="btn-primary btn-long">Tambah Jobdesk</button>

            <div id="popupContainer"></div>

            <div class="card-content">
                <h3>Jobdesk Table</h3>
                <table class="table-absensi" id="jobdeskTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Jobdesk</th>
                            <th>Tugas Utama</th>
                            <th>Nama Karyawan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobdesks as $jobdesk)
                        <tr data-id="{{ $jobdesk->id }}">
                            <td>{{ $jobdesk->id }}</td>
                            <td class="col-jobdesk">{{ $jobdesk->nama_jobdesk }}</td>
                            <td>{{ $jobdesk->tugas_utama }}</td>
                            <td class="col-karyawan">{{ $jobdesk->karyawan->nama }}</td>
                            <td class="action-cell">
                                <button type="button" class="btn-edit icon-btn edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn-delete icon-btn delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </main>
    </div>

    <script src="{{ asset('js/load_navbar.js') }}"></script>
    <script src="{{ asset('asset/js/absensi.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/jobdesk.js') }}"></script>

</body>

</html>