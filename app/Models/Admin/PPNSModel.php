<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PPNSModel extends Model
{
    protected $table            = 'ppns';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['ukpd_id', 'nama_ppns', 'nip', 'jabatan', 'pangkat'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $fieldTable = 'ppns.id, ppns.ukpd_id,ppns.nama_ppns, ppns.nip, ppns.jabatan, ppns.pangkat, ukpd.ukpd, tanda_tangan_ppns.tanda_tangan';

    public function getPPNS()
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->join('ukpd', 'ukpd.id = ppns.ukpd_id', 'left')
            ->join('tanda_tangan_ppns', 'tanda_tangan_ppns.ppns_id = ppns.id', 'left')
            ->orderBy('ppns.id desc')
            ->get()->getResultArray();
    }

    public function tandaTanganPPNSNull()
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->join('ukpd', 'ukpd.id = ppns.ukpd_id', 'left')
            ->join('tanda_tangan_ppns', 'tanda_tangan_ppns.ppns_id = ppns.id', 'left')
            ->where(["tanda_tangan_ppns.tanda_tangan" => null])
            ->orderBy('ppns.id desc')
            ->get()->getResultArray();
    }
}
