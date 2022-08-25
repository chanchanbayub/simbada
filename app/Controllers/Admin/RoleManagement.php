<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\RoleManagementModel;

class RoleManagement extends BaseController
{
    protected $roleManagementModel;
    protected $validation;


    public function __construct()
    {
        $this->roleManagementModel = new RoleManagementModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMBADA LLAJ  | Role Management',
            'role_management' => $this->roleManagementModel->orderBy('id desc')->findAll(),
        ];

        return view('admin/role_management', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'role_management' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role Management Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'role_management' => $this->validation->getError('role_management'),
                    ]
                ];
            } else {

                $role_management = $this->request->getPost('role_management');

                $this->roleManagementModel->save([
                    'role_management' => $role_management,
                ]);

                $alert = [
                    'success' => 'Role Management Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');


            $role_management = $this->roleManagementModel->where(["id" => $id])->first();


            return json_encode($role_management);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $this->roleManagementModel->delete($id);

            $alert = [
                'success' => 'Role Management Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {

            if (!$this->validate([
                'role_management' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Role Management Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'role_management' => $this->validation->getError('role_management'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $role_management = $this->request->getPost('role_management');


                $this->roleManagementModel->update($id, [
                    'id' => $id,
                    'role_management' => $role_management,
                ]);

                $alert = [
                    'success' => 'Role Management Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
