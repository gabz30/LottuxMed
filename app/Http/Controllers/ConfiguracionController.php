<?php

namespace App\Http\Controllers;

use App\Models\estudios_interconsulta;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class ConfiguracionController extends Controller
{

    use RegistersUsers;


    public function index()
    {
        return view('configuracion.index');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function registrar(Request $request)
    {
        
        return User::create([
            'authLogin' => $request->input('authLogin'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'celular' => $request->input('celular'),
            'cedula' => $request->input('cedula'),
            'direccion' => $request->input('direccion'),
            'salario' => $request->input('salario'),
            'tipo_usuario_id' => $request->input('tipo_usuario_id'),
            'password' => Hash::make($request->input('password')),
        ]);
    }
    public function estatusEstudios(Request $request, $id)
    {

        $result = estudios_interconsulta::find($id);
        return $result->update($request->all());

    }


}
