<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Models\Admin\JenisKendaraanModel;
use App\Models\Admin\JenisPelanggaranModel;
use App\Models\Admin\KecamatanModel;
use App\Models\Admin\KelurahanModel;
use App\Models\Admin\KlasifikasiKendaraanModel;
use App\Models\Admin\KotaModel;
use App\Models\Admin\ProvinsiModel;
use App\Models\Petugas\SaksiPenderekanModel;
use App\Models\Admin\TempatPenyimpananModel;
use App\Models\Admin\TypeKendaraanModel;
use App\Models\Admin\UkpdModel;
use App\Models\Petugas\BapModel;
use App\Models\Petugas\FotoKendaraanModel;
use App\Models\Petugas\IdentitasPengemudiModel;
use App\Models\Petugas\KendaraanModel;
use App\Models\Petugas\LokasiPenderekanModel;
use App\Models\Petugas\PenderekanModel;

class DataPenderekan extends BaseController
{
    protected $penderekanModel;
    protected $fotoKendaraanModel;
    protected $identitasPengemudiModel;

    protected $bapModel;
    protected $ukpdModel;
    protected $jenisKendaraanModel;
    protected $klasifikasiKendaraanModel;
    protected $typeKendaraanModel;
    protected $tempatPenyimpananModel;
    protected $validation;
    protected $provinsiModel;
    protected $kotaModel;
    protected $kecamatanModel;
    protected $kelurahanModel;
    protected $lokasiPenderekanModel;
    protected $kendaraanModel;
    protected $jenisPelanggaranModel;
    protected $saksiPenderekanModel;

    public function __construct()
    {
        $this->penderekanModel = new PenderekanModel();
        $this->fotoKendaraanModel = new FotoKendaraanModel();
        $this->identitasPengemudiModel = new IdentitasPengemudiModel();
        $this->bapModel = new BapModel();
        $this->ukpdModel = new UkpdModel();
        $this->jenisKendaraanModel = new JenisKendaraanModel();
        $this->klasifikasiKendaraanModel = new KlasifikasiKendaraanModel();
        $this->typeKendaraanModel = new TypeKendaraanModel();
        $this->tempatPenyimpananModel = new TempatPenyimpananModel();
        $this->validation = \Config\Services::validation();
        $this->provinsiModel = new ProvinsiModel();
        $this->kotaModel = new KotaModel();
        $this->kecamatanModel = new KecamatanModel();
        $this->kelurahanModel = new KelurahanModel();
        $this->lokasiPenderekanModel = new LokasiPenderekanModel();
        $this->kendaraanModel = new KendaraanModel();
        $this->jenisPelanggaranModel = new JenisPelanggaranModel();
        $this->saksiPenderekanModel = new SaksiPenderekanModel();
    }

    public function index()
    {
        helper('format');
        $data = [
            'title' => 'SIMBADA LLAJ | Data Penderekan',
            'data_penderekan' => $this->penderekanModel->getDataPenderekan(session('ukpd_id'), session('username'))
        ];

        return view('petugas/data_penderekan', $data);
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $data_penderekan = $this->penderekanModel->where(["id" => $id])->first();

            $data = [
                'penderekan' => $data_penderekan
            ];

            return json_encode($data);
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $foto_kendaraan = $this->fotoKendaraanModel->where(["id_penderekan" => $id])->first();

            $path = 'penderekan/' . $foto_kendaraan["foto"];

            $ttd_digital = $this->identitasPengemudiModel->where(["id_penderekan" => $id])->first();

            if ($ttd_digital != null) {
                $path_ttd = $ttd_digital["ttd_digital"];
                $path_foto = $ttd_digital["foto_pelanggar"];
                if (file_exists($path_ttd)) {
                    unlink($path_ttd);
                }
                if (file_exists($path_foto)) {
                    unlink($path_foto);
                }
                if (file_exists($path)) {
                    unlink($path);
                }
            }


            $this->penderekanModel->delete($id);

            $alert = [
                'success' => 'Data Penderekan Berhasil di Hapus !'
            ];

            return json_encode($alert);
        }
    }

    public function edit_data($noBap)
    {

        $penderekan = $this->penderekanModel->editDataPenderekan($noBap);
        // dd($penderekan);

        if ($penderekan == null) {
            return redirect()->back();
        } else {
            $data = [
                'penderekan' => $penderekan,
                'title' => 'SIMDALOPS | Edit Penderekan',
                'jenis_kendaraan' => $this->jenisKendaraanModel->findAll(),
                'jenis_pelanggaran' => $this->jenisPelanggaranModel->findAll(),
                'klasifikasi_kendaraan' => $this->klasifikasiKendaraanModel->findAll(),
                'type_kendaraan' => $this->typeKendaraanModel->findAll(),
                'tempat_penyimpanan' => $this->tempatPenyimpananModel->where(['ukpd_id' => session('ukpd_id')])->findAll(),
                'provinsi' => $this->provinsiModel->findAll(),
                'kota' => $this->kotaModel->findAll(),
                'kecamatan' => $this->kecamatanModel->findAll(),
                'kelurahan' => $this->kelurahanModel->findAll(),
                'saksi' => $this->saksiPenderekanModel->getSaksi()
            ];

            return view('petugas/edit_penderekan', $data);
        }
    }
    public function view_kendaraan($noBap)
    {
        $penderekan = $this->penderekanModel->getDetailPenderekan($noBap);
        // dd($penderekan);

        $data = [
            'title' => 'SIMBADA LLAJ | Detail Kendaraan',
            'penderekan' => $penderekan
        ];

        return view('petugas/detail', $data);
    }
}
