<?php

namespace App\Controllers\Pdf;

use App\Controllers\BaseController;
use App\Models\Petugas\PenderekanModel;
use Mpdf\Mpdf;

class PdfController extends BaseController
{
    protected $mpdf;
    protected $penderekanModel;


    public function __construct()
    {
        $this->mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 330]]);

        $this->penderekanModel = new PenderekanModel();
    }

    public function index($noBap)
    {
        $this->mpdf->showImageErrors = true;
        $penderekan = $this->penderekanModel->getBAPDigital($noBap);
        // dd($penderekan);

        helper(['format']);
        $data = [
            'penderekan' =>  $penderekan
        ];
        $html = view('pdf/bap-digital', $data);
        $this->mpdf->WriteHTML($html);

        $this->response->setHeader('Content-Type', 'application/pdf');;
        $this->mpdf->output('BAP_DIGITAL.pdf', 'I');
    }
}
