<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pagos extends Model
{
    use HasFactory;

    protected $fillable = [
        'consulta_id',
        'caja_id',
        'authLogin',
        'total_pago',
        'monto_seguro',
        'tipo_pago',
        'estatus',
    ];
}
