<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class JenisPelanggaranModel extends Model
{
    protected $table            = 'jenis_pelanggaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['pasal_pelanggaran', 'keterangan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
