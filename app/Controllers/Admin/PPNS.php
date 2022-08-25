<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\PPNSModel;
use App\Models\Admin\TandaTanganPPNSModel;
use App\Models\Admin\UkpdModel;

class PPNS extends BaseController
{
    protected $ukpdModel;
    protected $validation;
    protected $ppnsModel;
    protected $tandaTanganPPNSModel;


    public function __construct()
    {
        $this->ukpdModel = new UkpdModel();
        $this->validation = \Config\Services::validation();
        $this->ppnsModel = new PPNSModel();
        $this->tandaTanganPPNSModel = new TandaTanganPPNSModel();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMBADA LLAJ | Penyidik Pegawai Negeri Sipil',
            'ukpd' => $this->ukpdModel->findAll(),
            'ppns' => $this->ppnsModel->getPPNS()
        ];

        return view('admin/ppns', $data);
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
                'nama_ppns' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama PPNS Tidak Boleh Kosong !'
                    ]
                ],
                'nip' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIP Tidak Boleh Kosong !'
                    ]
                ],
                'jabatan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jabatan Tidak Boleh Kosong !'
                    ]
                ],
                'pangkat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pangkat Tidak Boleh Kosong !'
                    ]
                ],

            ])) {
                $alert = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'nama_ppns' => $this->validation->getError('nama_ppns'),
                        'nip' => $this->validation->getError('nip'),
                        'jabatan' => $this->validation->getError('jabatan'),
                        'pangkat' => $this->validation->getError('pangkat'),
                        'ttd_digital_ppns' => $this->validation->getError('ttd_digital_ppns'),

                    ]
                ];
            } else {

                $ukpd_id = $this->request->getPost('ukpd_id');
                $nama_ppns = $this->request->getPost('nama_ppns');
                $nip = $this->request->getPost('nip');
                $jabatan = $this->request->getPost('jabatan');
                $pangkat = $this->request->getPost('pangkat');


                $this->ppnsModel->save([
                    'ukpd_id' => $ukpd_id,
                    'nama_ppns' => $nama_ppns,
                    'nip' => $nip,
                    'jabatan' => $jabatan,
                    'pangkat' => $pangkat,
                ]);

                $alert = [
                    'success' => 'PPNS Berhasil di Simpan !'
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
                'ppns' => $this->ppnsModel->where(["id" => $id])->first(),
                'ukpd' => $this->ukpdModel->findAll(),
            ];

            return json_encode($data);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $tandaTanganPPNS = $this->tandaTanganPPNSModel->where(["ppns_id" => $id])->first();

            if ($tandaTanganPPNS != null) {
                $pathFile = $tandaTanganPPNS["tanda_tangan"];
                if (file_exists($pathFile)) {
                    unlink($pathFile);
                }
            }

            $this->ppnsModel->delete($id);

            $alert = [
                'success' => 'PPNS Berhasil di Hapus !'
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
                'nama_ppns' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama PPNS Tidak Boleh Kosong !'
                    ]
                ],
                'nip' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIP Tidak Boleh Kosong !'
                    ]
                ],
                'jabatan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jabatan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'ukpd_id' => $this->validation->getError('ukpd_id'),
                        'nama_ppns' => $this->validation->getError('nama_ppns'),
                        'nip' => $this->validation->getError('nip'),
                        'jabatan' => $this->validation->getError('jabatan'),
                        'pangkat' => $this->validation->getError('pangkat'),
                    ]
                ];
            } else {

                $id = $this->request->getPost('id');
                $ukpd_id = $this->request->getPost('ukpd_id');
                $nama_ppns = $this->request->getPost('nama_ppns');
                $nip = $this->request->getPost('nip');
                $jabatan = $this->request->getPost('jabatan');
                $pangkat = $this->request->getPost('pangkat');

                $this->ppnsModel->update($id, [
                    'ukpd_id' => $ukpd_id,
                    'nama_ppns' => $nama_ppns,
                    'nip' => $nip,
                    'jabatan' => $jabatan,
                    'pangkat' => $pangkat,
                ]);

                $alert = [
                    'success' => 'PPNS Berhasil di Ubah !'
                ];
            }

            return json_encode($alert);
        }
    }
}
