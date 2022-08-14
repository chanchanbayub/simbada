<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\RoleManagementModel;
use App\Models\Admin\UkpdModel;
use App\Models\Admin\UserManagementModel;

class UserManagement extends BaseController
{
    protected $ukpdModel;
    protected $roleManagementModel;
    protected $userManagementModel;
    protected $validation;

    public function __construct()
    {
        $this->ukpdModel = new UkpdModel();
        $this->validation = \Config\Services::validation();
        $this->roleManagementModel = new RoleManagementModel();
        $this->userManagementModel = new UserManagementModel();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMDALOPS | Unit Penindak',
            'ukpd' => $this->ukpdModel->findAll(),
            'role_management' => $this->roleManagementModel->findAll(),
            'user_management' => $this->userManagementModel->getUserManagement()
        ];

        return view('admin/user_management', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'ukpd_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'UKPD Tidak Boleh Kosong !'
                    ]
                ],
                'role_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role Management Tidak Boleh Kosong !'
                    ]
                ],
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
                'status' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'role_id' => $this->validation->getError('role_id'),
                        'username' => $this->validation->getError('username'),
                        'password' => $this->validation->getError('password'),
                        'status' => $this->validation->getError('status'),
                    ]
                ];
            } else {

                $ukpd_id = $this->request->getPost('ukpd_id');
                $role_id = $this->request->getPost('role_id');
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                $status = $this->request->getPost('status');


                $this->userManagementModel->save([
                    'ukpd_id' => $ukpd_id,
                    'role_id' => $role_id,
                    'username' => $username,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'status' => $status,
                ]);

                $alert = [
                    'success' => 'User Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $data = [
                'ukpd' => $this->ukpdModel->findAll(),
                'role_management' => $this->roleManagementModel->findAll(),
                'user_management' => $this->userManagementModel->getUserWithID($id),
            ];

            return json_encode($data);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $this->userManagementModel->delete($id);

            $alert = [
                'success' => 'User Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'ukpd_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'UKPD Tidak Boleh Kosong !'
                    ]
                ],
                'role_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role Management Tidak Boleh Kosong !'
                    ]
                ],
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username Tidak Boleh Kosong !'
                    ]
                ],

                'status' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'role_id' => $this->validation->getError('role_id'),
                        'username' => $this->validation->getError('username'),
                        'status' => $this->validation->getError('status'),
                    ]
                ];
            } else {
                $id = $this->request->getPost('id');
                $ukpd_id = $this->request->getPost('ukpd_id');
                $role_id = $this->request->getPost('role_id');
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                $status = $this->request->getPost('status');


                $this->userManagementModel->update($id, [
                    'id' => $id,
                    'ukpd_id' => $ukpd_id,
                    'role_id' => $role_id,
                    'username' => $username,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'status' => $status,
                ]);

                $alert = [
                    'success' => 'User Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
