<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ciudades;

class clinicas extends Model
{
    use HasFactory;

    protected $table = 'clinicas';

    protected $fillable = [
        'ciudad_id',
        'nombre',
        'direccion',
    ];

    public function ciudad()
    {
        return $this->belongsTo(ciudades::class,'ciudad_id');
    }
}
