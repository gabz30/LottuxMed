<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class farmacias extends Model
{
    use HasFactory;

    protected $table = 'farmacias';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',

    ];
}
