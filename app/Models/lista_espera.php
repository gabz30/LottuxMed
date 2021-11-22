<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class lista_espera extends Model
{
    use HasFactory;

    protected $table = 'lista_espera';


    protected $fillable = [
        'user_id',
        'drID',
        'estatus',

    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


}
