<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\TempatPenyimpananModel;
use App\Models\Admin\UkpdModel;

class TempatPenyimpanan extends BaseController
{
    protected $tempatPenyimpananModel;
    protected $validation;
    protected $ukpdModel;

    public function __construct()
    {
        $this->tempatPenyimpananModel = new TempatPenyimpananModel();
        $this->ukpdModel = new UkpdModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMDALOPS | Tempat Penyimpanan Kendaraan',
            'ukpd' => $this->ukpdModel->findAll(),
            'tempat_penyimpanan' => $this->tempatPenyimpananModel->getPenyimpanan()
        ];

        return view('admin/terminal_penyimpanan', $data);
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
                'tempat_penyimpanan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tempat Penyimpanan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'tempat_penyimpanan' => $this->validation->getError('tempat_penyimpanan'),
                    ]
                ];
            } else {

                $ukpd_id = $this->request->getPost('ukpd_id');
                $tempat_penyimpanan = $this->request->getPost('tempat_penyimpanan');

                $this->tempatPenyimpananModel->save([
                    'ukpd_id' => $ukpd_id,
                    'tempat_penyimpanan' => $tempat_penyimpanan,
                ]);

                $alert = [
                    'success' => 'Tempat Penyimpanan Berhasil di Simpan !'
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
                'tempat_penyimpanan' => $this->tempatPenyimpananModel->where(["id" => $id])->first(),
                'ukpd' => $this->ukpdModel->findAll()
            ];


            return json_encode($data);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $this->tempatPenyimpananModel->delete($id);

            $alert = [
                'success' => 'Tempat Penyimpanan Berhasil di Hapus !'
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
                'tempat_penyimpanan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tempat Penyimpanan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'tempat_penyimpanan' => $this->validation->getError('tempat_penyimpanan'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $ukpd_id = $this->request->getPost('ukpd_id');
                $tempat_penyimpanan = $this->request->getPost('tempat_penyimpanan');

                $this->tempatPenyimpananModel->update($id, [
                    'id' => $id,
                    'ukpd_id' => $ukpd_id,
                    'tempat_penyimpanan' => $tempat_penyimpanan,
                ]);

                $alert = [
                    'success' => 'Tempat Penyimpanan Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
