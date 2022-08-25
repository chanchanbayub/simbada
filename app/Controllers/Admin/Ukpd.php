<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\UkpdModel;

class Ukpd extends BaseController
{
    protected $ukpdModel;
    protected $validation;

    public function __construct()
    {
        $this->ukpdModel = new UkpdModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'title' => 'SIMBADA LLAJ | UKPD',
            'ukpd' => $this->ukpdModel->findAll()
        ];

        return view('admin/ukpd', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'ukpd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'UKPD Tidak Boleh Kosong !'
                    ]
                ],
                'nama_ukpd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama UKPD Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'ukpd' => $this->validation->getError('ukpd'),
                        'nama_ukpd' => $this->validation->getError('nama_ukpd')
                    ]
                ];
            } else {

                $ukpd = $this->request->getPost('ukpd');
                $nama_ukpd = $this->request->getPost('nama_ukpd');

                $this->ukpdModel->save([
                    'ukpd' => $ukpd,
                    'nama_ukpd' => $nama_ukpd
                ]);

                $alert = [
                    'success' => 'UKPD Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $ukpd = $this->ukpdModel->where(["id" => $id])->first();

            return json_encode($ukpd);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $this->ukpdModel->delete($id);

            $alert = [
                'success' => 'UKPD Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'ukpd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'UKPD Tidak Boleh Kosong !'
                    ]
                ],
                'nama_ukpd' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama UKPD Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'ukpd' => $this->validation->getError('ukpd'),
                        'nama_ukpd' => $this->validation->getError('nama_ukpd')
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $ukpd = $this->request->getPost('ukpd');
                $nama_ukpd = $this->request->getPost('nama_ukpd');

                $this->ukpdModel->update($id, [
                    'id' => $id,
                    'ukpd' => $ukpd,
                    'nama_ukpd' => $nama_ukpd
                ]);

                $alert = [
                    'success' => 'UKPD Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
