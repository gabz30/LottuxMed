<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cierre_caja extends Model
{

    
    use HasFactory;

    protected $table = 'cierre_caja';

    protected $fillable = [
        'caja_id',
        'total_pagos',
        'efectivo',
        'tarjeta',
        'apertura_caja',
        'cubierto_seguro',
        'gastos',
        'total_caja',
    ];
}
