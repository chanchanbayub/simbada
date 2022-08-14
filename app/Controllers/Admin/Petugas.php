<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\JabatanModel;
use App\Models\Admin\PetugasModel;
use App\Models\Admin\TandaTanganPetugasModel;
use App\Models\Admin\UkpdModel;
use App\Models\Admin\UnitPenindakModel;

class Petugas extends BaseController
{
    protected $ukpdModel;
    protected $validation;
    protected $unitPenindakModel;
    protected $petugasModel;
    protected $jabatanModel;
    protected $tandaTanganPetugasModel;

    public function __construct()
    {
        $this->ukpdModel = new UkpdModel();
        $this->unitPenindakModel = new UnitPenindakModel();
        $this->validation = \Config\Services::validation();
        $this->petugasModel = new PetugasModel();
        $this->jabatanModel = new JabatanModel();
        $this->tandaTanganPetugasModel = new TandaTanganPetugasModel();
    }


    public function index()
    {
        $data = [
            'title' => 'SIMDALOPS | Petugas',
            'ukpd' => $this->ukpdModel->findAll(),
            'unit_penindak' => $this->unitPenindakModel->findAll(),
            'petugas' => $this->petugasModel->getPetugas(session('ukpd_id')),
            'jabatan' => $this->jabatanModel->findAll()
        ];

        return view('admin/petugas', $data);
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
                'unit_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Unit Tidak Boleh Kosong !'
                    ]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Tidak Boleh Kosong !'
                    ]
                ],
                'nip_npjlp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIP atau NPJLP Tidak Boleh Kosong !'
                    ]
                ],
                'jabatan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jabatan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'unit_id' => $this->validation->getError('unit_id'),
                        'nama' => $this->validation->getError('nama'),
                        'nip_npjlp' => $this->validation->getError('nip_npjlp'),
                        'jabatan_id' => $this->validation->getError('jabatan_id'),
                    ]
                ];
            } else {

                $ukpd_id = $this->request->getPost('ukpd_id');
                $unit_id = $this->request->getPost('unit_id');
                $nama = $this->request->getPost('nama');
                $nip_npjlp = $this->request->getPost('nip_npjlp');
                $jabatan_id = $this->request->getPost('jabatan_id');


                $this->petugasModel->save([
                    'ukpd_id' => $ukpd_id,
                    'unit_id' => $unit_id,
                    'nama' => $nama,
                    'nip_npjlp' => $nip_npjlp,
                    'jabatan_id' => $jabatan_id,
                ]);

                $alert = [
                    'success' => 'Petugas Berhasil di Simpan !'
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
                'petugas' => $this->petugasModel->where(["id" => $id])->first(),
                'unit_penindak' => $this->unitPenindakModel->findAll(),
                'ukpd' => $this->ukpdModel->findAll(),
                'jabatan' => $this->jabatanModel->findAll()
            ];


            return json_encode($data);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $tandaTanganPetugas = $this->tandaTanganPetugasModel->where(["petugas_id" => $id])->first();
            if ($tandaTanganPetugas != null) {
                $pathFile = $tandaTanganPetugas["tanda_tangan_petugas"];
                if (file_exists($pathFile)) {
                    unlink($pathFile);
                }
            }

            $this->petugasModel->delete($id);

            $alert = [
                'success' => 'Petugas Berhasil Berhasil di Hapus !'
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
                'unit_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Unit Tidak Boleh Kosong !'
                    ]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Tidak Boleh Kosong !'
                    ]
                ],
                'nip_npjlp' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIP atau NPJLP Tidak Boleh Kosong !'
                    ]
                ],
                'jabatan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jabatan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'unit_id' => $this->validation->getError('unit_id'),
                        'nama' => $this->validation->getError('nama'),
                        'nip_npjlp' => $this->validation->getError('nip_npjlp'),
                        'jabatan_id' => $this->validation->getError('jabatan_id'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $ukpd_id = $this->request->getPost('ukpd_id');
                $unit_id = $this->request->getPost('unit_id');
                $nama = $this->request->getPost('nama');
                $nip_npjlp = $this->request->getPost('nip_npjlp');
                $jabatan_id = $this->request->getPost('jabatan_id');

                $this->petugasModel->update($id, [
                    'id' => $id,
                    'ukpd_id' => $ukpd_id,
                    'unit_id' => $unit_id,
                    'nama' => $nama,
                    'nip_npjlp' => $nip_npjlp,
                    'jabatan_id' => $jabatan_id,
                ]);

                $alert = [
                    'success' => 'Petugas Berhasil di Update !'
                ];
            }

            return json_encode($alert);
        }
    }
}
