<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\BapModel;
use App\Models\Admin\PPNSModel;
use App\Models\Admin\StatusBapModel;
use App\Models\Admin\UkpdModel;
use App\Models\Admin\UnitPenindakModel;

class Bap extends BaseController
{
    protected $bapModel;
    protected $validation;
    protected $ukpdModel;
    protected $unitPenindakModel;
    protected $ppnsModel;
    protected $statusBapModel;

    public function __construct()
    {
        $this->bapModel = new BapModel();
        $this->ukpdModel = new UkpdModel();
        $this->unitPenindakModel = new UnitPenindakModel();
        $this->statusBapModel = new StatusBapModel();
        $this->ppnsModel = new PPNSModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $bap = $this->bapModel->getNoBap(session('ukpd_id'));
        // dd($bap);

        $data = [
            'title' => 'SIMBADA LLAJ | Nomor Berita Acara Penderekan',
            'ukpd' => $this->ukpdModel->findAll(),
            'ppns' => $this->ppnsModel->findAll(),
            'unit_penindak' => $this->unitPenindakModel->findAll(),
            'status_bap' => $this->statusBapModel->findAll(),
            'bap' => $bap
        ];

        return view('admin/bap', $data);
    }

    public function getUnit()
    {
        if ($this->request->isAJAX()) {

            $ukpd_id = $this->request->getVar('ukpd_id');

            $data = [
                'unit_penindak' => $this->unitPenindakModel->where(["ukpd_id" => $ukpd_id])->findAll(),
                'ppns' => $this->ppnsModel->where(["ukpd_id" => $ukpd_id])->findAll()
            ];


            return json_encode($data);
        }
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
                'ppns_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'PPNS Tidak Boleh Kosong !'
                    ]
                ],
                'noBap_start' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Awal BAP Tidak Boleh Kosong !'
                    ]
                ],
                'noBap_end' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Akhir BAP Tidak Boleh Kosong !'
                    ]
                ],
                'unit_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Unit Tidak Boleh Kosong !'
                    ]
                ],
                'status_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'ppns_id' => $this->validation->getError('ppns_id'),
                        'noBap_start' => $this->validation->getError('noBap_start'),
                        'noBap_end' => $this->validation->getError('noBap_end'),
                        'unit_id' => $this->validation->getError('unit_id'),
                        'status_id' => $this->validation->getError('status_id'),
                    ]
                ];
            } else {

                $ukpd_id = $this->request->getPost('ukpd_id');
                $ppns_id = $this->request->getPost('ppns_id');
                $noBap_start = $this->request->getPost('noBap_start');
                $noBap_end = $this->request->getPost('noBap_end');
                $unit_id = $this->request->getPost('unit_id');
                $status_id = $this->request->getPost('status_id');

                for ($i = intval($noBap_start); $i <= intval($noBap_end); $i++) {
                    if (strlen($i) == 1) {
                        $noBap = '000000' . $i;
                    } else if (strlen($i) == 2) {
                        $noBap = '00000' . $i;
                    } else if (strlen($i) == 3) {
                        $noBap = '0000' . $i;
                    } else if (strlen($i) == 4) {
                        $noBap = '000' . $i;
                    } else if (strlen($i) == 5) {
                        $noBap = '00' . $i;
                    } else if (strlen($i) == 6) {
                        $noBap = '0' . $i;
                    } else if (strlen($i) == 7) {
                        $noBap = $i;
                    }


                    $this->bapModel->save([
                        'ukpd_id' => $ukpd_id,
                        'noBap' => $noBap,
                        'ppns_id' => $ppns_id,
                        'unit_id' => $unit_id,
                        'status_id' => $status_id,
                    ]);
                }
                $alert = [
                    'success' => 'Nomor BAP Berhasil di Simpan !'
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
                'bap' => $this->bapModel->where(["id" => $id])->first(),
                'ukpd' => $this->ukpdModel->findAll(),
                'unit_penindak' => $this->unitPenindakModel->findAll(),
                'ppns' => $this->ppnsModel->findAll(),
                'status_bap' => $this->statusBapModel->findAll(),
            ];

            return json_encode($data);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $this->bapModel->delete($id);

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
                'ukpd_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'UKPD Tidak Boleh Kosong !'
                    ]
                ],
                'ppns_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'PPNS Tidak Boleh Kosong !'
                    ]
                ],
                'noBap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor BAP Tidak Boleh Kosong !'
                    ]
                ],
                'unit_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Unit Tidak Boleh Kosong !'
                    ]
                ],
                'status_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Status Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'ppns_id' => $this->validation->getError('ppns_id'),
                        'noBap' => $this->validation->getError('noBap'),
                        'unit_id' => $this->validation->getError('unit_id'),
                        'status_id' => $this->validation->getError('status_id'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $ukpd_id = $this->request->getPost('ukpd_id');
                $ppns_id = $this->request->getPost('ppns_id');
                $noBap = $this->request->getPost('noBap');
                $unit_id = $this->request->getPost('unit_id');
                $status_id = $this->request->getPost('status_id');



                $this->bapModel->update($id, [
                    'id' => $id,
                    'ukpd_id' => $ukpd_id,
                    'ppns_id' => $ppns_id,
                    'noBap' => $noBap,
                    'unit_id' => $unit_id,
                    'status_id' => $status_id,
                ]);

                $alert = [
                    'success' => 'Nomor BAP Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
