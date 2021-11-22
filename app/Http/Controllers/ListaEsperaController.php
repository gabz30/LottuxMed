<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lista_espera;


class ListaEsperaController extends Controller
{
    public function store(Request $request)
    {
        return lista_espera::create($request->all());
    }
    public function index()
    {
        $lista = lista_espera::with('user:id,name')
                            ->where('drID','=', auth()->user()->id)
                            ->where('estatus','=', 1)
                            ->orderBy('id','asc')
                            ->paginate(10);



        return view('pacientes.lista_espera', compact('lista'));
    }
    public function update(Request $request, $id)
    {

     
        $result = lista_espera::where('user_id','=',$id);
        return $result->update($request->all());


    }
    // public function index()
    // {
    //     return view('pacientes.lista_espera');
    // }
}
