<?php

namespace App\Models\Petugas;

use CodeIgniter\Model;

class SaksiPenderekanModel extends Model
{
    protected $table            = 'saksi_penderekan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['ukpd_id', 'nama_saksi', 'nip_saksi', 'jabatan_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $fieldTable = 'saksi_penderekan.id, saksi_penderekan.nama_saksi, saksi_penderekan.nip_saksi, saksi_penderekan.jabatan_id, ukpd.ukpd';

    public function getSaksi()
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->join('ukpd', 'ukpd.id = saksi_penderekan.ukpd_id')
            ->join('tanda_tangan_saksi', 'tanda_tangan_saksi.saksi_id = saksi_penderekan.id')
            ->where(["jabatan_id" => 2])
            ->where("tanda_tangan_saksi !=", null)
            ->get()->getResultArray();
    }
}
