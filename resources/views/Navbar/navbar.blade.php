<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="sidebar" class="sidebar">
  <div class="sidebar-header">
    <img src="../../asset/img/logo2.jpg" alt="SEK Logo" class="sidebar-logo">
    <h3 id="sek_logo" class="logo-text">SEK DASHBOARD</h3>
  </div>
  <nav class="sidebar-nav">
    <ul>
      <li><a href="#"><img src="../../asset/icon/dashboard.png"><span>Dashboard</span></a></li>
      <li><a href="../../Views/Absensi/absensi.html"><img src="../../asset/icon/absensi.png"><span>Absensi</span></a></li>
      <li><a href="../../Views/DataKaryawan/data_karyawan.html"><img src="../../asset/icon/data_karyawan.png"><span>Data Karyawan</span></a></li>
      <li><a href="../../Views/Jobdesk/jobdesk.html"><img src="../../asset/icon/data_jobdesk.png"><span>Data Jobdesk</span></a></li>
      <li><a href="../../Views/Penggajihan/penggajihan.html"><img src="../../asset/icon/penggajihan.png"><span>Penggajian</span></a></li>
      <li class="menu-divider">ACCOUNT PAGES</li>
      <li><a href="../../Views/Profiles/profile.html"><img src="../../asset/icon/profile.png"><span>Profile</span></a></li>
      <li><a href="../../Views/login/index.html"><img src="../../asset/icon/logout.png"><span>Log Out</span></a></li>
    </ul>
  </nav>

  <div class="sidebar-info-box">
    <i class="fas fa-question-circle"></i>
    <h4>Need Help?</h4>
    <p>Please check our docs</p>
    <button class="btn-docs">DOCUMENTATION</button>
  </div>
</div>

<header class="top-navbar">
  <button id="sidebar-toggle" class="toggle-btn"><i class="fas fa-bars"></i></button>
  <div class="navbar-right">
    <div class="user-profile">
      <img src="../../asset/img/profile.jpg" alt="User" class="profile-img">
      <span>Mustafiq, Admin</span>
    </div>
  </div>
</header>
    <script src="../../asset/js/absensi.js"></script>

</body>
</html>