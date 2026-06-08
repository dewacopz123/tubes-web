<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Karyawan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    private function createKaryawan(array $attributes = []): Karyawan
    {
        return Karyawan::create(array_merge([
            'kode_karyawan' => 'KRY' . str_pad((string)(Karyawan::count() + 1), 3, '0', STR_PAD_LEFT),
            'nama' => 'Budi Santoso',
            'email' => 'budi' . (Karyawan::count() + 1) . '@example.com',
            'telepon' => '08123456789',
            'password' => Hash::make('password123'),
            'role' => 'karyawan',
            'status' => 'Aktif',
        ], $attributes));
    }

    /**
     * LT-001
     * Menguji halaman login dapat diakses.
     */
    public function test_login_page_can_be_accessed()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    /**
     * LT-002
     * Login berhasil dengan kredensial yang valid.
     */
    public function test_login_success()
    {
        $karyawan = $this->createKaryawan([
            'email' => 'budi@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'budi@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($karyawan);
    }

    /**
     * LT-003
     * Login gagal ketika email tidak ditemukan.
     */
    public function test_login_fails_when_email_not_found()
    {
        $response = $this->from('/login')->post('/login', [
            'email' => 'tidakada@example.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * LT-004
     * Login gagal ketika akun berstatus Nonaktif.
     */
    public function test_login_fails_when_account_inactive()
    {
        $this->createKaryawan([
            'email' => 'nonaktif@example.com',
            'password' => Hash::make('password123'),
            'status' => 'Nonaktif',
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => 'nonaktif@example.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * LT-005
     * Login gagal ketika password salah.
     */
    public function test_login_fails_when_password_incorrect()
    {
        $this->createKaryawan(['email' => 'budi@example.com']);

        $response = $this->from('/login')->post('/login', [
            'email' => 'budi@example.com',
            'password' => 'salahpassword',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /**
     * LT-006
     * Login gagal ketika format email tidak valid.
     */
    public function test_login_fails_when_email_invalid_format()
    {
        $response = $this->from('/login')->post('/login', [
            'email' => 'bukan-email',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * LT-007
     * Register berhasil dengan data yang valid.
     */
    public function test_register_success()
    {
        $response = $this->post('/register', [
            'nama' => 'Andi Wijaya',
            'email' => 'andi@example.com',
            'password' => 'pass123',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('karyawans', ['email' => 'andi@example.com']);
    }

    /**
     * LT-008
     * Register gagal ketika nama mengandung angka atau karakter khusus.
     */
    public function test_register_fails_when_nama_has_numbers()
    {
        $response = $this->from('/login')->post('/register', [
            'nama' => 'Andi123',
            'email' => 'andi@example.com',
            'password' => 'pass123',
        ]);

        $response->assertSessionHasErrors('nama');
    }

    /**
     * LT-009
     * Register gagal ketika email sudah digunakan.
     */
    public function test_register_fails_when_email_duplicate()
    {
        $this->createKaryawan(['email' => 'andi@example.com']);

        $response = $this->from('/login')->post('/register', [
            'nama' => 'Andi Wijaya',
            'email' => 'andi@example.com',
            'password' => 'pass123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**
     * LT-010
     * Register gagal ketika password lebih dari 8 karakter.
     */
    public function test_register_fails_when_password_too_long()
    {
        $response = $this->from('/login')->post('/register', [
            'nama' => 'Andi Wijaya',
            'email' => 'andi@example.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /**
     * LT-011
     * Logout berhasil dan diarahkan ke halaman login.
     */
    public function test_logout_redirects_to_login()
    {
        $karyawan = $this->createKaryawan();
        $this->actingAs($karyawan);

        $response = $this->post('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
