<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class KelurahanModel extends Model
{
    protected $table            = 'kelurahan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['kecamatan_id', 'kelurahan', 'kd_pos'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
