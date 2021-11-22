<?php

namespace App\Http\Controllers;

use App\Models\recetas;
use App\Models\ciudades;
use App\Models\User;
use App\Models\clinicas;
use App\Models\especialidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin()
    {
        return view('admin.index');
    }
    public function reportesConsultasView()
    {
        return view('admin.consultas');
    }

    public function clinicas()
    {
        return view('admin.clinicas');
    }

    public function ciudades()
    {
        return view('admin.ciudades');
    }
    public function ciudadesGET()
    {
        return ciudades::all();
    }
    public function especialidadGET()
    {
        return especialidades::orderBy('nombre', 'asc')->get();
    }

    public function ciudadesPOST(Request $request)
    {
        return ciudades::create($request->all());
    }
    public function clinicasGET()
    {
        return clinicas::with('ciudad:id,nombre')
            ->get();
    }

    public function clinicasShow($id)
    {
        return clinicas::where('ciudad_id', '=', $id)
            ->orderBy('nombre', 'asc')
            ->get();
    }
    public function clinicasPOST(Request $request)
    {
        return clinicas::create($request->all());
    }
    public function registrarDoctor(Request $request)
    {

        return User::create([
            'authLogin' => auth()->user()->id,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'celular' => $request->input('celular'),
            'telefono' => $request->input('telefono'),
            'cedula' => $request->input('cedula'),
            'direccion' => $request->input('direccion'),
            'salario' => $request->input('salario'),
            'tipo_usuario_id' => $request->input('tipo_usuario_id'),
            'clinica_id' => $request->input('clinica_id'),
            'sexo' => $request->input('sexo'),
            'estatus' => $request->input('estatus'),
            'password' => Hash::make($request->input('password')),
        ]);
    }
    public function listaDoctores()
    {
        // return 'hola';
        return User::with('clinica:id,nombre')
            ->where('tipo_usuario_id', '=', 2)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function listaDoctoresParametros(Request $request)
    {
        $clinica = $request->input('clinica');

        return User::where('tipo_usuario_id','=', 2)
                        ->where('clinica_id','=', $clinica)
                        ->get();
    }
    public function reportesMedicamentos(Request $request)
    {
        $fecha_inicio = $request->input('fec_inicio');
        $fecha_final = $request->input('fec_final');
        $ciudad = $request->input('ciudad');
        $clinica = $request->input('clinica');
        $especialidad = $request->input('especialidad');
        $drID = $request->input('drID');
        $sexo = $request->input('sexo');
        $joinEspecialidades = "";
        
        $line = " r.created_at BETWEEN '$fecha_inicio 00:00:00' AND '$fecha_final 12:59:59' ";

        if ($ciudad > 0) {

            $line .= " AND ciu.id = '$ciudad' "; // Si en el parametro de la busqueda ingresaron la ciudad, agrega esta linea al SQL

            if ($clinica > 0) {
                $line .= " AND cli.id = $clinica "; // Si en el parametro de la busqueda ingresaron la clinica, agrega esta linea al SQL
            }
        }

        if ($especialidad > 0) {
            $line .= " AND e.especialidad_id = $especialidad ";
            $joinEspecialidades = " INNER JOIN especialidades_vs_users e ON (u.id = e.drID) ";
        }

        if ($drID > 0) {
            $line .= " AND u.id = $drID ";
        }

        if($sexo > 0){
            $line .= " AND paciente.sexo = $sexo ";
        }


        

        $sql = "SELECT COUNT(*) as cantidad, m.descripcion as medicamento
        FROM recetas r
        INNER JOIN medicamentos m on (m.id = r.medicamento_id)
        INNER JOIN consultas c ON (c.id = r.consulta_id)
        INNER JOIN users u ON (u.id = c.drID)
        INNER JOIN users paciente ON (paciente.id = c.user_id)
        $joinEspecialidades
        INNER JOIN clinicas cli ON (cli.id = u.clinica_id)
        INNER JOIN ciudades ciu ON (ciu.id = cli.ciudad_id)
        WHERE $line
        GROUP BY r.medicamento_id,m.descripcion
        ORDER BY cantidad desc";


        // SELECT COUNT(*) as cantidad, m.descripcion as medicamento
        // FROM recetas r
        // INNER JOIN medicamentos m on (m.id = r.medicamento_id)
        // INNER JOIN consultas c ON (c.id = r.consulta_id)
        // INNER JOIN users u ON (u.id = c.drID)
        // INNER JOIN clinicas cli ON (cli.id = u.clinica_id)
        // INNER JOIN ciudades ciu ON (ciu.id = cli.ciudad_id)
        // WHERE c.created_at BETWEEN '2021-01-01 00:00:00' and '2021-08-30 12:59:59' AND ciu.id = 2 AND 
        // GROUP BY r.medicamento_id,m.descripcion
        // ORDER BY cantidad desc


        // SELECT name FROM users WHERE YEAR(CURDATE())-YEAR(fecha_nacimiento) = 32 


        return DB::select($sql);
    }


    public function reportesConsultas(Request $request)
    {

        $fecha_inicio = $request->input('fec_inicio');
        $fecha_final = $request->input('fec_final');

        $sql = "SELECT COUNT(*) as cantidad, ciu.nombre
        FROM consultas c
        INNER JOIN users u ON (u.id = c.drID)
        INNER JOIN clinicas cli ON (cli.id = u.clinica_id)
        INNER JOIN ciudades ciu ON (ciu.id = cli.ciudad_id)
        WHERE c.created_at BETWEEN '$fecha_inicio 00:00:00' and '$fecha_final 12:59:59'
      	GROUP BY ciu.nombre
        ORDER BY cantidad DESC";

        // $sql = "SELECT COUNT(*) as cantidad, m.descripcion as medicamento
        // FROM recetas r
        // INNER JOIN medicamentos m on (m.id = r.medicamento_id)
        // WHERE r.created_at BETWEEN '$fecha_inicio 00:00:00' and '$fecha_final 12:59:59'
        // GROUP BY r.medicamento_id,m.descripcion
        // ORDER BY cantidad desc";

        return DB::select($sql);
    }
}
