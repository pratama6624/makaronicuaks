<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Auth as AuthModel;

class AuthController extends BaseController
{
    protected $request;
    protected $authModel;
    protected $validation;
    protected $email;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->authModel = new AuthModel;
        $this->validation = \Config\Services::validation();
    }

    public function login(): string
    {
        $data = [
            "title" => "Login"
        ];

        // dd($this->authModel->getUsers());

        return view('Auth/Login', $data);
    }

    public function register(): string
    {
        $data = [
            "title" => "Daftar Akun"
        ];

        return view('Auth/Register', $data);
    }

    public function registerSuccess(): string
    {
        $data = [
            "title" => "Daftar akun sukses"
        ];

        return view('Auth/RegisterSuccess', $data);
    }

    public function verificationSuccess(): string
    {
        $data = [
            "title" => "Verifikasi akun sukses"
        ];

        return view('Auth/VerificationSuccess', $data);
    }

    public function registerFailed(): string
    {
        $data = [
            "title" => "Daftar akun gagal"
        ];

        return view('Auth/RegisterFailed', $data);
    }

    public function save() 
    {
        // Tangkap data input user dari sisi front end
        $user_data = [
            "username" => $this->request->getPost('username'),
            "email" => $this->request->getPost('email'),
            "address" => $this->request->getPost('address'),
            "no_tlp" => $this->request->getPost('no_tlp'),
            "password" => $this->request->getPost('password'),
            "confirm_password" => $this->request->getPost('confirm_password')
        ];

        // Validasi aturan data input user
        $this->validation->setRules([
            "username" => 'required|max_length[50]',
            "email" => 'required|max_length[50]|is_unique[users.email]',
            "password" => 'required|min_length[8]',
            "confirm_password" => 'required|matches[password]'
        ]);

        if(!$this->validation->withRequest($this->request)->run()) {
            return redirect()->to('register')->with('validation', $this->validation);
        }

        // Buat random token untuk aktivasi user melalui smtp mail (gmail)
        $token = bin2hex(random_bytes(32));

        // Simpan ke database users
        $this->authModel->save([
            "username" => $user_data["username"],
            "email" => $user_data["email"],
            "password" => password_hash($user_data["confirm_password"], PASSWORD_BCRYPT),
            "address" => $user_data["address"],
            "no_tlp" => strval($user_data["no_tlp"]),
            "img_profile" => "",
            "verification_token" => $token,
            "status" => 0,
            "role" => 2
        ]);

        // Verifikasi email aktivasi akun untuk menghindari spam
        $this->email = \Config\Services::email();
        $this->email->setFrom("kukuh.wd123@gmail.com", "Makaroni Cuaks");
        $this->email->setTo($user_data["email"]);
        $this->email->setSubject("Verivikasi Email");
        $this->email->setMessage('Click this link to verify your email: <a href="' . base_url() . '/verify-email/' . $token . '">Verify Email</a>');

        if (!$this->email->send()) {
            return redirect()->to('registerfailed');
        }

        return redirect()->to('registersuccess'); // Redirect ke halaman sukses
    }

    public function verifyEmail($token)
    {
        $user = $this->authModel->where("verification_token", $token)->first();

        if($user) {
            $this->authModel->update($user["id"], ["status" => 1, "verification_token" => null]);

            return redirect()->to("/verificationsuccess");
        } else {
            return 'Invalid token.';
        }
    }
}