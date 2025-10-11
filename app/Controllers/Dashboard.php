<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\publikasiModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $this->publikasi = new publikasiModel();
        $data['total_publikasi'] = $this->publikasi->countAll();

        return view('dashboard', $data);
    }
}
