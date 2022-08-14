<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class JenisPenindakanModel extends Model
{
    protected $table            = 'jenis_penindakan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama_penindakan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
