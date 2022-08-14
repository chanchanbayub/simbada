<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\JenisPelanggaranModel;

class JenisPelanggaran extends BaseController
{
    protected $jenisPelanggaranModel;
    protected $validation;

    public function __construct()
    {
        $this->jenisPelanggaranModel = new JenisPelanggaranModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMDALOPS | Jenis Pelanggaran',
            'jenis_pelanggaran' => $this->jenisPelanggaranModel->findAll()
        ];

        return view('admin/jenis_pelanggaran', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'pasal_pelanggaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pasal Pelanggaran Tidak Boleh Kosong !'
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Keterangan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'pasal_pelanggaran' => $this->validation->getError('pasal_pelanggaran'),
                        'keterangan' => $this->validation->getError('keterangan'),
                    ]
                ];
            } else {

                $pasal_pelanggaran = $this->request->getPost('pasal_pelanggaran');
                $keterangan = $this->request->getPost('keterangan');

                $this->jenisPelanggaranModel->save([
                    'pasal_pelanggaran' => $pasal_pelanggaran,
                    'keterangan' => $keterangan,
                ]);

                $alert = [
                    'success' => 'Jenis Pelanggaran Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $jenis_pelanggaran = $this->jenisPelanggaranModel->where(["id" => $id])->first();

            return json_encode($jenis_pelanggaran);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $this->jenisPelanggaranModel->delete($id);

            $alert = [
                'success' => 'Jenis Pelanggaran Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'pasal_pelanggaran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pasal Pelanggaran Tidak Boleh Kosong !'
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Keterangan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'pasal_pelanggaran' => $this->validation->getError('pasal_pelanggaran'),
                        'keterangan' => $this->validation->getError('keterangan'),
                    ]
                ];
            } else {
                $id = $this->request->getPost('id');
                $pasal_pelanggaran = $this->request->getPost('pasal_pelanggaran');
                $keterangan = $this->request->getPost('keterangan');

                $this->jenisPelanggaranModel->update($id, [
                    'id' => $id,
                    'pasal_pelanggaran' => $pasal_pelanggaran,
                    'keterangan' => $keterangan,
                ]);

                $alert = [
                    'success' => 'Jenis Pelanggaran Ubah di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }
}
