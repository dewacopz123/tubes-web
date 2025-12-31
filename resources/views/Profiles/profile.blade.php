<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Etos Kerja - Profile</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/menu_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/formAddEdit.css') }}">
</head>

<body>

    {{-- NAVBAR --}}
    @include('Navbar.navbar')

    <div class="main-wrapper">
        <main class="profile">
            <section class="container">

                <div class="header">
                    <h2 class="title">Edit Profile</h2>
                    <img
                        src="{{ asset('img/default-user.png') }}"
                        alt="User Photo"
                        class="photo"
                        id="profilePhoto">
                </div>

                <form class="form">

                    <div class="group">
                        <label>ID</label>
                        <input type="text" value="KRY-001" disabled>
                    </div>

                    <div class="row">
                        <div class="group">
                            <label>Nama</label>
                            <input type="text" value="Nama Karyawan">
                        </div>

                        <div class="group">
                            <label>Email</label>
                            <input type="email" value="karyawan@email.com">
                        </div>
                    </div>

                    <div class="row">
                        <div class="group">
                            <label>Telepon</label>
                            <input type="text" value="+62 812-3456-7890">
                        </div>

                        <div class="group">
                            <label>Role</label>
                            <input type="text" value="Karyawan" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="group">
                            <label>Status</label>
                            <input type="text" value="Aktif" disabled>
                        </div>
                        <div class="group"></div>
                    </div>

                    <div class="button-group">
                        <button type="button" class="btn-danger">Cancel</button>
                        <button type="button" class="btn-jobdesk">Save</button>
                    </div>

                </form>
            </section>
        </main>
    </div>

    {{-- JS --}}
    <script src="{{ asset('js/navbar.js') }}"></script>

</body>
</html>
