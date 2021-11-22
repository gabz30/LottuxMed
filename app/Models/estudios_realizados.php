<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estudios_realizados extends Model
{
    use HasFactory;

    protected $fillable = [
        'consulta_id',
        'interconsulta_id',
        'precio',
        
    ];

    public function Consultas()
    {
        return $this->hasMany(Consultas::class);
    }
  
    public function estudiosInterconsulta()
    {
        return $this->belongsTo(estudios_interconsulta::class, 'interconsulta_id');
    }

}
