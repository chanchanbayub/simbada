<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class LokasiPenderekanModel extends Model
{
    protected $table            = 'lokasi_penderekan';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_penderekan', 'provinsi_id', 'kota_id', 'kecamatan_id', 'kelurahan_id', 'nama_jalan', 'nama_gedung'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
