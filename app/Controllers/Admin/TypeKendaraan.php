<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\KlasifikasiKendaraanModel;
use App\Models\Admin\TypeKendaraanModel;

class TypeKendaraan extends BaseController
{
    protected $klasifikasiKendaraanModel;
    protected $validation;
    protected $typeKendaraanModel;

    public function __construct()
    {
        $this->klasifikasiKendaraanModel = new KlasifikasiKendaraanModel();
        $this->typeKendaraanModel = new TypeKendaraanModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMBADA LLAJ | Type Kendaraan',
            'klasifikasi' => $this->klasifikasiKendaraanModel->findAll(),
            'type_kendaraan' => $this->typeKendaraanModel->getTypeKendaraan()
        ];

        return view('admin/type_kendaraan', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'klasifikasi_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Klasifikasi Kendaraan Tidak Boleh Kosong !'
                    ]
                ],
                'type_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Type Kendaraan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'klasifikasi_id' => $this->validation->getError('klasifikasi_id'),
                        'type_kendaraan' => $this->validation->getError('type_kendaraan'),
                    ]
                ];
            } else {

                $klasifikasi_id = $this->request->getPost('klasifikasi_id');
                $type_kendaraan = $this->request->getPost('type_kendaraan');

                $this->typeKendaraanModel->save([
                    'klasifikasi_id' => $klasifikasi_id,
                    'type_kendaraan' => $type_kendaraan,
                ]);

                $alert = [
                    'success' => 'Type Kendaraan Berhasil di Simpan !'
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
                'type_kendaraan' => $this->typeKendaraanModel->where(["id" => $id])->first(),
                'klasifikasi' => $this->klasifikasiKendaraanModel->findAll()
            ];


            return json_encode($data);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $this->typeKendaraanModel->delete($id);

            $alert = [
                'success' => 'Type Kendaraan Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'klasifikasi_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Klasifikasi Kendaraan Tidak Boleh Kosong !'
                    ]
                ],
                'type_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Type Kendaraan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'klasifikasi_id' => $this->validation->getError('klasifikasi_id'),
                        'type_kendaraan' => $this->validation->getError('type_kendaraan'),
                    ]
                ];
            } else {
                $id = $this->request->getPost('id');
                $klasifikasi_id = $this->request->getPost('klasifikasi_id');
                $type_kendaraan = $this->request->getPost('type_kendaraan');

                $this->typeKendaraanModel->update($id, [
                    'id' => $id,
                    'klasifikasi_id' => $klasifikasi_id,
                    'type_kendaraan' => $type_kendaraan,
                ]);

                $alert = [
                    'success' => 'Type Kendaraan Kendaraan Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
