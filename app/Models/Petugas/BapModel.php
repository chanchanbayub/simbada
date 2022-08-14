<?php

namespace App\Models\Petugas;

use CodeIgniter\Model;

class BapModel extends Model
{
    protected $table            = 'bap';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['ukpd_id', 'noBap', 'ppns_id', 'unit_id', 'status_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $fieldTable = 'bap.id, bap.ukpd_id, noBap , bap.ppns_id ,bap.unit_id, bap.status_id, ukpd.ukpd, unit_penindak.unit_penindak, ppns.nama_ppns, bap.ppns_id, status_bap.status_bap, petugas.nama, petugas.nip_npjlp';


    public function getNoBapWithUnit($ukpd_id, $username)
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->where(['bap.ukpd_id' => $ukpd_id])
            ->join('ukpd', 'ukpd.id = bap.ukpd_id')
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('ppns', 'ppns.id = bap.ppns_id')
            ->join('status_bap', 'status_bap.id = bap.status_id')
            ->join('petugas', 'petugas.unit_id = unit_penindak.id')
            ->join('jabatan', 'jabatan.id = petugas.jabatan_id')
            ->where(["petugas.jabatan_id" => 1])
            ->where(['unit_penindak.unit_penindak' => $username])
            ->where(["bap.status_id" => 1])
            ->orderBy('bap.id desc')
            ->get()->getResultArray();
    }

    public function getNoBapId($noBap)
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->where(['bap.noBap' => $noBap])
            ->join('ukpd', 'ukpd.id = bap.ukpd_id')
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('ppns', 'ppns.id = bap.ppns_id')
            ->join('status_bap', 'status_bap.id = bap.status_id')
            ->join('petugas', 'petugas.unit_id = unit_penindak.id')
            ->join('jabatan', 'jabatan.id = petugas.jabatan_id')
            ->orderBy('bap.id desc')
            ->get()->getRowArray();
    }

    public function getJumlahBap($username)
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->join('ukpd', 'ukpd.id = bap.ukpd_id')
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->where(['unit_penindak.unit_penindak' => $username])
            ->where(['status_id' => 1])
            ->join('ppns', 'ppns.id = bap.ppns_id')
            ->join('status_bap', 'status_bap.id = bap.status_id')
            ->join('petugas', 'petugas.unit_id = unit_penindak.id')
            ->join('jabatan', 'jabatan.id = petugas.jabatan_id')
            ->orderBy('bap.id desc')
            ->countAllResults();
    }
}
