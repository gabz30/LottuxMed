<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\aseguradoras;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo_usuario_id',
        'cedula',
        'celular',
        'telefono',
        'sexo',
        'fecha_nacimiento',
        'direccion',
        'estado_civil_id',
        'ocupacion_id',
        'grupo_sanguineo_id',
        'estatura',
        'seguro_afiliado',
        'seguro_plan',
        'aseguradora_id',
        'familiar_doctor',
        'image_path',
        'estatus',
        'authLogin',
        'salario',
        'farmacia_id',
        'PolSec'
    ];


    public function consultas()
    {
        return $this->hasMany(Consultas::class, 'user_id');
        // return $this->hasMany(consultas::class,'foreign_key');

    }
    


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function aseguradora()
    {
        return $this->belongsTo(aseguradoras::class, 'aseguradora_id');
 
    }

    public function clinica()
    {
        return $this->belongsTo(clinicas::class, 'clinica_id');
 
    }
}
