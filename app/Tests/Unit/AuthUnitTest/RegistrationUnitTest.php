<?php

namespace App\Tests\Unit\AuthUnitTest;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\Auth;
use CodeIgniter\Test\Mock\MockEmail;

class RegistrationUnitTest extends CIUnitTestCase
{
    protected $authModel;

    protected function setUp(): void
    {
        parent::setUp();
        // Load model yang akan diuji
        $this->authModel = new Auth();
    }

    // Skenario ketika user mendaftar dengan data yang valid
    public function testRegistrationWithValidData()
    {
        // Simulasi data input user
        $user_data = [
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'address' => '123 Test Street',
            'no_tlp' => '08123456789',
            'password' => 'password123',
            'confirm_password' => 'password123'
        ];

        // Memastikan user belum ada sebelumnya
        $existingUser = $this->authModel->getUserByEmail($user_data['email']);
        $this->assertNull($existingUser);

        // Simulasi validasi input berhasil
        $this->assertTrue(strlen($user_data['password']) >= 8);

        // Buat token verifikasi dan hash password
        $token = bin2hex(random_bytes(32));
        $hashedPassword = password_hash($user_data["confirm_password"], PASSWORD_BCRYPT);

        // Simulasi penyimpanan ke database
        $saveResult = $this->authModel->save([
            'username' => $user_data['username'],
            'email' => $user_data['email'],
            'password' => $hashedPassword,
            'address' => $user_data['address'],
            'no_tlp' => $user_data['no_tlp'],
            'verification_token' => $token,
            'status' => 0,
            'role' => 0,
            'is_deleted' => 0
        ]);

        // Pastikan penyimpanan berhasil
        $this->assertTrue($saveResult);

        // Cek apakah user baru sudah ada di database
        $newUser = $this->authModel->getUserByEmail($user_data['email']);
        $this->assertNotNull($newUser);
        $this->assertEquals($user_data['email'], $newUser['email']);
    }

    // Skenario ketika user mendaftar ke sistem dan dalam keadaan SOFT DELETE aktif
    // SOFT DELETE aktif = user pernah terdaftar tetapi user tersebut dihapus
    public function testRegistrationWithSoftDeletedUser()
    {
        // Simulasi user sudah terdaftar dan dihapus (soft delete)
        $user_data = [
            'username' => 'deletedUser',
            'email' => 'deleted@example.com',
            'password' => 'password123',
            'confirm_password' => 'password123',
            'is_deleted' => 1
        ];

        // Simulasi data user dihapus
        $this->authModel->save([
            'username' => $user_data['username'],
            'email' => $user_data['email'],
            'password' => password_hash($user_data['confirm_password'], PASSWORD_BCRYPT),
            'address' => 'Deleted Address',
            'no_tlp' => '08987654321',
            'verification_token' => '',
            'status' => 1,
            'role' => 0,
            'is_deleted' => 1
        ]);

        // Cek apakah user sudah ada dan status soft delete aktif
        $deletedUser = $this->authModel->getUserByEmail($user_data['email']);
        $this->assertNotNull($deletedUser);
        $this->assertEquals(1, $deletedUser['is_deleted']);

        // Coba buat user ke arah melakukan pemulihan akun alih alih untuk registrasi ulang
        $existingUser = $this->authModel->getUserByEmail($user_data['email']);
        if ($existingUser && $existingUser['is_deleted'] == 1) {
            $this->assertEquals(1, $existingUser['is_deleted']);
        }
    }

    public function testRegistrationEmailSent()
    {
        // Simulasi data registrasi
        $user_data = [
            'username' => 'newUser',
            'email' => 'newuser@example.com',
            'password' => 'password123',
            'confirm_password' => 'password123'
        ];

        // Mock email untuk memastikan email dikirim
        $email = new MockEmail();
        $email->setFrom('test@example.com', 'Test');
        $email->setTo($user_data['email']);
        $email->setSubject('Verify your email');
        $email->setMessage('Please verify your email.');

        // Simulasikan pengiriman email
        $this->assertTrue($email->send());
    }
}