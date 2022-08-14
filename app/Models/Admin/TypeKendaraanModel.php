<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class TypeKendaraanModel extends Model
{
    protected $table            = 'type_kendaraan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['klasifikasi_id', 'type_kendaraan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $fieldTable = 'type_kendaraan.id, type_kendaraan.klasifikasi_id, type_kendaraan.type_kendaraan, klasifikasi_kendaraan.klasifikasi_kendaraan';

    public function getTypeKendaraan()
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->join('klasifikasi_kendaraan', 'klasifikasi_kendaraan.id = type_kendaraan.klasifikasi_id')
            ->orderBy('type_kendaraan.id desc')
            ->get()->getResultArray();
    }
}
