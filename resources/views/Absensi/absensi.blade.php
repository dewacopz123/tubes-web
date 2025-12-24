<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Etos Kerja - Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/menu_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div id="navbar-placeholder" data-src="../Navbar/navbar.html"></div>
    
    <div id="main-wrapper" class="main-wrapper">

        <main class="page-content">
            <h1>Absensi</h1>
            <div class="div">
                <div class="card-content-button4">
                    <div class="button-group">
                        <button class="btn-primary" id="btnMasukKerja">Masuk Kerja</button>
                        <button class="btn-danger" id="btnKeluarKerja">Selesai Kerja</button>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <h3>Absensi Table</h3>
                <table class="table-absensi">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal dan Waktu</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>001</td>
                            <td>John Doe</td>
                            <td>john@example.com</td>
                            <td>2023-10-20 08:30</td>
                            <td><span class="status-badge active">Masuk</span></td>
                        </tr>
                        <tr>
                            <td>002</td>
                            <td>Jane Smith</td>
                            <td>jane@example.com</td>
                            <td>2023-10-20 08:45</td>
                            <td><span class="status-badge">Selesai</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
        <div id="popupContainer"></div>
        
    </div>
    <script src="../../asset/js/load_navbar.js"></script>
    <script src="../../asset/js/absensi.js"></script>
    <script src="../../asset/js/navbar.js"></script>
</body>
</html>