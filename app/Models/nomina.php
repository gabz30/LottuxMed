<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nomina extends Model
{
    use HasFactory;

    protected $fillable = [
        'authLogin',
        'empleado_id',
        'monto',
        'estatus',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'empleado_id');
        // return $this->hasMany(User::class, 'empleado_id');
    }
}
