<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\JenisKendaraanModel;
use App\Models\Admin\KlasifikasiKendaraanModel;

class KlasifikasiKendaraan extends BaseController
{
    protected $klasifikasiKendaraanModel;
    protected $validation;
    protected $jenisKendaraanModel;

    public function __construct()
    {
        $this->klasifikasiKendaraanModel = new KlasifikasiKendaraanModel();
        $this->jenisKendaraanModel = new JenisKendaraanModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMBADA LLAJ  | Klasifikasi Kendaraan',
            'jenis_kendaraan' => $this->jenisKendaraanModel->findAll(),
            'klasifikasi_kendaraan' => $this->klasifikasiKendaraanModel->getKlasifikasi()
        ];

        return view('admin/klasifikasi_kendaraan', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'jenis_kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Kendaraan Tidak Boleh Kosong !'
                    ]
                ],
                'klasifikasi_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Klasifikasi Kendaraan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'jenis_kendaraan_id' => $this->validation->getError('jenis_kendaraan_id'),
                        'klasifikasi_kendaraan' => $this->validation->getError('klasifikasi_kendaraan'),
                    ]
                ];
            } else {

                $jenis_kendaraan_id = $this->request->getPost('jenis_kendaraan_id');
                $klasifikasi_kendaraan = $this->request->getPost('klasifikasi_kendaraan');

                $this->klasifikasiKendaraanModel->save([
                    'jenis_kendaraan_id' => $jenis_kendaraan_id,
                    'klasifikasi_kendaraan' => $klasifikasi_kendaraan,
                ]);

                $alert = [
                    'success' => 'Klasifikasi Kendaraan Berhasil di Simpan !'
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
                'klasifikasi' => $this->klasifikasiKendaraanModel->where(["id" => $id])->first(),
                'jenis_kendaraan' => $this->jenisKendaraanModel->findAll()
            ];


            return json_encode($data);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $this->klasifikasiKendaraanModel->delete($id);

            $alert = [
                'success' => 'Klasifikasi Kendaraan Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'jenis_kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Kendaraan Tidak Boleh Kosong !'
                    ]
                ],
                'klasifikasi_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Klasifikasi Kendaraan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'jenis_kendaraan_id' => $this->validation->getError('jenis_kendaraan_id'),
                        'klasifikasi_kendaraan' => $this->validation->getError('klasifikasi_kendaraan'),
                    ]
                ];
            } else {
                $id = $this->request->getPost('id');
                $jenis_kendaraan_id = $this->request->getPost('jenis_kendaraan_id');
                $klasifikasi_kendaraan = $this->request->getPost('klasifikasi_kendaraan');

                $this->klasifikasiKendaraanModel->update($id, [
                    'id' => $id,
                    'jenis_kendaraan_id' => $jenis_kendaraan_id,
                    'klasifikasi_kendaraan' => $klasifikasi_kendaraan,
                ]);

                $alert = [
                    'success' => 'Klasifikasi Kendaraan Kendaraan Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
