<?php

namespace App\Controllers;

use App\Models\Admin\KendaraanModel;

class Home extends BaseController
{

    protected $kendaraanModel;

    public function __construct()
    {
        $this->kendaraanModel = new KendaraanModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMDALOPS '
        ];
        return view('pages', $data);
    }

    public function search()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'search' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Kendaraan Tidak Boleh Kosong !'
                    ],
                ],
            ])) {
                $alert = [
                    'error' => [
                        'search' => $this->validation->getError('search'),
                    ],
                ];
            } else {

                $search = $this->request->getPost('search');

                $dataKendaraan = $this->kendaraanModel->getDataKendaraandiDerek($search);

                $alert = [
                    'success' => 'Silahkan Tunggu',
                    'dataKendaraan' => $dataKendaraan
                ];
            }
        }
        return json_encode($alert);
    }
}
