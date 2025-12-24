<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Etos Kerja - Jobdesk</title>
    <link rel="stylesheet" href="../../asset/css/menu_style.css">
    <link rel="stylesheet" href="../../asset/css/formAddEdit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div id="navbar-placeholder" data-src="../Navbar/navbar.html"></div>

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

            <button id="btnAddJobdesk" class="btn-primary">Tambah</button>
            <button id="btnEditJobdesk" class="btn-warning">Edit</button>
            <button class="btn-danger">Hapus</button>
            <button id="btnAddJobdeskKaryawan" class="btn-jobdesk">+</button>

            <div id="popupContainer"></div>

            <div class="card-content">
                <h3>Jobdesk Table</h3>
                <table class="table-absensi">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Jobdesk</th>
                            <th>Tugas Utama</th>
                            <th>Nama Karyawan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>001</td>
                            <td>Front-End Dev</td>
                            <td>Mengembangkan UI</td>
                            <td>John Doe</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="../../asset/js/load_navbar.js"></script>
    <script src="../../asset/js/jobdesk.js"></script>
    <script src="../../asset/js/absensi.js"></script>
    <script src="../../asset/js/navbar.js"></script>

</body>

</html>
