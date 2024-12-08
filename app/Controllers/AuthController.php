<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Auth as AuthModel;
use App\Models\Recovery as RecoveryModel;

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
        $this->recoveryModel = new RecoveryModel;
        $this->validation = \Config\Services::validation();
        $this->email = \Config\Services::email();
    }

    public function login(): string
    {
        $data = [
            "title" => "Login",
            "sideMenuTitle" => $this->request->getUri()->getSegment(1),
        ];

        return view('Auth/Login', $data);
    }

    public function register(): string
    {
        $data = [
            "title" => "Daftar Akun",
            "sideMenuTitle" => $this->request->getUri()->getSegment(1),
        ];

        return view('Auth/Register', $data);
    }

    public function accountRecovery(): string
    {
        $data = [
            "title" => "Recoveri Akun"
        ];

        return view('Auth/AccountRecovery', $data);
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

        // Cek apakah ada data user yang tersangkut di database karena fitur SOFT DELETE
        $userIn = $this->authModel->getUserByEmail($user_data["email"]);

        if(!empty($user_data) && $userIn != null && $userIn["is_deleted"] == 1) {
            return redirect()->to('login')->withInput()->with('error', "Akun Anda telah dihapus. Jika ini kesalahan, Anda dapat memulihkan akun dengan menghubungi kami <a href='/accountrecovery'><u><b>disini</b></u></a>");
        } else {
            // Validasi aturan data input user
            $this->validation->setRules([
                "username" => [
                    "rules" => "required|max_length[50]",
                    "errors" => [
                        "required" => "Username wajib diisi",
                        "max_length" => "Username tidak boleh lebih dari 50 karakter"
                    ]
                ],
                "email" => [
                    "rules" => "required|max_length[50]|is_unique[users.email]",
                    "errors" => [
                        "required" => "Email wajib diisi",
                        "is_unique" => "Email sudah terdaftar"
                    ]
                ],
                "no_tlp" => [
                    "rules" => "integer|is_unique[users.no_tlp]",
                    "errors" => [
                        "integer" => "No telepon tidak valid",
                        "is_unique" => "No telepon sudah digunakan"
                    ]
                ],
                "address" => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Alamat wajib diisi"
                    ]
                ],
                "password" => [
                    "rules" => "required|min_length[8]",
                    "errors" => [
                        "required" => "Password wajib diisi",
                        "min_length" => "Panjang minimal 8 karakter"
                    ]
                ],
                "confirm_password" => [
                    "rules" => "required|matches[password]",
                    "errors" => [
                        "required" => "Konfirmasi kata sandi dibutuhkan",
                        "matches" => "Kata sandi tidak sama"
                    ]
                ]
            ]);

            if(!$this->validation->withRequest($this->request)->run()) {
                // dd($this->validation->getErrors());
                return redirect()->to('register')->withInput()->with('validation', $this->validation->getErrors());
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
                "role" => 0,
                "is_deleted" => 0,
                "is_recovery" => 0
            ]);

            // Verifikasi email aktivasi akun untuk menghindari spam
            $this->email->setFrom("kukuh.wd123@gmail.com", "Makaroni Cuaks");
            $this->email->setTo($user_data["email"]);
            $this->email->setSubject("Verivikasi Email");
            $this->email->setMessage('Click this link to verify your email: <a href="' . base_url() . '/verify-email/' . $token . '">Verify Email</a>');

            if (!$this->email->send()) {
                return redirect()->to('registerfailed');
            }

            return redirect()->to('registersuccess'); // Redirect ke halaman sukses
        }
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

    public function checkLogin()
    {
        helper(['form', 'url']);

        // Tangkap data input user dari sisi front end
        $user_data = [
            "email" => $this->request->getPost('email'),
            "password" => $this->request->getPost('password')
        ];

        if($this->request->getMethod() == 'POST') {
            $data_rules = [
                "email" => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Email wajib diisi",
                    ]
                ],
                "password" => [
                    "rules" => "required|min_length[8]",
                    "errors" => [
                        "required" => "Password wajib diisi",
                        "min_length" => "Panjang minimal 8 karakter"
                    ]
                ],
            ];

            if(!$this->validate($data_rules)) {
                return redirect()->to('login')->withInput()->with('errors', $this->validator->getErrors());
            }

            $user = $this->authModel->getUserByEmail($user_data["email"]);

            if($user && password_verify($user_data["password"], $user["password"])) {
            // Cek apakah user yang ditemukan sudah aktivasi melalui email atau belum
                // Cek apakah data user ditemukan di database dan data cocok
                if($user["is_deleted"] == 0) {
                    if($user["status"] == 1) {
                        session()->set("user", [
                            "id" => $user["id"],
                            "username" => $user["username"],
                            "email" => $user["email"],
                            "address" => $user["address"],
                            "no_tlp" => $user["no_tlp"],
                            "img_profile" => $user["img_profile"],
                            "role" => $user["role"]
                        ]);

                        if($user["role"] == 0) {
                            // 0 == user biasa
                            return redirect()->to("");
                        } else {
                            // 1 == admin
                            return redirect()->to("admin/home");
                        }
                    } else {
                        return redirect()->to('login')->withInput()->with('error', "Akun anda belum aktif, Silahkan cek email untuk aktivasi");
                    }
                } else {
                    return redirect()->to('login')->withInput()->with('error', "Akun Anda telah dihapus. Jika ini kesalahan, Anda dapat memulihkan akun dengan menghubungi kami <a href='/accountrecovery'><u><b>disini</b></u></a>");
                }
            } else {
                return redirect()->to('login')->withInput()->with('error', "Email atau password anda salah");   
            }
        }

        return redirect()->to("login");
    }

    public function recovery()
    {
        // Tangkap input data dari front end
        $user_data = [
            "email" => $this->request->getPost("email"),
            "reason" => $this->request->getPost("reason")
        ];

        // Validasi input dari front end
        if($this->request->getMethod() == 'POST') {
            $data_rules = [
                "email" => [
                    "rules" => "required",
                    "errors" => [
                        "required" => "Email wajib diisi",
                    ]
                ]
            ];

            // Arahkan ke halaman pemulihan jika validasi gagal
            if(!$this->validate($data_rules)) {
                return redirect()->to('accountrecovery')->withInput()->with('validation', $this->validation->getErrors());
            } else {
                // Mendapatkan user id dari users untuk kebutuhan recovery
                $userToRecovery = $this->authModel->getUserByEmail($user_data["email"]);

                if($userToRecovery["is_deleted"] == 1) {
                    // Update is_recovery
                    $this->authModel->updateRecovery($userToRecovery["id"]);
                    // Jika akun sedang dalam proses recovery maka cukup update notif ke admin
                    if($userToRecovery["is_recovery"] == 0) { 
                        $this->recoveryModel->save([
                            "user_id" => $userToRecovery["id"],
                            "reason" => $user_data["reason"] == "" ? "Tidak diketahui" : $user_data["reason"],
                            "status" => "pending",
                            "updated_at" => date('Y-m-d H:i:s')
                        ]);

                        // Request pemulihan akun berhasil, Arahkan ke login
                        return redirect()->to('login')->withInput()->with('success', "Permintaan pemulihan terkirim, cek email secara berkala untuk reset kembali kata sandi");
                    } else {
                        // Jika status akun sedang di recovery maka cukup updated tanggal permintaan recovery-nya saya
                        $this->recoveryModel->updateRecoveryRequest($userToRecovery["id"]);
                        // Update request pemulihan akun berhasil, Arahkan ke login
                        return redirect()->to('login')->withInput()->with('success', "Permintaan pemulihan terkirim, cek email secara berkala untuk reset kembali kata sandi");
                    }
                } else {
                    // Request pemulihan akun gagal karena akun yang dimaksud masih aktif dan tidak bermasalah
                    return redirect()->to('login')->withInput()->with('error', "Akun aktif, pemulihan gagal");
                }
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to("login");
    }
}