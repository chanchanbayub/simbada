<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\BapModel;
use App\Models\Admin\PenderekanModel;
use App\Models\Admin\UnitPenindakModel;
use App\Models\Admin\UserManagementModel;

class Dashboard extends BaseController
{
    protected $bapModel;
    protected $penderekanModel;
    protected $unitPenindakModel;
    protected $userManagementModel;

    public function __construct()
    {
        $this->bapModel = new BapModel();
        $this->penderekanModel = new PenderekanModel();
        $this->unitPenindakModel = new UnitPenindakModel();
        $this->userManagementModel = new UserManagementModel();
    }

    public function index()
    {
        $date = date('Y-m-d');
        $data = [
            'title' => 'SIMBADA LLAJ  | Dashboard',
            'jumlahBap' => $this->bapModel->getJumlahBap(),
            'jumlahPenderekan' => $this->penderekanModel->getJumlahPenderekan($date),
            'jumlahRegu' => $this->unitPenindakModel->countAllResults(),
            'jumlahUser' => $this->userManagementModel->countAllResults(),
        ];

        return view('admin/dashboard', $data);
    }
}
