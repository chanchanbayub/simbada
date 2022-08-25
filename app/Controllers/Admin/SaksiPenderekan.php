<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\JabatanModel;
use App\Models\Admin\SaksiPenderekanModel;
use App\Models\Admin\TandaTanganSaksiModel;
use App\Models\Admin\UkpdModel;

class SaksiPenderekan extends BaseController
{
    protected $saksiPenderekanModel;
    protected $ukpdModel;
    protected $validation;
    protected $jabatanModel;
    protected $tandaTanganSaksiModel;


    public function __construct()
    {
        $this->saksiPenderekanModel = new SaksiPenderekanModel();
        $this->ukpdModel = new UkpdModel();
        $this->validation = \Config\Services::validation();
        $this->jabatanModel = new JabatanModel();
        $this->tandaTanganSaksiModel = new TandaTanganSaksiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMBADA LLAJ | Saksi Penderekan',
            'ukpd' => $this->ukpdModel->orderBy('id desc')->findAll(),
            'jabatan' => $this->jabatanModel->where(["id" => 2])->findAll(),
            'saksi_penderekan' => $this->saksiPenderekanModel->getSaksi()
        ];

        return view('admin/saksi_penderekan', $data);
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
                'nama_saksi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Saksi Tidak Boleh Kosong !'
                    ]
                ],
                'nip_saksi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIP / NPJLP Saksi Tidak Boleh Kosong !'
                    ]
                ],
                'jabatan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jabatan Saksi Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'nama_saksi' => $this->validation->getError('nama_saksi'),
                        'nip_saksi' => $this->validation->getError('nip_saksi'),
                        'jabatan_id' => $this->validation->getError('jabatan_id'),
                    ]
                ];
            } else {

                $ukpd_id = $this->request->getPost('ukpd_id');
                $nama_saksi = $this->request->getPost('nama_saksi');
                $nip_saksi = $this->request->getPost('nip_saksi');
                $jabatan_id = $this->request->getPost('jabatan_id');

                $this->saksiPenderekanModel->save([
                    'ukpd_id' => $ukpd_id,
                    'nama_saksi' => $nama_saksi,
                    'nip_saksi' => $nip_saksi,
                    'jabatan_id' => $jabatan_id,
                ]);

                $alert = [
                    'success' => 'Saksi Penderekan Berhasil di Simpan !'
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
                'jabatan' => $this->jabatanModel->where(["id" => 2])->findAll(),
                'saksi_penderekan' => $this->saksiPenderekanModel->where(["id" => $id])->first()
            ];

            return json_encode($data);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $tandaTanganSaksi = $this->tandaTanganSaksiModel->where(["saksi_id" => $id])->first();

            if ($tandaTanganSaksi != null) {
                $pathFile = $tandaTanganSaksi["tanda_tangan_saksi"];
                if (file_exists($pathFile)) {
                    unlink($pathFile);
                }
            }

            $this->saksiPenderekanModel->delete($id);

            $alert = [
                'success' => 'Saksi Penderekan Berhasil di Hapus !'
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
                'nama_saksi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Saksi Tidak Boleh Kosong !'
                    ]
                ],
                'nip_saksi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIP / NPJLP Saksi Tidak Boleh Kosong !'
                    ]
                ],
                'jabatan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jabatan Saksi Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'nama_saksi' => $this->validation->getError('nama_saksi'),
                        'nip_saksi' => $this->validation->getError('nip_saksi'),
                        'jabatan_id' => $this->validation->getError('jabatan_id'),
                    ]
                ];
            } else {
                $id = $this->request->getPost('id');
                $ukpd_id = $this->request->getPost('ukpd_id');
                $nama_saksi = $this->request->getPost('nama_saksi');
                $nip_saksi = $this->request->getPost('nip_saksi');
                $jabatan_id = $this->request->getPost('jabatan_id');

                $this->saksiPenderekanModel->update($id, [
                    'id' => $id,
                    'ukpd_id' => $ukpd_id,
                    'nama_saksi' => $nama_saksi,
                    'nip_saksi' => $nip_saksi,
                    'jabatan_id' => $jabatan_id,
                ]);

                $alert = [
                    'success' => 'Saksi Penderekan Berhasil di Update!'
                ];
            }

            return json_encode($alert);
        }
    }
}
