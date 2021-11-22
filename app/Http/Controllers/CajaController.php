<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\caja;
use App\Models\pagos;
use App\Models\cierre_caja;

use Illuminate\Support\Facades\DB;

class CajaController extends Controller
{

    public function index()
    {
        $user_id = auth()->user()->id;

        // $sql = "SELECT id FROM cajas where user_id = $user_id and estatus = 1 order by id desc LIMIT 1";
        // $caja = DB::select($sql);

        $caja = caja::where('user_id','=', $user_id)
                        ->where('estatus','=', 1)
                        ->orderBy('id','desc')
                        ->take(1)
                        ->get();

        // return $caja;

        return view('contabilidad.caja', compact('caja'));
    }

    public function guardar(Request $request)
    {
        return caja::create($request->all());
    }

    public function lista()
    {   
        $user_id = auth()->user()->id;

          

        // $sql = "SELECT * FROM cajas where user_id = $user_id and estatus = 1 order by id desc LIMIT 1";
        // $cajas = DB::select($sql);



        return caja::where('user_id','=',$user_id)
        ->orderBy('id','desc')
        ->get();

    }

    public function ShowcierreCaja()
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

        $sql = "select 
                sum(total_pago) as suma_total 
                from pagos 
                where true
                and authLogin = $user_id and caja_id = $caja_id";

        $suma_total = DB::select($sql);


        $sql = "select 
                    sum(total_pago) as suma_efectivo 
                from pagos 
                where true
                    and tipo_pago = 1 
                    and authLogin = $user_id and caja_id = $caja_id";

        $suma_efectivo = DB::select($sql);

        $sql = "select 
                    sum(total_pago) as suma_tarjeta 
                from pagos 
                where true
                    and tipo_pago = 2 
                    and authLogin = $user_id and caja_id = $caja_id";

        $suma_tarjeta = DB::select($sql);


        $sql = "select 
                    sum(monto_seguro) as suma_seguro 
                from pagos 
                where true
                    and authLogin = $user_id and caja_id = $caja_id";

        $suma_seguro = DB::select($sql);


        $sql = "select monto_apertura as apertura_caja
                FROM cajas
                WHERE user_id = $user_id 
                        AND
                    estatus = 1
                ORDER BY id DESC
                LIMIT 1";
        $apertura_caja = DB::select($sql);


        $sql = "SELECT sum(monto) as gastos from gastos where caja_id = $caja_id and user_id = $user_id";

        $gastos = DB::select($sql);



        // return $gastos;

        return [
            'suma_total' => $suma_total,
            'suma_efectivo' => $suma_efectivo,
            'suma_tarjeta' => $suma_tarjeta,
            'apertura_caja' => $apertura_caja,
            'gastos' => $gastos,
            'suma_seguro' => $suma_seguro,
            'status' => 'success'
            
        ];

        // return $suma;

        // return 


        // $sql = 'SELECT * FROM pagos';
        // $products = DB::select($sql);
        // return $products;

        // return pagos::all();
    }

    public function update(Request $request, $id)
    {

        $cajas = caja::find($id);
        $cajas->update($request->all());
        return $cajas;
    }

    public function store(Request $request) // Store para el cierre de caja.
    {
        // return $request->all();
        return cierre_caja::create($request->all());
    }

    public function listaCierre(Request $request)
    {
        $user_id = auth()->user()->id;
        $fecha_inicio = $request->input('fec_inicio');
        $fecha_final = $request->input('fec_final');

        $sql = "SELECT cc.caja_id,cc.total_pagos,cc.efectivo,cc.tarjeta,cc.cubierto_seguro,cc.apertura_caja,cc.gastos,cc.total_caja, u.id, u.name as Secretaria
                from cierre_caja cc
                    inner join cajas c on (c.id = cc.caja_id)
                    inner join users u on (u.id = c.user_id)
                where true
                    and u.authLogin = $user_id
                    and cc.created_at between '$fecha_inicio 00:00:00' and '$fecha_final 23:59:59'
                    GROUP BY cc.caja_id,cc.total_pagos,cc.efectivo,cc.tarjeta,cc.cubierto_seguro,cc.apertura_caja,cc.gastos,cc.total_caja,u.id, u.name
                    ORDER BY cc.id desc";

        $busqueda = DB::select($sql);
        return $busqueda; 

    }



}
