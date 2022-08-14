<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class TandaTanganPPNSModel extends Model
{
    protected $table            = 'tanda_tangan_ppns';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['ppns_id', 'tanda_tangan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $fieldTable = 'tanda_tangan_ppns.id ,tanda_tangan_ppns.ppns_id, tanda_tangan_ppns.tanda_tangan, ppns.nama_ppns, ppns.nip';

    public function getTandaTanganPPNS()
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->join('ppns', 'ppns.id = tanda_tangan_ppns.ppns_id')
            ->orderBy('tanda_tangan_ppns.id')
            ->get()->getResultArray();
    }
}
