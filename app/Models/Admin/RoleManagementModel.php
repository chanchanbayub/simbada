<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class RoleManagementModel extends Model
{
    protected $table            = 'role_management';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['role_management'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
