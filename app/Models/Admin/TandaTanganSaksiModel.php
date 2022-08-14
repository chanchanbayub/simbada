<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class TandaTanganSaksiModel extends Model
{
    protected $table            = 'tanda_tangan_saksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['saksi_id', 'tanda_tangan_saksi'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $fieldTable = 'tanda_tangan_saksi.id ,tanda_tangan_saksi.saksi_id, tanda_tangan_saksi.tanda_tangan_saksi, saksi_penderekan.nama_saksi, saksi_penderekan.nip_saksi';

    public function getTandaTanganSaksi()
    {
        return $this->table($this->table)
            ->select($this->fieldTable)
            ->join('saksi_penderekan', 'saksi_penderekan.id = tanda_tangan_saksi.saksi_id')
            ->orderBy('tanda_tangan_saksi.id desc')
            ->get()->getResultArray();
    }
}
