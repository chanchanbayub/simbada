<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\JenisKendaraanModel;

class JenisKendaraan extends BaseController
{
    protected $jenisKendaraanModel;
    protected $validation;

    public function __construct()
    {
        $this->jenisKendaraanModel = new JenisKendaraanModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMBADA LLAJ  | Jenis Kendaraan',
            'jenis_kendaraan' => $this->jenisKendaraanModel->findAll()
        ];

        return view('admin/jenis_kendaraan', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'jenis_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Kendaraan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'jenis_kendaraan' => $this->validation->getError('jenis_kendaraan'),
                    ]
                ];
            } else {

                $jenis_kendaraan = $this->request->getPost('jenis_kendaraan');

                $this->jenisKendaraanModel->save([
                    'jenis_kendaraan' => $jenis_kendaraan,
                ]);

                $alert = [
                    'success' => 'Jenis Kendaraan Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $jenis_kendaraan = $this->jenisKendaraanModel->where(["id" => $id])->first();

            return json_encode($jenis_kendaraan);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $this->jenisKendaraanModel->delete($id);

            $alert = [
                'success' => 'Jenis Kendaraan Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'jenis_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Kendaraan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'jenis_kendaraan' => $this->validation->getError('jenis_kendaraan'),
                    ]
                ];
            } else {
                $id = $this->request->getPost('id');
                $jenis_kendaraan = $this->request->getPost('jenis_kendaraan');

                $this->jenisKendaraanModel->update($id, [
                    'id' => $id,
                    'jenis_kendaraan' => $jenis_kendaraan,
                ]);

                $alert = [
                    'success' => 'Jenis Kendaraan Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
