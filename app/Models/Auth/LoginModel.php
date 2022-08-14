<?php

namespace App\Models\Auth;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table            = 'user_management';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['ukpd_id', 'role_id', 'username', 'password', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $fieldTable = 'user_management.id, user_management.ukpd_id, user_management.role_id, user_management.username, user_management.password, user_management.status, ukpd.ukpd, ukpd.nama_ukpd , role_management.role_management';

    public function getUsersLogedIn($username)
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->where(["username" => $username])
            ->join('ukpd', 'ukpd.id = user_management.ukpd_id')
            ->join('role_management', 'role_management.id = user_management.role_id')
            ->orderBy('user_management.id desc')
            ->get()->getRowArray();
    }
}
