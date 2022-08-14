<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ProvinsiModel extends Model
{
    protected $table            = 'provinsi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['provinsi', 'ibukota', 'p_bsni'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // protected $fieldTable = 'ppns.id, ppns.ukpd_id,ppns.nama_ppns, ppns.nip, ppns.jabatan, ppns.pangkat, ukpd.ukpd';
}
