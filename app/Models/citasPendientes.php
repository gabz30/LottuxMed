<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class citasPendientes extends Model
{
    use HasFactory;

    protected $table = 'citas_pendientes';

    protected $fillable = [
        'user_id',
        'doctor_id',
        'title',
        'description',
        'start',
        'estatus',
    ];

    

    public function Paciente()
    {
        
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
