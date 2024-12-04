<?php

namespace App\Models;

use App\Models\Lend;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	//HasApiTokens se utiliza para que funcione el remember_token
	//HasFactory es para que sirva los factorys, al acceder al modelo
	//Notifiable es para darle notificaciones a los usuarios
	//SoftDeletes es para que se agregue y envie correctamente el softdeletes desde la migracion a la db.
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

	//Datos a guardar en la base de datos
	protected $fillable = [
		'number_id',
		'name',
		'last_name',
		'email',
		'password',
	];

	//Este appends agrega a atributos los accesores
	protected $appends = [
		'full_name'
	];

	// Estos datos no se incluyen en una consulta, es como una forma de seguridad
	protected $hidden = [
		'password',
		'remember_token',
	];


	//Los casts se utilizan cuando vamos a convertir un dato a otro tipo
	//Es decir que cambia la forma o formato de los datos, para utilizarlos o ya sea mostrarlos en pantalla
	protected $casts = [
		//datetime modifica el formato de la fecha, trayendose solo el Year, month and day, y dejando las hora y minutos de lado
		'created_at' => 'datetime:Y-m-d',
		'updated_at' => 'datetime:Y-m-d',
		//En caso de que hubiera un valor booleano en la db, aca se transformaria a palabras, ya que en la db php los guarda como 1 y 0
		// 'is_enable' => 'boolean' //0-1:true,false
	];

	//Accesores (get)
	//Se puede hacer accesores como uno quiera, ya sea acortar un texto, unir valores, etc.
	//Consulta:
	//User::query()->getFullNameAttribute()->get()
	//Esta consulta tendria que ser utilizada cada vez, para obtener el nuevo attribute, pero para evitar esto, se pasa el atributo a appends
	public function getFullNameAttribute()
	{
		return "{$this->name} {$this->last_name}"; //Victor Zea
	}



	//(new User($request->all()))->save(); -- Consulta

	//Mutador - Se ejecuta antes de enviarle datos a la base de datos
	//Su nombre siempre empieza por "set" seguido de la propiedad a modificar, y por ultimo la palabra "Attribute" para especificar que es un atributo
	//Recibe como parametro el valor que tenga password
	public function setPasswordAttribute($value)
	{
		//Se le asigna al atributo password la encriptación
		$this->attributes['password'] = bcrypt($value);
	}

	//Este al no venir en la consulta de los atributos, no es necesario ponerle un parametro a la función.
	public function setRememberTokenAttribute()
	{
		//Se le asigna al atributo password la encriptación
		$this->attributes['remember_token'] = Str::random(30);
	}

	public function customerLends(): HasMany
	{
		return $this->hasMany(Lend::class, 'customer_user_id', 'id');
	}

	public function ownerLends(): HasMany
	{
		return $this->hasMany(Lend::class, 'owner_user_id', 'id');
	}
}
