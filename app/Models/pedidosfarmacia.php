<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user;
use App\Models\aseguradoras;
use App\Models\Consultas;
// use App\Models\recetas;

class pedidosfarmacia extends Model
{
    use HasFactory;

    protected $table = 'pedidosfarmacia';

    protected $fillable = [
        'farmacia_id',
        'paciente_id',
        'drID',
        'consulta_id',
        'estatus'
    ];

    public function doctor()
    {
        return $this->belongsTo(user::class, 'drID');
    }
    public function paciente()
    {
        return $this->belongsTo(user::class, 'paciente_id');
    }

    public function aseguradora()
    {
        return $this->belongsTo(aseguradoras::class, 'aseguradora_id');
    }

    // public function recetas()
    // {
    //     return $this->belongsTo(recetas::class, 'consulta_id');
    // }
    // public function consulta()
    // {
    //     return $this->belongsTo(Consultas::class, 'consulta_id');

    // }
}
