<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\pagos;

class ContabilidadController extends Controller
{
    public function index()
    {
        return view('contabilidad.index');
    }

    public function buscar(Request $request)
    {
        
        // return pagos::whereBetween('created_at', [$request->input('fec_inicio'), $request->input('fec_final')])->get();
        $user_id = auth()->user()->id;
        $fecha_inicio = $request->input('fec_inicio');
        $fecha_final = $request->input('fec_final');
        
       


        $sql = "SELECT p.total_pago as suma_total,p.caja_id, p.consulta_id,p.monto_seguro,p.tipo_pago, u.name as secretaria
        from pagos p,users u
        where true
            and p.authLogin in (select u.id from users where u.authLogin = $user_id)
            and u.id = p.authLogin
            and p.created_at between '$fecha_inicio 00:00:00' and '$fecha_final 23:59:59'
            GROUP BY p.total_pago,p.caja_id, p.consulta_id,p.monto_seguro,p.tipo_pago, u.name
            ORDER BY p.id DESC";

        // $sql = "SELECT p.total_pago as suma_total,p.caja_id, p.consulta_id,p.monto_seguro,p.tipo_pago, u.name as Paciente, u.seguro_afiliado
        // from pagos p
        // inner join consultas c on (p.consulta_id = c.id)
        // inner join users u on (u.id = c.user_id) 
        // where true
        //     and p.authLogin in (select u.id from users where u.authLogin = $user_id)
        //     and u.id = p.authLogin
        //     and p.created_at between '$fecha_inicio 00:00:00' and '$fecha_final 23:59:59'
        //     GROUP BY p.total_pago,p.caja_id, p.consulta_id,p.monto_seguro,p.tipo_pago, u.name
        //     ORDER BY p.id DESC";


        $busqueda = DB::select($sql);
        return $busqueda;
        
        

    }

    public function buscarcxc(Request $request)
    {

        // return $request->all();

        $user_id = auth()->user()->id;
        $fecha_inicio = $request->input('fec_inicio');
        $fecha_final = $request->input('fec_final');
        
        $sql = "SELECT p.id, p.total_pago as suma_total,p.caja_id, p.consulta_id,p.monto_seguro,p.tipo_pago, u.name as Paciente, u.seguro_afiliado,u.seguro_plan, a.nombre as aseguradora
        from pagos p
        inner join consultas c on (p.consulta_id = c.id)
        inner join users u on (u.id = c.user_id) 
        inner join aseguradoras a on (a.id = u.aseguradora_id)
        where true
            and p.authLogin in (select id from users where authLogin = $user_id)
            and p.created_at between '$fecha_inicio 00:00:00' and '$fecha_final 23:59:59'
            and p.monto_seguro >= 1
            and p.estatus = 0
            GROUP BY p.id, p.total_pago,p.caja_id, p.consulta_id,p.monto_seguro,p.tipo_pago, u.name,u.seguro_afiliado,u.seguro_plan, a.nombre
            ORDER BY p.id desc";

        $busqueda = DB::select($sql);
        return $busqueda; 

    }

    public function actualizarPago(Request $request, $id)
    {
        $result = pagos::findOrFail($id);
        return $result->update($request->all());
    }
}
