<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Models\Petugas\UnitPenindakModel;

class Profile extends BaseController
{

    protected $unitPenindakModel;

    public function __construct()
    {
        $this->unitPenindakModel = new UnitPenindakModel();
    }

    public function index()
    {

        $unit = $this->unitPenindakModel->getProfile(session('username'));

        $data = [
            'title' => 'SIMBADA LLAJ | Profile',
            'unit' => $unit
        ];

        return view('petugas/profile', $data);
    }
}
