<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class IdentitasPengemudiModel extends Model
{
    protected $table            = 'identitas_pengemudi';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_penderekan', 'nomor_identitas_pengemudi', 'nama_pengemudi', 'alamat_pengemudi', 'nomor_handphone_pengemudi', 'ttd_digital', 'foto_pelanggar'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
