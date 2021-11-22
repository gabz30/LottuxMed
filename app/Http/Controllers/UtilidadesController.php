<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\enfermedades;
use App\Models\medicamentos;
use App\Models\recetas;
use App\Models\archivos;
use App\Models\User;


class UtilidadesController extends Controller
{

    
    public function perfiles()
    {
        return view('perfiles');
    }
    public function listaSecretarias()
    {   
        $doctor_id = auth()->user()->id;

        return User::where('authLogin','=', $doctor_id)
                    ->where('tipo_usuario_id','<>', 2)
                    ->orderBy('name', 'asc')
                    ->get();
    }
    public function allEnfermedades()
    {
        return enfermedades::orderBy('nombre', 'asc')->get();
    }
    public function saveEnfermedades(Request $request)
    {
        return enfermedades::create($request->all());
    }
    public function allMedicamentos()
    {
        return medicamentos::orderBy('descripcion', 'asc')->get();
    }

    public function saveMedicamentos(Request $request)
    {
        return medicamentos::create($request->all());
    }

    public function listaMedicamentos()
    {
        // return medicamentos::all();
        return medicamentos::orderBy('id','desc')->get();
    }

    public function saveRecetas(Request $request)
    {

        return recetas::create($request->all());
    }

    public function guardarArchivo(Request $request)
    {


        $path = $request->file('file')->store('public/archivos');

        $url = Storage::url($path);
        // $url = time() . '-' . $request->file('file')->getClientOriginalName();




        archivos::create([
            'url' => $url,
            'user_id' =>  auth()->user()->id,
            'paciente_id' => $request->input('paciente_id')

        ]);




        // $image = $request->file('file');
        // $imageName = $image->getClientOriginalName();
        // $image->move(storage_path('images'), $imageName);

    }
}
