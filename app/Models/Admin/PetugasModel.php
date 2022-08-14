<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table            = 'petugas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['ukpd_id', 'unit_id', 'nama', 'nip_npjlp', 'jabatan_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $fieldTable = 'petugas.id, petugas.ukpd_id, petugas.unit_id, petugas.nama, petugas.nip_npjlp, petugas.jabatan_id , ukpd.ukpd, unit_penindak.unit_penindak, jabatan.jabatan';

    public function getPetugas($ukpd_id)
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->where(["petugas.ukpd_id" => $ukpd_id])
            ->join('ukpd', 'ukpd.id = petugas.ukpd_id')
            ->join('unit_penindak', 'unit_penindak.id = petugas.unit_id')
            ->join('jabatan', 'jabatan.id = petugas.jabatan_id')
            ->orderBy('petugas.id desc')
            ->get()->getResultArray();
    }

    public function tandaTanganPetugasNull()
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->join('ukpd', 'ukpd.id = petugas.ukpd_id')
            ->join('unit_penindak', 'unit_penindak.id = petugas.unit_id')
            ->join('jabatan', 'jabatan.id = petugas.jabatan_id')
            ->join('tanda_tangan_petugas', 'tanda_tangan_petugas.petugas_id = petugas.id', 'left')
            ->where(["tanda_tangan_petugas" => null])
            ->orderBy('petugas.id desc')
            ->get()->getResultArray();
    }
}
