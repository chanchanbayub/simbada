<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\PetugasModel;
use App\Models\Admin\TandaTanganPetugasModel;

class TandaTanganPetugas extends BaseController
{
    protected $tandaTanganPetugasModel;
    protected $petugasModel;
    protected $validation;

    public function __construct()
    {
        $this->tandaTanganPetugasModel = new TandaTanganPetugasModel();
        $this->petugasModel = new PetugasModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMBADA LLAJ | Tanda Tangan Petugas',
            'tanda_tangan' => $this->tandaTanganPetugasModel->getTandaTanganPetugas(),
            'petugas' => $this->petugasModel->tandaTanganPetugasNull()
        ];

        return view('admin/tanda_tangan_petugas', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'petugas_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'PPNS Tidak Boleh Kosong !'
                    ]
                ],
                'tanda_tangan_petugas' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanda Tangan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'petugas_id' => $this->validation->getError('petugas_id'),
                        'tanda_tangan_petugas' => $this->validation->getError('tanda_tangan_petugas'),
                    ]
                ];
            } else {
                $petugas_id = $this->request->getPost('petugas_id');
                $tanda_tangan_petugas = $this->request->getPost('tanda_tangan_petugas');

                $direktori = "ttd_petugas/";
                $signatureImage = explode(";base64,", $tanda_tangan_petugas);

                $getTypeImage = explode("image/", $signatureImage[0]);

                $typeImage = $getTypeImage[1];

                $decodeImage = base64_decode($signatureImage[1]);

                $createRandomImage = $direktori . uniqid() . '.' . $typeImage;

                file_put_contents($createRandomImage, $decodeImage);

                $this->tandaTanganPetugasModel->save([
                    'petugas_id' => $petugas_id,
                    'tanda_tangan_petugas' => $createRandomImage,
                ]);

                $alert = [
                    'success' => 'Tanda Tangan Berhasil di Simpan !'
                ];
            }

            return json_encode($alert);
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $tanda_tangan = $this->tandaTanganPetugasModel->where(["id" => $id])->first();

            return json_encode($tanda_tangan);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $tanda_tangan_petugas = $this->tandaTanganPetugasModel->where(["id" => $id])->first();

            if ($tanda_tangan_petugas != null) {
                $path = $tanda_tangan_petugas["tanda_tangan_petugas"];
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $this->tandaTanganPetugasModel->delete($id);

            $alert = [
                'success' => 'Tanda Tangan Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }
}
