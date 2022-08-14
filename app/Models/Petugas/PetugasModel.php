<?php

namespace App\Models\Petugas;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table            = 'petugas';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['ukpd_id', 'unit_id', 'nama', 'nip_npjlp', 'jabatan_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $fieldTable = 'petugas.id, petugas.ukpd_id, petugas.unit_id, petugas.nama, petugas.nip_npjlp, petugas.jabatan_id';

    public function getAnggotaPetugas($username)
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->join('unit_penindak', 'unit_penindak.id = petugas.unit_id', 'left')
            ->where(["unit_penindak.unit_penindak" => $username])
            ->where(["jabatan_id" => 2])
            ->get()->getResultArray();
    }
}
