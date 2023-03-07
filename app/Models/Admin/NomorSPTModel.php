<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class NomorSPTModel extends Model
{
    protected $table            = 'nomor_surat_tugas';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nomor_surat', 'tanggal'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getNomorSurat()
    {
        return $this->table($this->table)
            ->orderBy('id desc')
            ->get()
            ->getResultArray();
    }
}
