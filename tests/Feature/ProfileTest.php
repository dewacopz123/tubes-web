<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Karyawan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    private function createKaryawan(array $attributes = []): Karyawan
    {
        return Karyawan::create(array_merge([
            'kode_karyawan' => 'KRY' . str_pad((string)(Karyawan::count() + 1), 3, '0', STR_PAD_LEFT),
            'nama' => 'Budi Santoso',
            'email' => 'budi' . (Karyawan::count() + 1) . '@example.com',
            'telepon' => '08123456789',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
            'status' => 'Aktif',
        ], $attributes));
    }

    private function login(): Karyawan
    {
        $karyawan = $this->createKaryawan();
        $this->actingAs($karyawan);
        return $karyawan;
    }

    /**
     * PRF-001
     * Menguji halaman profil dapat diakses.
     */
    public function test_profile_page_can_be_accessed()
    {
        $this->login();
        $response = $this->get('/profile');
        $response->assertStatus(200);
    }

    /**
     * PRF-002
     * Update profil berhasil dan mengembalikan JSON.
     */
    public function test_update_profile_success_returns_json()
    {
        $karyawan = $this->login();

        $response = $this->postJson('/profile', [
            'nama' => 'Budi Baru',
            'email' => $karyawan->email,
            'telepon' => '081234567890',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['success' => true]);
        $this->assertDatabaseHas('karyawans', [
            'id' => $karyawan->id,
            'nama' => 'Budi Baru',
        ]);
    }

    /**
     * PRF-003
     * Update profil berhasil dan melakukan redirect.
     */
    public function test_update_profile_success_redirects()
    {
        $karyawan = $this->login();

        $response = $this->from('/profile')->post('/profile', [
            'nama' => 'Budi Baru',
            'email' => $karyawan->email,
            'telepon' => '081234567890',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('karyawans', [
            'id' => $karyawan->id,
            'nama' => 'Budi Baru',
        ]);
    }

    /**
     * PRF-004
     * Update profil gagal ketika nama kosong.
     */
    public function test_update_fails_when_nama_empty()
    {
        $karyawan = $this->login();

        $response = $this->postJson('/profile', [
            'nama' => '',
            'email' => $karyawan->email,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('nama');
    }

    /**
     * PRF-005
     * Update profil gagal ketika nama mengandung karakter khusus atau angka.
     */
    public function test_update_fails_when_nama_has_special_chars()
    {
        $karyawan = $this->login();

        $response = $this->postJson('/profile', [
            'nama' => 'Budi@123',
            'email' => $karyawan->email,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('nama');
    }

    /**
     * PRF-006
     * Update profil gagal ketika email sudah digunakan akun lain.
     */
    public function test_update_fails_when_email_duplicate()
    {
        $karyawan = $this->login();
        $this->createKaryawan(['email' => 'other@example.com']);

        $response = $this->postJson('/profile', [
            'nama' => 'Budi Santoso',
            'email' => 'other@example.com',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }

    /**
     * PRF-007
     * Update profil gagal ketika format telepon tidak valid.
     */
    public function test_update_fails_when_telepon_invalid()
    {
        $karyawan = $this->login();

        $response = $this->postJson('/profile', [
            'nama' => 'Budi Santoso',
            'email' => $karyawan->email,
            'telepon' => 'abc-invalid!',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('telepon');
    }
}
