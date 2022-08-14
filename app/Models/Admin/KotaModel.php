<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KotaModel extends Model
{
    protected $table            = 'kota';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['provinsi_id', 'kabupaten_kota', 'ibu_kota', 'k_bsni'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
