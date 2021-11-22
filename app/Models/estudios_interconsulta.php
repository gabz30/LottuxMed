<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estudios_interconsulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'descripcion',
        'precio',
        'estatus'
    ];

    public function estudiosRealizados()
    {
        return $this->hasMany(estudiosRealizados::class);
    }

}
