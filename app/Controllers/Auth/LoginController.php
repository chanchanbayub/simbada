<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Auth\LoginModel;

class LoginController extends BaseController
{

    protected $loginModel;
    protected $validation;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMBADA LLAJ | Login'
        ];

        return view('auth/login', $data);
    }

    public function getLogin()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username Tidak Boleh Kosong !'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'username' => $this->validation->getError('username'),
                        'password' => $this->validation->getError('password'),
                    ]
                ];
            } else {

                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');

                $user_data = $this->loginModel->getUsersLogedIn($username);
                if ($user_data > 0) {
                    if (password_verify($password, $user_data["password"])) {
                        if ($user_data['status'] == 0) {
                            $session_data = [
                                'username' => $user_data["username"],
                                'ukpd_id' => $user_data["ukpd_id"],
                                'ukpd' => $user_data["ukpd"],
                                'nama_ukpd' => $user_data["nama_ukpd"],
                                'role_id' => $user_data["role_id"],
                                'role_management' => $user_data['role_management'],
                                'isLogedIn' => true
                            ];
                            session()->set($session_data);
                            if ($user_data["role_id"] == 2) {
                                $alert = [
                                    'success' => 'Berhasil Login !',
                                    'url' => 'admin/dashboard'
                                ];
                            } elseif ($user_data["role_id"] == 1) {
                                $alert = [
                                    'success' => 'Berhasil Login !',
                                    'url' => 'petugas/dashboard'
                                ];
                            }
                        } else if ($user_data["status"] == 1) {
                            $alert = [
                                'errors' => 'Silahkan Hubungi Admin'
                            ];
                        }
                    } else {
                        $alert = [
                            'errors' => 'Username / Password Tidak Salah!'
                        ];
                    }
                } else if ($user_data < 1) {
                    $alert = [
                        'errors' => 'Username Tidak Ditemukan'
                    ];
                }
            }
        }
        return json_encode($alert);
    }


    public function logout()
    {
        session_destroy();
        session_unset();

        return redirect()->to(base_url('auth/login'));
    }
}
