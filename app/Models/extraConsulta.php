<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class extraConsulta extends Model
{
    use HasFactory;

    protected $table = "extra_consultas";

    protected $fillable = [
        'exploracion_fisica',
        'estudios_lab',
        'consulta_id'
    ];

}
