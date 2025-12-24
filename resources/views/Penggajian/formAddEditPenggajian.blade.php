<div class="modal-form-overlay">
    <div class="modal-form">
        <h3>Tambah Data Penggajian</h3>
        <form id="formPenggajian" class="form-penggajian">
            <div class="form-group">
                <label for="idPenggajian">ID</label>
                <input type="text" id="idPenggajian" name="idPenggajian" class="form-control" required />
            </div>

            <div class="form-group">
                <label for="namaKaryawan">Nama Karyawan</label>
                <input type="text" id="namaKaryawan" name="namaKaryawan" class="form-control" required />
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control" required />
            </div>

            <div class="form-group">
                <label for="gajiPokok">Gaji Pokok</label>
                <input type="number" id="gajiPokok" name="gajiPokok" class="form-control" required />
            </div>

            <div class="button-group">
                <button type="submit" class="btn-jobdesk">Simpan</button>
                <button type="button" class="btn-danger" data-close>Batal</button>
            </div>
        </form>
    </div>
</div>