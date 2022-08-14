<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\PPNSModel;
use App\Models\Admin\TandaTanganPPNSModel;

class TandaTanganPPNS extends BaseController
{
    protected $tandaTanganPPNSModel;
    protected $ppnsModel;
    protected $validation;

    public function __construct()
    {
        $this->tandaTanganPPNSModel = new TandaTanganPPNSModel();
        $this->ppnsModel = new PPNSModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMDALOPS | Tanda Tangan PPNS',
            'tanda_tangan' => $this->tandaTanganPPNSModel->getTandaTanganPPNS(),
            'ppns' => $this->ppnsModel->tandaTanganPPNSNull()
        ];

        return view('admin/tanda_tangan_ppns', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'ppns_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'PPNS Tidak Boleh Kosong !'
                    ]
                ],
                'tanda_tangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanda Tangan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'ppns_id' => $this->validation->getError('ppns_id'),
                        'tanda_tangan' => $this->validation->getError('tanda_tangan'),
                    ]
                ];
            } else {
                $ppns_id = $this->request->getPost('ppns_id');
                $tanda_tangan = $this->request->getPost('tanda_tangan');

                $direktori = "ttd_ppns/";
                $signatureImage = explode(";base64,", $tanda_tangan);

                $getTypeImage = explode("image/", $signatureImage[0]);

                $typeImage = $getTypeImage[1];

                $decodeImage = base64_decode($signatureImage[1]);

                $createRandomImage = $direktori . uniqid() . '.' . $typeImage;

                file_put_contents($createRandomImage, $decodeImage);

                $this->tandaTanganPPNSModel->save([
                    'ppns_id' => $ppns_id,
                    'tanda_tangan' => $createRandomImage,
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

            $tanda_tangan = $this->tandaTanganPPNSModel->where(["id" => $id])->first();

            return json_encode($tanda_tangan);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $tanda_tangan = $this->tandaTanganPPNSModel->where(["id" => $id])->first();

            if ($tanda_tangan["tanda_tangan"] != null) {
                $path = $tanda_tangan["tanda_tangan"];
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $this->tandaTanganPPNSModel->delete($id);

            $alert = [
                'success' => 'Tanda Tangan Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }
}
