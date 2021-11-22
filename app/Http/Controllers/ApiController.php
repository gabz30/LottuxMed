<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

use App\Exports\GastosExport;

use App\Models\aseguradoras;
use App\Models\Calendario;
use App\Models\User;
use App\Models\Consultas;
use App\Models\citasPendientes;


class ApiController extends Controller
{

    public function pacientes()
    {

        return User::where('tipo_usuario_id', '=', 4)
            ->orderBy("id", "desc")
            ->get();
    }
    public function doctores()
    {
        return User::select(['id', 'name', 'email', 'telefono', 'clinica_id'])
            ->where('tipo_usuario_id', '=', 2)
            ->where('estatus', '=', 1)
            ->orderBy("id", "desc")
            ->with('clinica:id,nombre')
            ->get();
            
            //

    }

    public function pacientesStore(Request $request)
    {
        // $pacientes = User::create($request->all());

        $pacientes = User::create([
            'tipo_usuario_id' => $request->input('tipo_usuario_id'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'celular' => $request->input('celular'),
            'cedula' => $request->input('cedula'),
            'estatus' => 1,
            'PolSec' => $request->input('PolSec'),
        ]);



        if (!empty($pacientes)) {
            return [
                // 'request' => $request->all(),
                'data' => $pacientes,
                'msg' => 'Paciente registrado con exito!',
                'code' => '200',
            ];
        } else {

            return [
                'msg' => 'Error al crear el pacinete',
                'code' => '404',
            ];
        }
    }

    public function Showpaciente($id)
    {
        return User::where('id', '=', $id)
                    ->with(['consultas' => function($query){
                        return $query->orderBy('id','desc');
                    }])->get();
    }

    public function PacienteUpdate(Request $request, $id)
    {
        $user = User::find($id);

        $rules = [
            "name" => "required",
            "email" => "required",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $r = $user->update($request->all());

        if ($r == 1) {
            return [
                'msg' => 'Actualizado correctamente!',
                'code' => '200',
                'data' => $user
            ];
        } else {
            return [
                'msg' => 'Error al actualizar',
                'code' => '404',
            ];
        }
    }

    public function historialClinico($id)
    {

        $consulta = Consultas::with('user:id,name,sexo', 'estudiosRealizados', 'extraConsulta')
            ->where('user_id', '=', $id)
            ->orderBy("id", "desc")
            ->get();

        $variable = [];

        foreach ($consulta as $item) {
            foreach ($item->estudiosRealizados as $estudios) {
                $variable[] = $estudios->estudiosInterconsulta;
            }
        }



        return response()->json($consulta);
    }

    public function login(Request $request)
    {


        // $encriptada = Crypt::encryptString($request->input('email'), );
        // $desencriptada = Crypt::decryptString($encriptada);

        // return [
        //     'original' => $request->input('email'),
        //     'encriptada ' => $encriptada,
        //     'desencriptada ' => $desencriptada,
        // ];



        $user = User::where('email', 'like', '%' . $request->input('email') . '%')
            ->select("id", "name", "password", "tipo_usuario_id")
            ->first();


        if (!empty($user)) {

            $hashedPassword = $user->password;
            $verify = Hash::check($request->input('password'), $hashedPassword);

            // return [
            //     'original' => $request->input('password'),
            //     'hashed' => $hashedPassword,
            // ];   

            if ($verify) {
                return [
                    // 'request' => $request->all(),
                    'data' => $user,
                    'msg' => 'Usuario logueado correctamente.',
                    'code' => '200',
                ];
            } else {

                return [
                    // 'request' => $request->all(),
                    // 'data' => $user,
                    'msg' => 'Email o contraseña incorrecta.',
                    'code' => '404',
                ];
            }
        } else {
            return [
                // 'request' => $request->all(),
                // 'data' => $user,
                'msg' => 'Email o contraseña incorrecta.',
                'code' => '404',
            ];
        }

        // if( !$user->isEmpty() )
        // {
        //     return [
        //         'request' => Hash::make($request->input('email')),
        //         'data' => $user,
        //         'msg' => 'Usuario logueado correctamente.',
        //         'code' => '200'

        //     ];

        // }else{

        //     return [
        //         'request' =>$request->all(),
        //         'data' => $user,
        //         'msg' => 'Email o contraseña incorrecta.',
        //         'code' => '404'

        //     ];
        // }
    }

    public function calendarioGET(Request $request, $id)
    {
        $start = $request->input('fecha_inicio');
        $end = $request->input('fecha_final');
        return Calendario::where('doctor_id', '=', $id)
            ->whereBetween('start', [$start, $end])
            ->get();
    }

    public function calendarioPaciente($id)
    {

        // $cita = Calendario::where('user_id', '=', $id)->get();

        $cita = Calendario::
            with('Doctor:id,name')
            ->where('user_id', '=', $id)
            ->orderBy('id','desc')
            ->get();
            
            //with('Doctor:id,name')

        if (count($cita) > 0) {
            return $cita;
        } else {
            return [
                'msg' => 'No existen citas para este usuario.',
                'code' => '404'
            ];
        }
    }

    public function calendarioPOST(Request $request)
    {


        $rules = [
            "doctor_id" => 'required',
            "user_id" =>  'required',
            "title" =>  '',
            "description" =>  '',
            "start" =>  'required',
            "end" =>  '',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        } else {

            $data = citasPendientes::create(
                [
                    "doctor_id" => $request->input('doctor_id'),
                    "user_id" => $request->input('user_id'),
                    "title" => $request->input('title'),
                    "description" => $request->input('description'),
                    // "color" => "#41A6E4",
                    "start" => $request->input('start'),
                    "estatus" => 1,
                ]
            );

            if (!empty($data)) {

                return [
                    'msg' => 'Cita creada con exito!',
                    'code' => '200',
                    'data' => $data
                ];
            } else {

                return [
                    'msg' => 'Error al crear la cita!',
                    'code' => '404',
                ];
            }
        }
    }

    public function consultasEmergencia($tipo, $doctor)
    {
        // /consultas/t{tipo}/{doctor}
        $consultas = Consultas::with('Paciente:id,name')
            ->where('drID', '=', $doctor)
            ->where('tipo_consulta_id', '=', $tipo)
            ->orderBy('id', 'desc')
            ->get();

        if (!$consultas->isEmpty()) {
            return [
                'msg' => 'Consulta exitosa!',
                'code' => '200',
                'data' => $consultas,
            ];
        } else {
            return [
                'msg' => 'No hay informacion.',
                'code' => '404',
                'data' => $consultas,
            ];
        }
    }

    public function aseguradoras()
    {
        return aseguradoras::orderBy('nombre', 'asc')->get();
    }

    public function newConsulta(Request $request)
    {

        $data = Consultas::create($request->all());

        if (!empty($data)) {
            return [
                'msg' => 'Registro exitoso!',
                'code' => '200',
                'data' => $data,
            ];
        } else {
            return [
                'msg' => 'Error al guardar!',
                'code' => '404',
            ];
        }
    }
}
