<?php

namespace App\Models\Petugas;

use CodeIgniter\Model;

class FotoKendaraanModel extends Model
{
    protected $table            = 'foto_kendaraan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_penderekan', 'mime', 'nama_foto', 'foto'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
