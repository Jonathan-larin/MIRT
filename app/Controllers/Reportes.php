<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Reportes extends BaseController
{
    public function index()
    {
        $data = [
            'current_date' => date('d/m/Y'),
        ];

        return view('reportes/index', $data);
    }
}
