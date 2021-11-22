<?php

namespace App\Models;

use App\Http\Controllers\EstudiosRealizadosController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\recetas;
use App\Models\User;
use App\Models\estudios_realizados;
use App\Models\paciente;
use App\Models\estudios_interconsulta;
use App\Models\extraConsulta;
use Consulta;

class Consultas extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_sintomas',
        'sintomas',
        'user_id',
        'tipo_consulta_id',
        'drrefiere',
        'peso',
        'presion',
        'temperatura',
        'exploracion_fisica',
        'estudios_lab',
        'comentario',
        'drID',
        'estatus'
    ];

    public function recetas()
    {
        return $this->hasMany(recetas::class, 'consulta_id');
        
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'drID');
    }

    public function Paciente()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function estudiosRealizados()
    {
        return $this->hasMany(estudios_realizados::class,'consulta_id');
    }
    
    public function extraConsulta()
    {
        return $this->hasMany(extraConsulta::class,'consulta_id');
    }
    
   
    
}


