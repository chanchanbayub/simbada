<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\JenisPenindakanModel;

class JenisPenindakan extends BaseController
{

    protected $jenisPenindakanModel;
    protected $validation;

    public function __construct()
    {
        $this->jenisPenindakanModel = new JenisPenindakanModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMDALOPS | Jenis Penindakan',
            'jenis_penindakan' => $this->jenisPenindakanModel->findAll()
        ];

        return view('admin/jenis_penindakan', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'nama_penindakan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Penindakan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'nama_penindakan' => $this->validation->getError('nama_penindakan'),
                    ]
                ];
            } else {

                $nama_penindakan = $this->request->getPost('nama_penindakan');

                $this->jenisPenindakanModel->save([
                    'nama_penindakan' => $nama_penindakan,
                ]);

                $alert = [
                    'success' => 'Jenis Penindakan Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $jenis_penindakan = $this->jenisPenindakanModel->where(["id" => $id])->first();

            return json_encode($jenis_penindakan);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $this->jenisPenindakanModel->delete($id);

            $alert = [
                'success' => 'Jenis Penindakan Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'nama_penindakan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Penindakan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'nama_penindakan' => $this->validation->getError('nama_penindakan'),
                    ]
                ];
            } else {
                $id = $this->request->getPost('id');
                $nama_penindakan = $this->request->getPost('nama_penindakan');

                $this->jenisPenindakanModel->update($id, [
                    'id' => $id,
                    'nama_penindakan' => $nama_penindakan,
                ]);

                $alert = [
                    'success' => 'Jenis Penindakan Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }
}
