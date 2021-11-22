<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallePagos extends Model
{
    use HasFactory;

    protected $fillable = [
        'noPago',
        'interconsulta_id',
        'importe',
        'estatus',
        'consulta',
    ];
}
