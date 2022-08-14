<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class TandaTanganPetugasModel extends Model
{
    protected $table            = 'tanda_tangan_petugas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['petugas_id', 'tanda_tangan_petugas'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $fieldTable = 'tanda_tangan_petugas.id ,tanda_tangan_petugas.petugas_id, tanda_tangan_petugas.tanda_tangan_petugas, petugas.nama, petugas.nip_npjlp';

    public function getTandaTanganPetugas()
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->join('petugas', 'petugas.id = tanda_tangan_petugas.petugas_id')
            ->orderBy('tanda_tangan_petugas.id desc')
            ->get()->getResultArray();
    }
}
