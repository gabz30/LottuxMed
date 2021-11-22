<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gastos extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'caja_id',
        'monto',
        'concepto',
        'comentario'
    ];
}
