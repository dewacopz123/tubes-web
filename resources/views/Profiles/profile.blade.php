<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Etos Kerja - Edit Profile</title>
  <link rel="stylesheet" href="../../asset/css/menu_style.css">
  <link rel="stylesheet" href="../../asset/css/formAddEdit.css">

</head>

<body>

  <div id="navbar-placeholder" data-src="../Navbar/navbar.html"></div>

  <div id="main-wrapper" class="main-wrapper">

    <main class="profile">
      <section class="container">
        <div class="header">
          <h2 class="title">Edit Profile</h2>
          <img src="../../asset/img/akbar.png" alt="User Photo" class="photo" id="profilePhoto" >

        </div>

        <form class="form">
          <div class="group">
            <label for="id">ID</label>
            <input type="text" id="id" placeholder="USR-00123">
          </div>

          <div class="row">
            <div class="group">
              <label for="name">Nama</label>
              <input type="text" id="name" placeholder="Muhammad Akbar Alfarizi">
            </div>
            <div class="group">
              <label for="email">Email</label>
              <input type="email" id="email" placeholder="akbaralfarizi@email.com">
            </div>
          </div>

          <div class="row">
            <div class="group">
              <label for="phone">Telepon</label>
              <input type="text" id="phone" placeholder="+62 812-3456-7890">
            </div>
            <div class="group">
              <label for="role">Role</label>
              <input type="text" id="role" value="Karyawan" disabled>
            </div>
          </div>

          <div class="row">
            <div class="group">
              <label for="status">Status</label>
              <input type="text" id="status" value="Aktif" disabled>
            </div>
            <div class="group">

            </div>
          </div>

          <div>
            <button type="button" class="btn-danger">Cancel</button>
            <button type="submit" class="btn-jobdesk">Save</button>
          </div>
        </form>
      </section>
    </main>
  </div>

   
  <script src="../../asset/js/load_navbar.js"></script>
  <script src="../../asset/js/profile.js"></script>
  <script src="../../asset/js/navbar.js"></script>

</body>

</html>