<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\NomorSPTModel;

class NomorSuratTugas extends BaseController
{
    protected $nomorSPTModel;
    protected $validation;

    public function __construct()
    {
        $this->nomorSPTModel = new NomorSPTModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMBADA LLAJ | Surat Tugas',
            'surat_tugas' => $this->nomorSPTModel->getNomorSurat()
        ];

        return view('admin/nomor_spt', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'nomor_surat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Surat Tidak Boleh Kosong !'
                    ]
                ],
                'tanggal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'nomor_surat' => $this->validation->getError('nomor_surat'),
                        'tanggal' => $this->validation->getError('tanggal'),
                    ]
                ];
            } else {

                $spt = $this->request->getPost('nomor_surat');
                $tanggal = $this->request->getPost('tanggal');

                $this->nomorSPTModel->save([
                    'nomor_surat' => $spt,
                    'tanggal' => $tanggal,
                ]);

                $alert = [
                    'success' => 'Nomor Surat Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $spt = $this->nomorSPTModel->where(["id" => $id])->first();

            return json_encode($spt);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $this->nomorSPTModel->delete($id);

            $alert = [
                'success' => 'Nomor Surat Tugas Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'nomor_surat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Surat Tidak Boleh Kosong !'
                    ]
                ],
                'tanggal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'nomor_surat' => $this->validation->getError('nomor_surat'),
                        'tanggal' => $this->validation->getError('tanggal'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $spt = $this->request->getPost('nomor_surat');
                $tanggal = $this->request->getPost('tanggal');

                $this->nomorSPTModel->update($id, [
                    'id' => $id,
                    'nomor_surat' => $spt,
                    'tanggal' => $tanggal,
                ]);

                $alert = [
                    'success' => 'Nomor Surat Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
