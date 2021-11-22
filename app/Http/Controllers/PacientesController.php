<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\archivos;
use App\Models\Consultas;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pacientes = User::where('tipo_usuario_id', 4)->get();



        //$pacientes = User::all();
        // return view('pacientes.index', compact('pacientes'));


        return view('pacientes.index');
    }

    public function nuevoPaciente()
    {
        return view('pacientes.nuevo');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return User::all(); 

        return User::where('tipo_usuario_id', '=', 4)->get();
        // return view('pacientes.index', compact('pacientes'));
    }


    protected function historiaClinica($id)
    {   
        // $consulta = Consultas::find(22);
        // $doctor = $consulta->User->name;
        // // return $consulta->User->name;


        // $enfermedades = enfermedades::all();
        $files = archivos::where('paciente_id', '=', $id)
            ->orderBy('id', 'desc')
            ->get();
        return view('pacientes.historiaClinica', compact('id', 'files'));
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
        return User::create($request->all());

        // return antecedentes::create($request->all());

        // return antecedentes::create([
        //     'user_id' => $request->input("user_id"),
        //     'enfermedad' => $request->input("enfermedad"),
        //     'descripcion' => $request->input("descripcion"),
        //     'parentesco' => $request->input("parentesco")

        // ]);

        //return $request->all();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::with('aseguradora')
                    ->where('id','=', $id)
                    ->OrWhere('name', 'like', '%' . $id . '%')
                    ->OrWhere('email', 'like', '%' . $id . '%')
                    ->OrWhere('cedula', 'like', '%' . $id . '%')
                    ->where('tipo_usuario_id','=', 4)
                    ->get();

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
