<?php

namespace App\Http\Controllers;

use App\Models\extraConsulta;
use Illuminate\Http\Request;

class extraConsultasController extends Controller
{
    public function store(Request $request)
    {
        return extraConsulta::create($request->all());
    }

    public function show($id)
    {
        return extraConsulta::where('consulta_id','=', $id)
                                ->orderBy('id','asc')
                                ->get();
    }
}
