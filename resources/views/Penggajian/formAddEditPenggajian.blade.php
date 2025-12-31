<div class="modal-form-overlay">
    <div class="modal-form">
        <h3>{{ isset($penggajian) ? 'Edit Data Penggajian' : 'Tambah Data Penggajian' }}</h3>

        <form id="formPenggajian">
            @csrf
            <input type="hidden" id="penggajian_id" value="{{ $penggajian->id ?? '' }}">

            <div class="form-group">
                <label>Kode Penggajian</label>
                <input type="text" id="kode_penggajian" class="form-control"
                    value="{{ $penggajian->kode_penggajian ?? '' }}">
            </div>

            <div class="form-group">
                <label>Nama Karyawan</label>
                <select id="karyawan_id" class="form-control">
                    <option value="">Pilih Karyawan</option>
                    @foreach($karyawans as $k)
                        <option value="{{ $k->id }}"
                            {{ isset($penggajian) && $penggajian->karyawan_id == $k->id ? 'selected' : '' }}>
                            {{ $k->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" id="tanggal" class="form-control"
                    value="{{ $penggajian->tanggal ?? '' }}">
            </div>

            <div class="form-group">
                <label>Gaji Pokok</label>
                <input type="number" id="gaji_pokok" class="form-control"
                    value="{{ $penggajian->gaji_pokok ?? '' }}">
            </div>

            <div class="button-group">
                <button type="submit" class="btn-jobdesk">Simpan</button>
                <button type="button" class="btn-danger" data-close>Batal</button>
            </div>
        </form>
    </div>
</div>
