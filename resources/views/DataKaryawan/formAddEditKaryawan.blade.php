<div class="modal-form-overlay">
    <div class="modal-form">
        <h3>Tambah Data Karyawan</h3>
        <form id="formKaryawan" class="form-karyawan">
            <div class="form-group">
                <label for="idKaryawan">ID Karyawan</label>
                <input type="text" id="idKaryawan" name="idKaryawan" class="form-control" required />
            </div>

            <div class="form-group">
                <label for="namaKaryawan">Nama</label>
                <input type="text" id="namaKaryawan" name="namaKaryawan" class="form-control" required />
            </div>

            <div class="form-group">
                <label for="emailKaryawan">Email</label>
                <input type="email" id="emailKaryawan" name="emailKaryawan" class="form-control" required />
            </div>

            <div class="form-group">
                <label for="teleponKaryawan">Telepon</label>
                <input type="text" id="teleponKaryawan" name="teleponKaryawan" class="form-control" required />
            </div>

            <div class="form-group">
                <label for="roleKaryawan">Role</label>
                <select id="roleKaryawan" name="roleKaryawan" class="form-control" required>
                    <option value="">Pilih Role</option>
                    <option value="Manager">Karyawan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="statusKaryawan">Status</label>
                <select id="statusKaryawan" name="statusKaryawan" class="form-control" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
            </div>

            <div class="button-group">
                <button type="submit" class="btn-jobdesk">Simpan</button>
                <button type="button" class="btn-danger" data-close>Batal</button>
            </div>
        </form>
    </div>
</div>
