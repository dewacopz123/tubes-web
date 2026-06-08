<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Karyawan;
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
     * Menguji export data penggajian dapat diunduh.
     */
    public function test_export_penggajian_can_be_downloaded()
    {
        Excel::fake();
        $this->login();

        $response = $this->get('/export/penggajian');

        $response->assertStatus(200);
        Excel::assertDownloaded('penggajian.xlsx');
    }
}
