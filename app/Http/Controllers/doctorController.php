<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class doctorController extends Controller
{
    public function doctorDocumentos()
    {
        return view('doctor.documentos');
    }
}
