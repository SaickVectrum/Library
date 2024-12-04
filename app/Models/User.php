<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    //Datos a guardar en la base de datos
    protected $fillable = [
        'number_id',
		'name',
		'last_name',
        'email',
        'password',
    ];

    // Estos datos no se incluyen en una consulta, es como una forma de seguridad
    protected $hidden = [
        'password',
        'remember_token',
    ];


    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
