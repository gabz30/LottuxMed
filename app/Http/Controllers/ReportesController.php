<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function index()
    {
        return view('reportes.todos');
    }
    public function graficas()
    {
        return view('reportes.graficas');
    }

   
}
