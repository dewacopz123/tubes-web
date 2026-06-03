<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Jobdesk;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class JobdeskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * WBT-001
     * Menguji halaman index jobdesk.
     */
    private function login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);
    }

    private function createKaryawan(array $attributes = []): Karyawan
    {
        return Karyawan::create(array_merge([
            'kode_karyawan' => 'KRY' . str_pad((string) Karyawan::count() + 1, 3, '0', STR_PAD_LEFT),
            'nama' => 'Budi Santoso',
            'email' => 'budi' . (Karyawan::count() + 1) . '@example.com',
            'telepon' => '08123456789',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
            'status' => 'Aktif',
        ], $attributes));
    }

    private function createJobdesk(array $attributes = []): Jobdesk
    {
        $karyawan = $attributes['karyawan_id'] ?? $this->createKaryawan()->id;

        return Jobdesk::create(array_merge([
            'nama_jobdesk' => 'Admin Sistem',
            'tugas_utama' => 'Mengelola sistem perusahaan',
            'karyawan_id' => $karyawan,
        ], $attributes));
    }

    public function test_index_page_can_be_accessed()
    {
        $this->login();
        $response = $this->get('/jobdesk');

        $response->assertStatus(200);
    }

    /**
     * WBT-002
     * Menguji index saat data kosong.
     */
    public function test_index_page_when_no_data_exists()
    {
        $this->login();

        $this->assertDatabaseCount('jobdesks', 0);

        $response = $this->get('/jobdesk');

        $response->assertStatus(200);
    }

    /**
     * WBT-003
     * Store data berhasil.
     */
    public function test_store_jobdesk_success()
    {
        $this->login();
        $karyawan = $this->createKaryawan();

        $response = $this->post('/jobdesk', [
            'nama_jobdesk' => 'Admin Sistem',
            'tugas_utama' => 'Mengelola sistem perusahaan',
            'karyawan_id' => $karyawan->id,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('jobdesks', [
            'nama_jobdesk' => 'Admin Sistem',
            'karyawan_id' => $karyawan->id,
        ]);
    }

    /**
     * WBT-004
     * Validasi nama_jobdesk kosong.
     */
    public function test_store_fails_when_nama_jobdesk_empty()
    {
        $this->login();
        $karyawan = $this->createKaryawan();

        $response = $this->from('/jobdesk')->post('/jobdesk', [
            'nama_jobdesk' => '',
            'tugas_utama' => 'Mengelola sistem',
            'karyawan_id' => $karyawan->id,
        ]);

        $response->assertSessionHasErrors('nama_jobdesk');
    }

    /**
     * WBT-005
     * Validasi tugas_utama kosong.
     */
    public function test_store_fails_when_tugas_utama_empty()
    {
        $this->login();
        $karyawan = $this->createKaryawan();

        $response = $this->from('/jobdesk')->post('/jobdesk', [
            'nama_jobdesk' => 'Admin',
            'tugas_utama' => '',
            'karyawan_id' => $karyawan->id,
        ]);

        $response->assertSessionHasErrors('tugas_utama');
    }

    /**
     * WBT-006
     * Validasi karyawan tidak ditemukan.
     */
    public function test_store_fails_when_karyawan_not_exists()
    {
        $this->login();

        $response = $this->from('/jobdesk')->post('/jobdesk', [
            'nama_jobdesk' => 'Admin',
            'tugas_utama' => 'Mengelola sistem',
            'karyawan_id' => 99999,
        ]);

        $response->assertSessionHasErrors('karyawan_id');
    }

    /**
     * WBT-007
     * Update berhasil.
     */
    public function test_update_jobdesk_success()
    {
        $this->login();
        $karyawan = $this->createKaryawan();

        $jobdesk = $this->createJobdesk([
            'karyawan_id' => $karyawan->id,
        ]);

        $response = $this->put("/jobdesk/{$jobdesk->id}", [
            'nama_jobdesk' => 'Supervisor',
            'tugas_utama' => 'Mengawasi tim',
            'karyawan_id' => $karyawan->id,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('jobdesks', [
            'id' => $jobdesk->id,
            'nama_jobdesk' => 'Supervisor',
        ]);
    }

    /**
     * WBT-008
     * Update ID tidak ditemukan.
     */
    public function test_update_non_existing_jobdesk()
    {
        $this->login();
        $karyawan = $this->createKaryawan();

        $response = $this->put('/jobdesk/99999', [
            'nama_jobdesk' => 'Supervisor',
            'tugas_utama' => 'Mengawasi tim',
            'karyawan_id' => $karyawan->id,
        ]);

        $response->assertStatus(404);
    }

    /**
     * WBT-009
     * Update gagal nama kosong.
     */
    public function test_update_fails_when_nama_jobdesk_empty()
    {
        $this->login();
        $karyawan = $this->createKaryawan();

        $jobdesk = $this->createJobdesk([
            'karyawan_id' => $karyawan->id,
        ]);

        $response = $this->from('/jobdesk')->put("/jobdesk/{$jobdesk->id}", [
            'nama_jobdesk' => '',
            'tugas_utama' => 'Mengawasi tim',
            'karyawan_id' => $karyawan->id,
        ]);

        $response->assertSessionHasErrors('nama_jobdesk');
    }

    /**
     * WBT-010
     * Update gagal karena karyawan tidak ada.
     */
    public function test_update_fails_when_karyawan_not_found()
    {
        $this->login();
        $jobdesk = $this->createJobdesk();

        $response = $this->from('/jobdesk')->put("/jobdesk/{$jobdesk->id}", [
            'nama_jobdesk' => 'Supervisor',
            'tugas_utama' => 'Mengawasi tim',
            'karyawan_id' => 99999,
        ]);

        $response->assertSessionHasErrors('karyawan_id');
    }

    /**
     * WBT-011
     * Show data berhasil.
     */
    public function test_show_jobdesk_success()
    {
        $this->login();
        $jobdesk = $this->createJobdesk();

        $response = $this->get("/jobdesk/{$jobdesk->id}");

        $response->assertStatus(200);
    }

    /**
     * WBT-012
     * Show ID tidak ditemukan.
     */
    public function test_show_non_existing_jobdesk()
    {
        $this->login();

        $response = $this->get('/jobdesk/99999');

        $response->assertStatus(404);
    }

    /**
     * WBT-013
     * Delete berhasil.
     */
    public function test_delete_jobdesk_success()
    {
        $this->login();
        $jobdesk = $this->createJobdesk();

        $response = $this->delete("/jobdesk/{$jobdesk->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('jobdesks', [
            'id' => $jobdesk->id,
        ]);
    }

    /**
     * WBT-014
     * Delete ID tidak ditemukan.
     */
    public function test_delete_non_existing_jobdesk()
    {
        $this->login();

        $response = $this->delete('/jobdesk/99999');

        $response->assertStatus(404);
    }

    /**
     * WBT-015
     * Menguji form tambah/edit.
     */
    public function test_form_page_can_be_accessed()
    {
        $this->login();

        $response = $this->get('/jobdesk/form');

        $response->assertStatus(200);
    }
}
