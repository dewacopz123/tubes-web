<div class="modal-form-overlay">
    <div class="modal-form">
        <h3>Tambah Jobdesk</h3>

        <form id="formJobdesk">
            @csrf

            <!-- 🔑 ID JOBDESK (UNTUK EDIT) -->
            <input type="hidden" id="jobdesk_id">

            <div class="form-group">
                <label>Nama Jobdesk</label>
                <input name="nama_jobdesk" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Tugas Utama</label>
                <input name="tugas_utama" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Karyawan</label>
                <select name="karyawan_id" class="form-control" required>
                    @foreach($karyawans as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-jobdesk">Simpan</button>
            <button type="button" class="btn-danger" data-close>Batal</button>
        </form>
    </div>
</div>
