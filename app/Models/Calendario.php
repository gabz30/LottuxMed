<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Calendario extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'start',
        'end',
        'color',
        'description',
        'doctor_id',
        'estatus'
        // 'backgroundColor',
        // 'borderColor',


    ];

    public function Doctor()
    {
        return $this->hasMany(User::class, 'id', 'doctor_id');
    }


}
