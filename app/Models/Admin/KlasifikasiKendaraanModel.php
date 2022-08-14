<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KlasifikasiKendaraanModel extends Model
{
    protected $table            = 'klasifikasi_kendaraan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['jenis_kendaraan_id', 'klasifikasi_kendaraan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $fieldTable = 'klasifikasi_kendaraan.id, klasifikasi_kendaraan.jenis_kendaraan_id, klasifikasi_kendaraan.klasifikasi_kendaraan, jenis_kendaraan.jenis_kendaraan';

    public function getKlasifikasi()
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->join('jenis_kendaraan', 'jenis_kendaraan.id = klasifikasi_kendaraan.jenis_kendaraan_id')
            ->orderBy('klasifikasi_kendaraan.id desc')
            ->get()->getResultArray();
    }
}
