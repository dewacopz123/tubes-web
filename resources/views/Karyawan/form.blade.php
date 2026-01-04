<div class="modal-form-overlay">
    <div class="modal-form">
        <h3 id="modalTitle">Tambah Data Karyawan</h3>

        <form id="formKaryawan" class="form-karyawan">
            <!-- hidden untuk mode & id -->
            <input type="hidden" id="mode" value="create">
            <input type="hidden" id="karyawanId">

            <div class="form-group">
                <label for="namaKaryawan">Nama</label>
                <input type="text" id="namaKaryawan" class="form-control" required />
            </div>

            <div class="form-group">
                <label for="emailKaryawan">Email</label>
                <input type="email" id="emailKaryawan" class="form-control" required />
            </div>

            <div class="form-group">
                <label for="teleponKaryawan">Telepon</label>
                <input type="text" id="teleponKaryawan" class="form-control" />
            </div>

            <div class="form-group">
                <label for="roleKaryawan">Role</label>
                <select id="roleKaryawan" class="form-control" required>
                    <option value="">Pilih Role</option>
                    <option value="karyawan">Karyawan</option>
                    <option value="admin">Admin</option>
                </select>

            </div>

            <div class="form-group">
                <label for="statusKaryawan">Status</label>
                <select id="statusKaryawan" class="form-control" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
            </div>

            <div class="button-group">
                <button type="submit" class="btn-jobdesk" id="btnSubmit">
                    Simpan
                </button>
                <button type="button" class="btn-danger" data-close>Batal</button>
            </div>
        </form>
    </div>
</div>