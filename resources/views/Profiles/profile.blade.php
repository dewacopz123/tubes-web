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

                {{-- FORM PROFILE --}}
                <form class="form" method="POST" action="{{ route('profile.update') }}">
                    @csrf

                    <div class="group">
                        <label>ID</label>
                        <input type="text" value="{{ $karyawan->id }}" disabled>
                    </div>

                    <div class="row">
                        <div class="group">
                            <label>Nama</label>
                            <input
                                type="text"
                                name="nama"
                                value="{{ old('nama', $karyawan->nama) }}"
                                required>
                        </div>

                        <div class="group">
                            <label>Email</label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $karyawan->email) }}"
                                required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="group">
                            <label>Telepon</label>
                            <input
                                type="text"
                                name="telepon"
                                value="{{ old('telepon', $karyawan->telepon) }}">
                        </div>

                        <div class="group">
                            <label>Role</label>
                            <input
                                type="text"
                                value="{{ $karyawan->role }}"
                                disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="group">
                            <label>Status</label>
                            <input
                                type="text"
                                value="{{ $karyawan->status }}"
                                disabled>
                        </div>
                        <div class="group"></div>
                    </div>

                    <div class="button-group">
                        <button type="button" id="btnEdit" class="btn-primary">Edit</button>
                        <button type="submit" id="btnSave" class="btn-jobdesk" style="display:none;">Save</button>
                    </div>


                </form>

                {{-- SUCCESS MESSAGE --}}
                @if(session('success'))
                    <script>
                        alert("{{ session('success') }}");
                    </script>
                @endif

            </section>
        </main>
    </div>

    {{-- JS --}}
    <script src="{{ asset('js/navbar.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".form");
    const btnEdit = document.getElementById("btnEdit");
    const btnSave = document.getElementById("btnSave");

    // Semua input disabled saat awal
    const inputs = form.querySelectorAll("input[name]");
    inputs.forEach(input => input.disabled = true);

    btnEdit.addEventListener("click", function () {
        inputs.forEach(input => input.disabled = false);

        btnEdit.style.display = "none";
        btnSave.style.display = "inline-block";
    });
});
</script>

</body>
</html>
