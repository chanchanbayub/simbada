<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class JenisKendaraanModel extends Model
{
    protected $table            = 'jenis_kendaraan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['jenis_kendaraan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
