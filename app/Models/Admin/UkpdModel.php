<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UkpdModel extends Model
{
    protected $table            = 'ukpd';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['ukpd', 'nama_ukpd'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
