<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\StatusBapModel;

class StatusBap extends BaseController
{
    protected $statusBapModel;
    protected $validation;


    public function __construct()
    {
        $this->statusBapModel = new StatusBapModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMDALOPS | Status Berita Acara Penderekan',
            'status_bap' => $this->statusBapModel->orderBy('id desc')->findAll(),
        ];

        return view('admin/status_bap', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'status_bap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status BAP Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'status_bap' => $this->validation->getError('status_bap'),
                    ]
                ];
            } else {

                $status_bap = $this->request->getPost('status_bap');

                $this->statusBapModel->save([
                    'status_bap' => $status_bap,
                ]);

                $alert = [
                    'success' => 'Status BAP Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');


            $status_bap = $this->statusBapModel->where(["id" => $id])->first();


            return json_encode($status_bap);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $this->statusBapModel->delete($id);

            $alert = [
                'success' => 'Status BAP Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'status_bap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status BAP Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'status_bap' => $this->validation->getError('status_bap'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $status_bap = $this->request->getPost('status_bap');


                $this->statusBapModel->update($id, [
                    'id' => $id,
                    'status_bap' => $status_bap,
                ]);

                $alert = [
                    'success' => 'Status BAP Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
