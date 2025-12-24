<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Etos Kerja - Data Penggajian</title>
    <link rel="stylesheet" href="../../asset/css/menu_style.css">
    <link rel="stylesheet" href="../../asset/css/formAddEdit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- navbar placeholder -->
    <div id="navbar-placeholder" data-src="../Navbar/navbar.html"></div>

    <div id="main-wrapper" class="main-wrapper">
        <main class="page-content">
            <h2>Data Penggajian</h2>

            <div class="card-content">
                <div>
                    <label for="searchNama" class="">Nama Karyawan</label>
                    <select class="searchCategory" id="searchNama">
                        <option value="">Choose</option>
                    </select>
                    <label for="searchTanggal" class="">Tanggal</label>
                    <input type="date" class="searchCategory" id="searchTanggal" />
                </div>
            </div>

            <button id="btnAddPenggajian" class="btn-primary">Tambah</button>
            <button id="btnEditPenggajian" class="btn-warning">Edit</button>
            <button id="btnDeletePenggajian" class="btn-danger">Hapus</button>

            <!-- Tempat popup muncul -->
            <div id="popupContainer"></div>

            <div class="card-content">
                <h3>Tabel Data Penggajian</h3>
                <table class="table-absensi">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Karyawan</th>
                            <th>Tanggal</th>
                            <th>Gaji Pokok</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <tr>
                            <td>PG001</td>
                            <td>John Doe</td>
                            <td>2025-10-25</td>
                            <td>5.000.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script src="../../asset/js/load_navbar.js"></script>
    <script src="../../asset/js/penggajihan.js"></script>
</body>
</html>