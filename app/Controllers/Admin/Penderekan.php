<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\BapModel;
use App\Models\Admin\FotoKendaraanModel;
use App\Models\Admin\IdentitasPengemudiModel;
use App\Models\Admin\JenisKendaraanModel;
use App\Models\Admin\JenisPelanggaranModel;
use App\Models\Admin\KecamatanModel;
use App\Models\Admin\KelurahanModel;
use App\Models\Admin\KendaraanModel;
use App\Models\Admin\KlasifikasiKendaraanModel;
use App\Models\Admin\KotaModel;
use App\Models\Admin\LokasiPenderekanModel;
use App\Models\Admin\PenderekanModel;
use App\Models\Admin\ProvinsiModel;
use App\Models\Admin\TempatPenyimpananModel;
use App\Models\Admin\TypeKendaraanModel;
use App\Models\Admin\UkpdModel;
use App\Models\Admin\UnitPenindakModel;

class Penderekan extends BaseController
{
    protected $penderekanModel;
    protected $fotoKendaraanModel;
    protected $identitasPengemudiModel;
    protected $unitPenindakModel;
    protected $ukpdModel;

    protected $bapModel;
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
        $this->unitPenindakModel = new UnitPenindakModel();
        $this->ukpdModel = new UkpdModel();
    }

    public function index()
    {
        helper('format');
        $data = [
            'title' => 'SIMDALOPS | Penderekan ' . session('ukpd'),
            'data_penderekan' => $this->penderekanModel->getDataPenderekan(session('ukpd_id'), session('username'))
        ];

        return view('admin/admin_penderekan', $data);
    }

    public function form_penderekan()
    {
        $data = [
            'title' => 'SIMDALOPS | Penderekan ' . session('ukpd'),
            'jenis_kendaraan' => $this->jenisKendaraanModel->findAll(),
            'jenis_pelanggaran' => $this->jenisPelanggaranModel->findAll(),
            'klasifikasi_kendaraan' => $this->klasifikasiKendaraanModel->findAll(),
            'type_kendaraan' => $this->typeKendaraanModel->findAll(),
            'tempat_penyimpanan' => $this->tempatPenyimpananModel->where(['ukpd_id' => session('ukpd_id')])->findAll(),
            'provinsi' => $this->provinsiModel->findAll(),
            'kota' => $this->kotaModel->findAll(),
            'kecamatan' => $this->kecamatanModel->findAll(),
            'kelurahan' => $this->kelurahanModel->findAll(),
            'unit_penindak' => $this->unitPenindakModel->where(["ukpd_id" => session('ukpd_id')])->findAll(),
            'ukpd' => $this->ukpdModel->findAll()
        ];

        return view('admin/tambah_penderekan', $data);
    }


    public function getNoBap()
    {
        if ($this->request->isAJAX()) {

            $unit_id = $this->request->getVar('unit_id');

            $data = [
                'bap' => $this->bapModel->where(["unit_id" => $unit_id])->where(["status_id" => 1])->findAll()
            ];

            return json_encode($data);
        }
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'unit_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Unit / Regu Tidak Boleh Kosong!'
                    ]
                ],
                'bap_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor BAP Tidak Boleh Kosong!'
                    ]
                ],
                'jenis_kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'klasifikasi_kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Klasifikasi Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'type_kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Type Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'merk_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Merk Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'nomor_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'jenis_pelanggaran_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Pelanggaran Tidak Boleh Kosong!'
                    ]
                ],
                'tanggal_penderekan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Penderekan Tidak Boleh Kosong!'
                    ]
                ],
                'jam_penderekan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jam Penderekan Tidak Boleh Kosong!'
                    ]
                ],
                'provinsi_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Provinsi Tidak Boleh Kosong!'
                    ]
                ],
                'kota_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kota Tidak Boleh Kosong!'
                    ]
                ],
                'kecamatan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kecamatan Tidak Boleh Kosong!'
                    ]
                ],
                'kelurahan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kelurahan Tidak Boleh Kosong!'
                    ]
                ],
                'nama_jalan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Jalan Tidak Boleh Kosong!'
                    ]
                ],
                'nomor_identitas_pengemudi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Jalan Tidak Boleh Kosong!'
                    ]
                ],
                'nama_pengemudi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Pengemudi Tidak Boleh Kosong!'
                    ]
                ],
                'alamat_pengemudi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat Pengemudi Tidak Boleh Kosong!'
                    ]
                ],
                'nomor_handphone_pengemudi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Handphone Tidak Boleh Kosong!'
                    ]
                ],
                'tempat_penyimpanan_kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tempat Penyimpanan Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'foto' => [
                    'rules' => 'uploaded[foto]|is_image[foto]|max_size[foto,2048]',
                    'errors' => [
                        'uploaded' => 'Foto Kendaraan Tidak Boleh Kosong!',
                        'is_image' => 'Yang Anda Upload Bukan Foto!',
                        'max_size' => 'Ukuran Foto Terlalu Besar',
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'unit_id' => $this->validation->getError('unit_id'),
                        'bap_id' => $this->validation->getError('bap_id'),
                        'jenis_kendaraan_id' => $this->validation->getError('jenis_kendaraan_id'),
                        'klasifikasi_kendaraan_id' => $this->validation->getError('klasifikasi_kendaraan_id'),
                        'type_kendaraan_id' => $this->validation->getError('type_kendaraan_id'),
                        'merk_kendaraan' => $this->validation->getError('merk_kendaraan'),
                        'nomor_kendaraan' => $this->validation->getError('nomor_kendaraan'),
                        'jenis_pelanggaran_id' => $this->validation->getError('jenis_pelanggaran_id'),
                        'tanggal_penderekan' => $this->validation->getError('tanggal_penderekan'),
                        'jam_penderekan' => $this->validation->getError('jam_penderekan'),
                        'provinsi_id' => $this->validation->getError('provinsi_id'),
                        'kota_id' => $this->validation->getError('kota_id'),
                        'kecamatan_id' => $this->validation->getError('kecamatan_id'),
                        'kelurahan_id' => $this->validation->getError('kelurahan_id'),
                        'nama_jalan' => $this->validation->getError('nama_jalan'),
                        'nomor_identitas_pengemudi' => $this->validation->getError('nomor_identitas_pengemudi'),
                        'nama_pengemudi' => $this->validation->getError('nama_pengemudi'),
                        'alamat_pengemudi' => $this->validation->getError('alamat_pengemudi'),
                        'nomor_handphone_pengemudi' => $this->validation->getError('nomor_handphone_pengemudi'),
                        'tempat_penyimpanan_kendaraan_id' => $this->validation->getError('tempat_penyimpanan_kendaraan_id'),
                        'foto' => $this->validation->getError('foto'),
                    ]
                ];
            } else {

                $ukpd_id = $this->request->getVar('ukpd_id');
                $bap_id = $this->request->getVar('bap_id');
                // table Kendaraan
                $jenis_kendaraan_id = $this->request->getVar('jenis_kendaraan_id');
                $klasifikasi_kendaraan_id = $this->request->getVar('klasifikasi_kendaraan_id');
                $type_kendaraan_id = $this->request->getVar('type_kendaraan_id');
                $merk_kendaraan = $this->request->getVar('merk_kendaraan');
                $nomor_kendaraan = $this->request->getVar('nomor_kendaraan');
                $warna_kendaraan = $this->request->getVar('warna_kendaraan');
                $foto = $this->request->getFile('foto');

                $namaFile = $foto->getRandomName();
                $mime = $foto->getMimeType();
                $foto->move('penderekan', $namaFile);
                // table penderekan
                $tanggal_penderekan = $this->request->getVar('tanggal_penderekan');
                $jam_penderekan = $this->request->getVar('jam_penderekan');
                $tempat_penyimpanan_kendaraan_id = $this->request->getVar('tempat_penyimpanan_kendaraan_id');
                $jenis_pelanggaran_id = $this->request->getVar('jenis_pelanggaran_id');
                //table lokasi_penderekan
                $provinsi_id = $this->request->getVar('provinsi_id');
                $kota_id = $this->request->getVar('kota_id');
                $kecamatan_id = $this->request->getVar('kecamatan_id');
                $kelurahan_id = $this->request->getVar('kelurahan_id');
                $nama_jalan = $this->request->getVar('nama_jalan');
                $nama_gedung = $this->request->getVar('nama_gedung');
                // table identitas pengemudi
                $nomor_identitas_pengemudi = $this->request->getVar('nomor_identitas_pengemudi');
                $nama_pengemudi = $this->request->getVar('nama_pengemudi');
                $alamat_pengemudi = $this->request->getVar('alamat_pengemudi');
                $nomor_handphone_pengemudi = $this->request->getVar('nomor_handphone_pengemudi');

                // Generate Foto Pelanggar
                $foto_pelanggar = $this->request->getVar('foto_pelanggar');

                $direktori = "foto_pelanggar/";
                $image = explode(";base64,", $foto_pelanggar);

                $getTypeImages = explode("image/", $image[0]);

                $typeImages = $getTypeImages[1];

                $decodeImages = base64_decode($image[1]);

                $createImage = $direktori . uniqid() . '.' . $typeImages;

                file_put_contents($createImage, $decodeImages);
                // End Foto Pelanggar

                $ttd_digital = $this->request->getVar('ttd_digital');

                $direktori = "ttd_digital/";
                $signatureImage = explode(";base64,", $ttd_digital);

                $getTypeImage = explode("image/", $signatureImage[0]);

                $typeImage = $getTypeImage[1];

                $decodeImage = base64_decode($signatureImage[1]);

                $createRandomImage = $direktori . uniqid() . '.' . $typeImage;

                file_put_contents($createRandomImage, $decodeImage);

                $this->penderekanModel->save([
                    'ukpd_id' => $ukpd_id,
                    'bap_id' => $bap_id,
                    'jenis_pelanggaran_id' => $jenis_pelanggaran_id,
                    'tanggal_penderekan' => $tanggal_penderekan,
                    'jam_penderekan' => $jam_penderekan,
                    'tempat_penyimpanan_kendaraan_id' => $tempat_penyimpanan_kendaraan_id,
                ]);

                $id_penderekan = $this->penderekanModel->InsertID();

                $this->lokasiPenderekanModel->save([
                    'id_penderekan' => $id_penderekan,
                    'provinsi_id' => $provinsi_id,
                    'kota_id' => $kota_id,
                    'kecamatan_id' => $kecamatan_id,
                    'kelurahan_id' => $kelurahan_id,
                    'nama_jalan' => $nama_jalan,
                    'nama_gedung' => $nama_gedung,
                ]);

                $this->kendaraanModel->save([
                    'id_penderekan' => $id_penderekan,
                    'jenis_kendaraan_id' => $jenis_kendaraan_id,
                    'klasifikasi_kendaraan_id' => $klasifikasi_kendaraan_id,
                    'type_kendaraan_id' => $type_kendaraan_id,
                    'merk_kendaraan' => $merk_kendaraan,
                    'nomor_kendaraan' => $nomor_kendaraan,
                    'warna_kendaraan' => $warna_kendaraan,
                ]);

                $this->identitasPengemudiModel->save([
                    'id_penderekan' => $id_penderekan,
                    'nomor_identitas_pengemudi' => $nomor_identitas_pengemudi,
                    'nama_pengemudi' => $nama_pengemudi,
                    'alamat_pengemudi' => $alamat_pengemudi,
                    'nomor_handphone_pengemudi' => $nomor_handphone_pengemudi,
                    'ttd_digital' => $createRandomImage,
                    'foto_pelanggar' => $createImage
                ]);

                $this->fotoKendaraanModel->save([
                    'id_penderekan' => $id_penderekan,
                    'mime' => $mime,
                    'foto' => $namaFile
                ]);

                $this->bapModel->update($bap_id, [
                    'id' => $bap_id,
                    'status_id' => 2
                ]);

                $alert = [
                    'success' => 'Penderekan Berhasil di Simpan!'
                ];
            }

            return json_encode($alert);
        }
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

            $path_penderekan = 'penderekan/' . $foto_kendaraan["foto"];

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

                if (file_exists($path_penderekan)) {
                    unlink($path_penderekan);
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
            ];

            return view('admin/edit_data_penderekan', $data);
        }
    }

    public function getKlasifikasi()
    {
        if ($this->request->isAjax()) {

            $id = $this->request->getVar('jenis_kendaraan_id');

            $data = [
                'klasifikasi_kendaraan' => $this->klasifikasiKendaraanModel->where(["jenis_kendaraan_id" => $id])->findAll()
            ];

            return json_encode($data);
        }
    }

    public function getTypeKendaraan()
    {
        if ($this->request->isAjax()) {

            $id = $this->request->getVar('klasifikasi_kendaraan_id');

            $data = [
                'type_kendaraan' => $this->typeKendaraanModel->where(["klasifikasi_id" => $id])->findAll()
            ];

            return json_encode($data);
        }
    }


    public function getKota()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('provinsi_id');

            $data = [
                'kota' => $this->kotaModel->where(["provinsi_id" => $id])->findAll()
            ];

            return json_encode($data);
        }
    }

    public function getKecamatan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('kota_id');

            $data = [
                'kecamatan' => $this->kecamatanModel->where(["kabkot_id" => $id])->findAll()
            ];

            return json_encode($data);
        }
    }

    public function getKelurahan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('kecamatan_id');

            $data = [
                'kelurahan' => $this->kelurahanModel->where(["kecamatan_id" => $id])->findAll()
            ];

            return json_encode($data);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'jenis_kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'klasifikasi_kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Klasifikasi Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'type_kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Type Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'merk_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Merk Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'nomor_kendaraan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
                'jenis_pelanggaran_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Pelanggaran Tidak Boleh Kosong!'
                    ]
                ],
                'tanggal_penderekan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Penderekan Tidak Boleh Kosong!'
                    ]
                ],
                'jam_penderekan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jam Penderekan Tidak Boleh Kosong!'
                    ]
                ],
                'provinsi_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Provinsi Tidak Boleh Kosong!'
                    ]
                ],
                'kota_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kota Tidak Boleh Kosong!'
                    ]
                ],
                'kecamatan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kecamatan Tidak Boleh Kosong!'
                    ]
                ],
                'kelurahan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kelurahan Tidak Boleh Kosong!'
                    ]
                ],
                'nama_jalan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Jalan Tidak Boleh Kosong!'
                    ]
                ],
                'nomor_identitas_pengemudi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Jalan Tidak Boleh Kosong!'
                    ]
                ],
                'nama_pengemudi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Pengemudi Tidak Boleh Kosong!'
                    ]
                ],
                'alamat_pengemudi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat Pengemudi Tidak Boleh Kosong!'
                    ]
                ],
                'tempat_penyimpanan_kendaraan_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tempat Penyimpanan Kendaraan Tidak Boleh Kosong!'
                    ]
                ],
            ])) {
                $alert = [
                    'error' => [
                        'jenis_kendaraan_id' => $this->validation->getError('jenis_kendaraan_id'),
                        'klasifikasi_kendaraan_id' => $this->validation->getError('klasifikasi_kendaraan_id'),
                        'type_kendaraan_id' => $this->validation->getError('type_kendaraan_id'),
                        'merk_kendaraan' => $this->validation->getError('merk_kendaraan'),
                        'nomor_kendaraan' => $this->validation->getError('nomor_kendaraan'),
                        'jenis_pelanggaran_id' => $this->validation->getError('jenis_pelanggaran_id'),
                        'tanggal_penderekan' => $this->validation->getError('tanggal_penderekan'),
                        'jam_penderekan' => $this->validation->getError('jam_penderekan'),
                        'provinsi_id' => $this->validation->getError('provinsi_id'),
                        'kota_id' => $this->validation->getError('kota_id'),
                        'kecamatan_id' => $this->validation->getError('kecamatan_id'),
                        'kelurahan_id' => $this->validation->getError('kelurahan_id'),
                        'nama_jalan' => $this->validation->getError('nama_jalan'),
                        'nomor_identitas_pengemudi' => $this->validation->getError('nomor_identitas_pengemudi'),
                        'nama_pengemudi' => $this->validation->getError('nama_pengemudi'),
                        'alamat_pengemudi' => $this->validation->getError('alamat_pengemudi'),
                        'nomor_handphone_pengemudi' => $this->validation->getError('nomor_handphone_pengemudi'),
                        'tempat_penyimpanan_kendaraan_id' => $this->validation->getError('tempat_penyimpanan_kendaraan_id'),
                    ]
                ];
            } else {

                $id = $this->request->getVar('id');
                $fotoLama = $this->request->getVar('fotoLama');
                $mimeLama = $this->request->getVar('mimeLama');
                $ttd_digital = $this->request->getVar('ttd_digital');

                $ukpd_id = $this->request->getVar('ukpd_id');
                $bap_id = $this->request->getVar('bap_id');
                // table Kendaraan
                $jenis_kendaraan_id = $this->request->getVar('jenis_kendaraan_id');
                $klasifikasi_kendaraan_id = $this->request->getVar('klasifikasi_kendaraan_id');
                $type_kendaraan_id = $this->request->getVar('type_kendaraan_id');
                $merk_kendaraan = $this->request->getVar('merk_kendaraan');
                $nomor_kendaraan = $this->request->getVar('nomor_kendaraan');
                $warna_kendaraan = $this->request->getVar('warna_kendaraan');
                $foto = $this->request->getFile('foto');

                if ($foto->getError() == 4) {
                    $namaFile = $fotoLama;
                    $mime = $mimeLama;
                } else {
                    $namaFile = $foto->getRandomName();
                    $mime = $foto->getMimeType();
                    $foto->move('penderekan/', $namaFile);
                    if (file_exists('penderekan/' . $fotoLama)) {
                        unlink('penderekan/' . $fotoLama);
                    }
                }

                // table penderekan
                $tanggal_penderekan = $this->request->getVar('tanggal_penderekan');
                $jam_penderekan = $this->request->getVar('jam_penderekan');
                $tempat_penyimpanan_kendaraan_id = $this->request->getVar('tempat_penyimpanan_kendaraan_id');
                $jenis_pelanggaran_id = $this->request->getVar('jenis_pelanggaran_id');
                //table lokasi_penderekan
                $id_penderekan = $this->request->getVar('id');
                $provinsi_id = $this->request->getVar('provinsi_id');
                $kota_id = $this->request->getVar('kota_id');
                $kecamatan_id = $this->request->getVar('kecamatan_id');
                $kelurahan_id = $this->request->getVar('kelurahan_id');
                $nama_jalan = $this->request->getVar('nama_jalan');
                $nama_gedung = $this->request->getVar('nama_gedung');
                // table identitas pengemudi
                $nomor_identitas_pengemudi = $this->request->getVar('nomor_identitas_pengemudi');
                $nama_pengemudi = $this->request->getVar('nama_pengemudi');
                $alamat_pengemudi = $this->request->getVar('alamat_pengemudi');
                $nomor_handphone_pengemudi = $this->request->getVar('nomor_handphone_pengemudi');


                $this->penderekanModel->update($id, [
                    'id' => $id,
                    'ukpd_id' => $ukpd_id,
                    'bap_id' => $bap_id,
                    'jenis_pelanggaran_id' => $jenis_pelanggaran_id,
                    'tanggal_penderekan' => $tanggal_penderekan,
                    'jam_penderekan' => $jam_penderekan,
                    'tempat_penyimpanan_kendaraan_id' => $tempat_penyimpanan_kendaraan_id,
                ]);

                $lokasiPenderekan = $this->lokasiPenderekanModel->where(["id_penderekan" => $id_penderekan])->first();

                $this->lokasiPenderekanModel->update($lokasiPenderekan["id"], [
                    'id' => $lokasiPenderekan["id"],
                    'id_penderekan' => $id_penderekan,
                    'provinsi_id' => $provinsi_id,
                    'kota_id' => $kota_id,
                    'kecamatan_id' => $kecamatan_id,
                    'kelurahan_id' => $kelurahan_id,
                    'nama_jalan' => $nama_jalan,
                    'nama_gedung' => $nama_gedung,
                ]);

                $kendaraan = $this->kendaraanModel->where(["id_penderekan" => $id_penderekan])->first();

                $this->kendaraanModel->update($kendaraan["id"], [
                    'id' => $kendaraan["id"],
                    'id_penderekan' => $id_penderekan,
                    'jenis_kendaraan_id' => $jenis_kendaraan_id,
                    'klasifikasi_kendaraan_id' => $klasifikasi_kendaraan_id,
                    'type_kendaraan_id' => $type_kendaraan_id,
                    'merk_kendaraan' => $merk_kendaraan,
                    'nomor_kendaraan' => $nomor_kendaraan,
                    'warna_kendaraan' => $warna_kendaraan,
                ]);

                $identitasPengemudi = $this->identitasPengemudiModel->where(["id_penderekan" => $id_penderekan])->first();

                $this->identitasPengemudiModel->update($identitasPengemudi['id'], [
                    'id' => $identitasPengemudi["id"],
                    'id_penderekan' => $id_penderekan,
                    'nomor_identitas_pengemudi' => $nomor_identitas_pengemudi,
                    'nama_pengemudi' => $nama_pengemudi,
                    'alamat_pengemudi' => $alamat_pengemudi,
                    'nomor_handphone_pengemudi' => $nomor_handphone_pengemudi,
                    'ttd_digital' => $ttd_digital
                ]);

                $fotoKendaraan = $this->fotoKendaraanModel->where(["id_penderekan" => $id_penderekan])->first();

                $this->fotoKendaraanModel->update($fotoKendaraan["id"], [
                    'id' => $fotoKendaraan["id"],
                    'id_penderekan' => $id_penderekan,
                    'mime' => $mime,
                    'foto' => $namaFile
                ]);

                $this->bapModel->update($bap_id, [
                    'id' => $bap_id,
                    'status_id' => 2
                ]);

                $alert = [
                    'success' => 'Penderekan Berhasil di Di Update!'
                ];
            }

            return json_encode($alert);
        }
    }
}
