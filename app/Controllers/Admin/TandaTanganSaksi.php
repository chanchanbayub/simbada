<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\SaksiPenderekanModel;
use App\Models\Admin\TandaTanganSaksiModel;

class TandaTanganSaksi extends BaseController
{
    protected $tandaTanganSaksiModel;
    protected $saksiPenderekanModel;
    protected $validation;

    public function __construct()
    {
        $this->tandaTanganSaksiModel = new TandaTanganSaksiModel();
        $this->saksiPenderekanModel = new SaksiPenderekanModel();
        $this->validation = \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMBADA LLAJ | Tanda Tangan Saksi',
            'tanda_tangan_saksi' => $this->tandaTanganSaksiModel->getTandaTanganSaksi(),
            'saksi' => $this->saksiPenderekanModel->tandaTanganSaksiNull()
        ];

        return view('admin/tanda_tangan_saksi', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'saksi_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'PPNS Tidak Boleh Kosong !'
                    ]
                ],
                'tanda_tangan_saksi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanda Tangan Tidak Boleh Kosong !'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'saksi_id' => $this->validation->getError('saksi_id'),
                        'tanda_tangan_saksi' => $this->validation->getError('tanda_tangan_saksi'),
                    ]
                ];
            } else {
                $saksi_id = $this->request->getPost('saksi_id');
                $tanda_tangan_saksi = $this->request->getPost('tanda_tangan_saksi');

                $direktori = "ttd_saksi/";
                $signatureImage = explode(";base64,", $tanda_tangan_saksi);

                $getTypeImage = explode("image/", $signatureImage[0]);

                $typeImage = $getTypeImage[1];

                $decodeImage = base64_decode($signatureImage[1]);

                $createRandomImage = $direktori . uniqid() . '.' . $typeImage;

                file_put_contents($createRandomImage, $decodeImage);

                $this->tandaTanganSaksiModel->save([
                    'saksi_id' => $saksi_id,
                    'tanda_tangan_saksi' => $createRandomImage,
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
            // dd($id);

            $tanda_tangan = $this->tandaTanganSaksiModel->where(["id" => $id])->first();

            return json_encode($tanda_tangan);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $tanda_tangan = $this->tandaTanganSaksiModel->where(["id" => $id])->first();

            if ($tanda_tangan != null) {
                $path = $tanda_tangan["tanda_tangan_saksi"];
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $this->tandaTanganSaksiModel->delete($id);

            $alert = [
                'success' => 'Tanda Tangan Berhasil di Hapus!'
            ];

            return json_encode($alert);
        }
    }
}
