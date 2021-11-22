<?php

namespace App\Http\Controllers;

use App\Models\Consultas;
use Illuminate\Http\Request;
use App\Models\pedidosfarmacia;


class pedidosfarmaciaController extends Controller
{
    public function store(Request $request)
    {

        $farmacia_id = $request->input('farmacia_id');
        $doctor_id   = $request->input('doctor_id');

        $datos = Consultas::where('drID', '=', $doctor_id)
            ->orderBy('id', 'desc')
            ->take(1)
            ->get();


        $consulta_id = 0;
        $paciente_id = 0;

        foreach ($datos as $item) {
            $consulta_id = $item->id;
            $paciente_id = $item->user_id;
        }


        return pedidosfarmacia::create([
            'consulta_id' => $consulta_id,
            'farmacia_id' => $farmacia_id,
            'paciente_id' => $paciente_id,
            'drID' => $doctor_id,
            'estatus' => 1
        ]);
    }

    public function lista()
    {

        $pedidos = pedidosfarmacia::with('doctor:id,name','paciente:id,name,aseguradora_id,seguro_afiliado,seguro_plan')
                                    // ->take(1)
                                    ->where('estatus','>', 0)
                                    ->orderBy('id', 'desc')
                                    ->get();

        $seguro = [];
        
        foreach ($pedidos as $item) { $seguro[] = $item->paciente->aseguradora->nombre; }

        return $pedidos;

    }

    public function update(Request $request, $id){
        $pedidos = pedidosfarmacia::find($id);
        return $pedidos->update($request->all());
    }
}
