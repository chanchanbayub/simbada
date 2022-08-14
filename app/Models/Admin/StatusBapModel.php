<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class StatusBapModel extends Model
{
    protected $table            = 'status_bap';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['status_bap'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
