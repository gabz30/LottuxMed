<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class antecedente_personal extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'antecedentes',
        'alergias',
        'observaciones'
    ];
}
