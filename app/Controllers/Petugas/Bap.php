<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Models\Petugas\BapModel;

class Bap extends BaseController
{
    protected $bapModel;

    public function __construct()
    {
        $this->bapModel = new BapModel();
    }

    public function index()
    {
        $data = [
            'title' => 'SIMDALOPS | BAPPK',
            'bap' => $this->bapModel->getNoBapWithUnit(session('ukpd_id'), session('username')),
        ];

        return view('petugas/bap', $data);
    }
}
