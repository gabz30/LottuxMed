<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\citasPendientes;

class CitasPendientesController extends Controller
{
    
    public function index()
    {
        
        $secretaria = auth()->user()->authLogin;

        if ( empty($secretaria) ) $secretaria = 18;

        // $secretaria = 18;

        $data = citasPendientes::with('Paciente:id,name')
                                ->where('doctor_id','=', $secretaria)
                                ->where('estatus','=', 1)
                                ->orderBy('id', 'desc')
                                ->get();


        if( !$data->isEmpty() )
        {

            return [
                'msg' => 'Citas pendientes.',
                'code' => '200',
                'data' => $data
            ];

        }else{
            return [
                'msg' => 'No hay citas pendientes de aprobacion.',
                'code' => '404',
            ];
        }
    }


    public function update(Request $request, $id)
    {
        $cita = citasPendientes::find($id);
        return $cita->update($request->all());
    }

    
}
