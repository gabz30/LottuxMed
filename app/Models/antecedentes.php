<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\enfermedades;

class antecedentes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'enfermedad_id',
        'parentesco',
    ];

    public function enfermedades()
    {
        return $this->belongsTo(enfermedades::class, 'enfermedad_id');
    }
}
