<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Etos Kerja - Data Karyawan</title>
    <link rel="stylesheet" href="../../asset/css/menu_style.css">
    <link rel="stylesheet" href="../../asset/css/formAddEdit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div id="navbar-placeholder" data-src="../Navbar/navbar.html"></div>

    <div id="main-wrapper" class="main-wrapper">
        <main class="page-content">
            <h2>Data Karyawan</h2>

            <div class="card-content">
                <div>
                    <label for="searchNama" class="">Nama</label>
                    <select class="searchCategory" id="searchNama">
                        <option value="">Choose</option>
                    </select>
                    <label for="searchRole" class="">Role</label>
                    <select class="searchCategory" id="searchRole">
                        <option value="">Choose</option>
                    </select>
                </div>
            </div>

            <button id="btnAddKaryawan" class="btn-primary">Tambah</button>
            <button id="btnEditKaryawan" class="btn-warning">Edit</button>
            <button id="btnDeleteKaryawan" class="btn-danger">Hapus</button>

            <div id="popupContainer"></div>

            <div class="card-content">
                <h3>Tabel Data Karyawan</h3>
                <table class="table-absensi">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <tr>
                            <td>001</td>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>08123456789</td>
                            <td>Karyawan</td>
                            <td>Aktif</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="../../asset/js/load_navbar.js"></script>
    <script src="../../asset/js/data_karyawan.js"></script>
    <script src="../../asset/js/navbar.js"></script>

</body>

</html>
