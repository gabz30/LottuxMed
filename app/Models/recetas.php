<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consultas;
use App\Models\medicamentos;

class recetas extends Model
{
    use HasFactory;

    protected $fillable = [
        'consulta_id',
        'user_id',
        'medicamento_id',
        'prescripcion',
    ];

    // public function consultas()
    // {
    //     return $this->hasMany(Consultas::class, 'consulta_id');
    // }

    public function medicamentos()
    {
        return $this->belongsTo(medicamentos::class, 'medicamento_id');
    }
}
