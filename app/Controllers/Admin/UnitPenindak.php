<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\UkpdModel;
use App\Models\Admin\UnitPenindakModel;

class UnitPenindak extends BaseController
{
    protected $ukpdModel;
    protected $unitPenindakModel;
    protected $validation;

    public function __construct()
    {
        $this->ukpdModel = new UkpdModel();
        $this->validation = \Config\Services::validation();
        $this->unitPenindakModel = new UnitPenindakModel();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMDALOPS | Unit Penindak',
            'ukpd' => $this->ukpdModel->findAll(),
            'unit_penindak' => $this->unitPenindakModel->getUnit(),
        ];

        return view('admin/unit_penindak', $data);
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
                'unit_penindak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Unit / Regu Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'unit_penindak' => $this->validation->getError('unit_penindak'),

                    ]
                ];
            } else {

                $ukpd_id = $this->request->getPost('ukpd_id');
                $unit_penindak = $this->request->getPost('unit_penindak');


                $this->unitPenindakModel->save([
                    'ukpd_id' => $ukpd_id,
                    'unit_penindak' => $unit_penindak,
                ]);

                $alert = [
                    'success' => 'Unit Penindak Berhasil di Simpan !'
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
                'unit_penindak' => $this->unitPenindakModel->where(["id" => $id])->first(),
            ];

            return json_encode($data);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $this->unitPenindakModel->delete($id);

            $alert = [
                'success' => 'Unit / Regu Berhasil di Hapus !'
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
                'unit_penindak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Unit / Regu Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'unit_penindak' => $this->validation->getError('unit_penindak'),
                    ]
                ];
            } else {

                $id = $this->request->getVar('id');
                $ukpd_id = $this->request->getPost('ukpd_id');
                $unit_penindak = $this->request->getPost('unit_penindak');

                $this->unitPenindakModel->update($id, [
                    'id' => $id,
                    'ukpd_id' => $ukpd_id,
                    'unit_penindak' => $unit_penindak,
                ]);

                $alert = [
                    'success' => 'Unit Penindak Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
