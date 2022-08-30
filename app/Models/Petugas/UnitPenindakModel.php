<?php

namespace App\Models\Petugas;

use CodeIgniter\Model;

class UnitPenindakModel extends Model
{
    protected $table            = 'unit_penindak';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['ukpd_id', 'unit_penindak'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $fieldTable = 'unit_penindak.id, unit_penindak.unit_penindak, ukpd.ukpd, petugas.nama, petugas.nip_npjlp, jabatan.jabatan, tanda_tangan_petugas.tanda_tangan_petugas';

    public function getProfile($username)
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->where(["unit_penindak" => $username])
            ->join('ukpd', 'ukpd.id = unit_penindak.ukpd_id')
            ->join('petugas', 'petugas.unit_id = unit_penindak.id')
            ->join('tanda_tangan_petugas', 'petugas.id = tanda_tangan_petugas.petugas_id')
            ->join('jabatan', 'jabatan.id = petugas.jabatan_id')
            ->get()->getRowArray();
    }
}
