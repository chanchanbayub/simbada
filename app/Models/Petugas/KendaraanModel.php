<?php

namespace App\Models\Petugas;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table            = 'kendaraan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_penderekan', 'jenis_kendaraan_id', 'klasifikasi_kendaraan_id', 'type_kendaraan_id', 'merk_kendaraan', 'nomor_kendaraan', 'warna_kendaraan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
