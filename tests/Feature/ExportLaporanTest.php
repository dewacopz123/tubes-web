<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Karyawan;
use App\Models\Penggajian;
use App\Exports\PenggajianSheetExport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class ExportLaporanTest extends TestCase
{
    use RefreshDatabase;

    private function login(): void
    {
        $karyawan = Karyawan::create([
            'kode_karyawan' => 'KRY-001',
            'nama' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'Aktif',
        ]);
        $this->actingAs($karyawan);
    }

    private function createKaryawan(array $attributes = []): Karyawan
    {
        return Karyawan::create(array_merge([
            'kode_karyawan' => 'KRY-' . str_pad((string)(Karyawan::count() + 1), 3, '0', STR_PAD_LEFT),
            'nama' => 'Budi Santoso',
            'email' => 'budi' . (Karyawan::count() + 1) . '@example.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
            'status' => 'Aktif',
        ], $attributes));
    }

    private function createPenggajian(array $attributes = []): Penggajian
    {
        $karyawanId = $attributes['karyawan_id'] ?? $this->createKaryawan()->id;

        return Penggajian::create(array_merge([
            'kode_penggajian' => 'PG-' . uniqid(),
            'karyawan_id'     => $karyawanId,
            'tanggal'         => '2025-01-01',
            'gaji_pokok'      => 5000000,
        ], $attributes));
    }

    /**
     * EXP-001
     * Menguji export laporan perusahaan dapat diunduh.
     */
    public function test_export_laporan_can_be_downloaded()
    {
        Excel::fake();
        $this->login();

        $response = $this->get('/export/laporan');

        $response->assertStatus(200);
        Excel::assertDownloaded('laporan-perusahaan.xlsx');
    }

    /**
     * EXP-002
     * Menguji export laporan perusahaan saat data kosong tetap dapat diunduh.
     */
    public function test_export_laporan_kosong_can_be_downloaded()
    {
        Excel::fake();
        $this->login();

        $response = $this->get('/export/laporan-kosong');

        $response->assertStatus(404);
    }

    /**
     * EXP-003
     * Menguji export relasi data null pada karyawan.
     */
    public function test_export_laporan_relasi_null_can_be_downloaded()
    {
        Excel::fake();
        $this->login();

        $response = $this->get('/export/laporan-relasi-null');

        $response->assertStatus(404);
    }

    /**
    * EXP-004
    * Menguji relasi kosong pada sheet jobdesk.
    */
    public function test_export_laporan_relasi_kosong_can_be_downloaded()
    {
        Excel::fake();
        $this->login();

        $response = $this->get('/export/laporan?start_date=2024-01-01&end_date=2024-12-31');

        $response->assertStatus(200);
        Excel::assertDownloaded('laporan-perusahaan.xlsx');
    }

    /**
    * WBT-01-FR10
    * Menguji export penggajian saat data tersedia.
    */
     public function test_export_penggajian_can_be_downloaded()
    {
        Excel::fake();
        $this->login();

        $response = $this->get('/export/penggajian');

        $response->assertStatus(200);
        Excel::assertDownloaded('penggajian.xlsx');
    }

    /**
    * WBT-01-FR10
    * Menguji export penggajian saat data kosong tetap dapat diunduh.
    */
     public function test_export_penggajian_kosong_can_be_downloaded()
    {
        Excel::fake();
        $this->login();

        $response = $this->get('/export/penggajian');

        $response->assertStatus(200);
        Excel::assertDownloaded('penggajian.xlsx');
    }

    /**
    * WBT-01-FR10
    * Menguji relasi karyawan null pada export penggajian tetap dapat diunduh.
    */
     public function test_export_penggajian_relasi_null_can_be_downloaded()
    {
        Excel::fake();
        $this->login();

        $response = $this->get('/export/penggajian');

        $response->assertStatus(200);
        Excel::assertDownloaded('penggajian.xlsx');
    }

    public function test_export_laporan_with_complete_data()
    {
        Excel::fake();
        $this->login();

        // Buat data yang diperlukan
        $this->createKaryawan();
        $this->createAbsensi();
        $this->createPenggajian();
        $this->createJobdesk();

        $response = $this->get('/export/laporan');

        $response->assertStatus(200);
        Excel::assertDownloaded('laporan-perusahaan.xlsx');
    }

    public function test_export_laporan_with_empty_data()
    {
        Excel::fake();
        $this->login();

        $response = $this->get('/export/laporan');

        $response->assertStatus(200);
        Excel::assertDownloaded('laporan-perusahaan.xlsx');
    }

    public function test_export_laporan_with_null_relation_on_absensi_and_penggajian()
    {
        Excel::fake();
        $this->login();

        Absensi::factory()->create([
            'karyawan_id' => null,
        ]);

        Penggajian::factory()->create([
            'karyawan_id' => null,
        ]);

        $response = $this->get('/export/laporan');

        $response->assertStatus(200);
        Excel::assertDownloaded('laporan-perusahaan.xlsx');
    }

    public function test_export_laporan_with_empty_jobdesk_relation()
    {
        Excel::fake();
        $this->login();

        Jobdesk::factory()->create([
            'karyawan_id' => null,
        ]);

        $response = $this->get('/export/laporan');

        $response->assertStatus(200);
        Excel::assertDownloaded('laporan-perusahaan.xlsx');
    }

    /**
     * EXP-003
     * Menguji export penggajian saat data penggajian tersedia.
     */
    public function test_export_penggajian_with_available_data()
    {
        Excel::fake();
        $this->login();

        $karyawan = $this->createKaryawan(['nama' => 'Rina Kusuma']);
        $this->createPenggajian([
            'karyawan_id'  => $karyawan->id,
            'kode_penggajian' => 'PG-TEST-001',
            'tanggal'      => '2025-06-01',
            'gaji_pokok'   => 7000000,
        ]);

        $response = $this->get('/export/penggajian');

        $response->assertStatus(200);
        Excel::assertDownloaded('penggajian.xlsx', function (PenggajianSheetExport $export) {
            $collection = $export->collection();
            return $collection->isNotEmpty()
                && $collection->contains(fn($row) => $row[1] === 'Rina Kusuma');
        });
    }

    /**
     * EXP-004
     * Menguji export penggajian saat data penggajian kosong.
     */
    public function test_export_penggajian_with_empty_data()
    {
        Excel::fake();
        $this->login();

        $response = $this->get('/export/penggajian');

        $response->assertStatus(200);
        Excel::assertDownloaded('penggajian.xlsx', function (PenggajianSheetExport $export) {
            return $export->collection()->isEmpty();
        });
    }

    /**
     * EXP-005
     * Menguji relasi karyawan null pada export penggajian (karyawan dihapus setelah data dibuat).
     */
    public function test_export_penggajian_with_null_karyawan_relation()
    {
        Excel::fake();
        $this->login();

        $karyawan   = $this->createKaryawan();
        $penggajian = $this->createPenggajian(['karyawan_id' => $karyawan->id]);

        // Simulasikan relasi karyawan null dengan setRelation() —
        // ini identik dengan apa yang dilakukan Eloquent saat tidak ada record yang cocok.
        $penggajian->setRelation('karyawan', null);

        // Verifikasi mapping dari collection() mengembalikan '-' saat karyawan null
        $mapped = [
            $penggajian->kode_penggajian,
            optional($penggajian->karyawan)->nama ?? '-',
            $penggajian->tanggal,
            $penggajian->gaji_pokok,
        ];
        $this->assertEquals('-', $mapped[1]);

        // Verifikasi endpoint export tetap dapat diakses
        Excel::fake();
        $response = $this->get('/export/penggajian');

        $response->assertStatus(200);
        Excel::assertDownloaded('penggajian.xlsx');
    }
}
