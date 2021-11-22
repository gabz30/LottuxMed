<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nomina;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\GastosExport;

class NominaController extends Controller
{
    public function index()
    {
        return view('contabilidad.nomina');
    }

    public function lista()
    {
        // return nomina::orderBy('id','desc')->get();

        $doctor_id = auth()->user()->id;
        
        return nomina::with('user')
        ->where('authLogin','=', $doctor_id)
        ->orderBy("id", "desc")
        ->get();
    }

    public function guardar(Request $request)
    {
        return nomina::create($request->all());
    }
    public function busqueda(Request $request)
    {

        // return Excel::download(new GastosExport, 'Gastos.xlsx');
        
        $authLogin = auth()->user()->id;
        $fecha_inicio = $request->input('fec_inicio');
        $fecha_final = $request->input('fec_final');
        
        

       return $Nomina = nomina::with('User:id,name')
                        ->where('created_at','>=', $fecha_inicio)
                        ->where('created_at','<=', $fecha_final)
                        ->where('estatus','=', 1)
                        ->where('authLogin','=', $authLogin)
                        ->get();

    }

    public function update(Request $request, $id)
    {
        $nomina = nomina::find($id);
        return $nomina->update($request->all());
    }

}
