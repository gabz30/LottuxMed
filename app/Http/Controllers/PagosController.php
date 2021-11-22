<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\pagos;
use App\Models\Consultas;
use App\Models\estudios_interconsulta;
use App\Models\detallePagos;
use App\Models\estudios_realizados;
use App\Models\caja;
use Consulta;

class PagosController extends Controller
{
    public function consultar($id)
    {

        // $consulta = Consultas::with('Paciente:id,name','estudiosRealizados')
        // ->find($id);

        $consulta = Consultas::find($id);

        $estudios = estudios_realizados::with('estudiosInterconsulta')
        ->where('consulta_id','=',$id)
        ->get();

        $consulta->estudios = $estudios;

        // $user_id = auth()->user()->id;
        // $sql = "SELECT * FROM cajas where user_id = $user_id and estatus = 1 order by id desc LIMIT 1";
        // $cajas = DB::select($sql);


        $user_id = auth()->user()->id;

        $cajas = caja::where('user_id','=', $user_id)
                        ->where('estatus','=', 1)
                        ->orderBy('id','desc')
                        ->take(1)
                        ->get();


        // return $consulta;
        return view('pagos.consulta', compact('consulta','cajas'));
    }

    public function realizarPago(Request $request)
    {
        return pagos::create($request->all());

    } 

    public function guardarDetalle(Request $request)
    {
        return detallePagos::create($request->all());
    }
}
