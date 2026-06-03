<div class="modal-form-overlay">
    <div class="modal-form">
        <span class="modal-close" data-close>&times;</span>
        <h3 id="modalTitle">Jobdesk</h3>
        <form id="formJobdesk">
            <input type="hidden" id="jobdesk_id" name="jobdesk_id" value="">

            <div class="group">
                <label for="nama_jobdesk">Nama Jobdesk</label>
                <input type="text" name="nama_jobdesk" id="nama_jobdesk" class="form-control" required>
                <div class="input-error" id="error-nama_jobdesk"></div>
            </div>

            <div class="group">
                <label for="tugas_utama">Tugas Utama</label>
                <input type="text" name="tugas_utama" id="tugas_utama" class="form-control" required>
                <div class="input-error" id="error-tugas_utama"></div>
            </div>

            <div class="group">
                <label for="karyawan_id">Karyawan</label>
                <select name="karyawan_id" id="karyawan_id" class="form-control" required>
                    <option value="">Pilih Karyawan</option>
                    @foreach ($karyawans as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                    @endforeach
                </select>
                <div class="input-error" id="error-karyawan_id"></div>
            </div>

            <button type="submit" class="btn-jobdesk">Simpan</button>
        </form>
    </div>
</div>
