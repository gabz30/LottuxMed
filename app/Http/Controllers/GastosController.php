<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\gastos;
use App\Models\caja;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\GastosExport;


class GastosController extends Controller
{
    public function index()
    {
        // return gastos::all();
        return view('contabilidad.gastos');
    }

    public function gastosExcel()
    {
        return Excel::download(new GastosExport, 'Gastos.xlsx');
    }

    public function lista()
    {
        $user_id = auth()->user()->id;
        $caja = caja::where('user_id','=', $user_id)
                        ->where('estatus','=', 1)
                        ->orderBy('id','desc')
                        ->take(1)
                        ->get();

        foreach($caja as $item)
        {
            $caja_id = $item->id;
        }

        return gastos::where('user_id','=', $user_id)
                        ->where('caja_id','=', $caja_id)
                        ->orderBy('id','desc')
                        ->get();
    }

    public function buscar(Request $request)
    {
        
        // return gastos::where('created_at','like', '%' . $request->input('fec_inicio') . '%')
        // ->orWhere('created_at','like', '%' . $request->input('fec_final') . '%')
        // ->get();

        return gastos::whereBetween('created_at', [$request->input('fec_inicio'), $request->input('fec_final')])->get();

    }

    public function guardar(Request $request)
    {
        // return $request->all();
        return gastos::create($request->all());
    }
}
