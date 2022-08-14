<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table            = 'kendaraan';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_penderekan', 'jenis_kendaraan_id', 'klasifikasi_kendaraan_id', 'type_kendaraan_id', 'merk_kendaraan', 'nomor_kendaraan', 'warna_kendaraan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $fieldTable = '';

    public function getDataKendaraandiDerek($nomor_kendaraan)
    {
        return $this->db->table($this->table)
            ->join('jenis_kendaraan', 'kendaraan.jenis_kendaraan_id = jenis_kendaraan.id')
            ->join('type_kendaraan', 'kendaraan.type_kendaraan_id = type_kendaraan.id')
            ->join('foto_kendaraan', 'foto_kendaraan.id_penderekan = kendaraan.id_penderekan')
            ->join('lokasi_penderekan', 'lokasi_penderekan.id_penderekan = kendaraan.id_penderekan')
            ->join('penderekan', 'penderekan.id = kendaraan.id_penderekan')
            ->join('bap', 'penderekan.bap_id = bap.id')
            ->join('tempat_penyimpanan', 'penderekan.tempat_penyimpanan_kendaraan_id = tempat_penyimpanan.id')
            ->like(["kendaraan.nomor_kendaraan" => $nomor_kendaraan])
            ->get()->getRowArray();
    }
}
