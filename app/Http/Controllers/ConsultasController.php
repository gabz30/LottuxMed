<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultas;

class ConsultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drID = auth()->User()->authLogin;
        // $DRid = auth()->User()->id;

        // $consultas = Consultas::with('Paciente:id,name,sexo','estudiosRealizados')
        // ->where('drID','=', $drID)
        // ->orderBy('id','desc')
        // ->paginate(2);

        $consultas = Consultas::where('tipo_consulta_id','=', 1)
                                        ->with('Paciente:id,name,sexo','estudiosRealizados')
                                        ->where('drID','=', $drID)
                                        ->orderBy('id','desc')
                                        ->paginate(2);
        
        // return $consultas;
        
        return view('consultas.todas', compact('consultas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showRecetas($id)
    {
        return Consultas::find($id)->recetas()->with('medicamentos')->get();
    }
    public function nuevaConsulta($id)
    {

        $drID = auth()->user()->id;
        return view('consultas.NuevaConsulta', compact('id','drID'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        return Consultas::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $consulta = Consultas::with('user:id,name,sexo','estudiosRealizados','extraConsulta')
        ->where('user_id', '=', $id)
        ->orderBy("id", "desc")
        ->paginate(5);
        // ->get();

        $variable = [];
        
        foreach($consulta as $item)
        {
            foreach($item->estudiosRealizados as $estudios)
            {
                $variable[] = $estudios->estudiosInterconsulta;
            }
        }


        // return $consulta;
       
        return response()->json($consulta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mostrar($id)
    {
      
        // $consulta = Consultas::with('Paciente:id,name,sexo','estudiosRealizados')
        $consulta = Consultas::with('Paciente:id,name,sexo')
        ->where('id', '=', $id)
        ->orderBy("id", "desc")
        ->get();

        $estudios = [];

        foreach($consulta as $item)
        {
             foreach($item->estudiosRealizados as $art)
             {
                $estudios[] = $art->estudiosInterconsulta;
             }
        }

        $consulta->estudios = $estudios;

        return $consulta;

     

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $consulta = Consultas::find($id);
        $consulta->update($request->all());
        return $consulta;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function consultas(Request $request)
    {
        $authLogin = auth()->user()->id;
        $fecha_inicio = $request->input('fec_inicio');
        $fecha_final = $request->input('fec_final');

   
        return Consultas::with('paciente:id,name')
                        ->where('created_at','>=', $fecha_inicio)
                        ->where('created_at','<=', $fecha_final)
                        ->where('drID','=', $authLogin)
                        ->get();
    }
}
