<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class TempatPenyimpananModel extends Model
{
    protected $table            = 'tempat_penyimpanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['ukpd_id', 'tempat_penyimpanan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $fieldTable = 'tempat_penyimpanan.id, tempat_penyimpanan.ukpd_id, tempat_penyimpanan.tempat_penyimpanan, ukpd.ukpd';


    public function getPenyimpanan()
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->join('ukpd', 'ukpd.id = tempat_penyimpanan.ukpd_id')
            ->orderBy('tempat_penyimpanan.id desc')
            ->get()->getResultArray();
    }
}
