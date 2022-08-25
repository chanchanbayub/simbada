<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Models\Petugas\BapModel;
use App\Models\Petugas\PenderekanModel;

class Dashboard extends BaseController
{

    protected $bapModel;
    protected $penderekanModel;

    public function __construct()
    {
        $this->bapModel = new BapModel();
        $this->penderekanModel = new PenderekanModel();
    }

    public function index()
    {
        $date = date('Y-m-d');
        $data = [
            'title' => 'SIMBADA LLAJ | Dashboard',
            'jumlahBap' => $this->bapModel->getJumlahBap(session('username')),
            'jumlahPenderekan' => $this->penderekanModel->getJumlahPenderekan(session('username'), $date)
        ];

        return view('petugas/dashboard', $data);
    }
}
