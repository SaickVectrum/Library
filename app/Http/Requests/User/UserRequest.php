<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	//Siempre debe estar en verdadero para que funcione
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		$rules = [
			'name' => ['required', 'string'],
			'last_name' => ['required', 'string'],
			'number_id' => ['required', 'numeric'],
			'email' => ['required', 'email'],
			// El min:8 siginifica que debe tener minimamente 8 caracteres
			'password' => ['confirmed', 'string', 'min:8']
		];

		if ($this->method() == 'POST') {
			//Lo que hace es agregar esa regla, al number_id, en el segundo parametro se establece la propiedad que es unique, luego se pone la tabla de la db donde va a buscar y luego en la propiedad que va a buscar en dicha tabla
			array_push($rules['number_id'], 'unique:users,number_id');
			//Para evitar errore esta parte "unique:users,email" debe estar asi pegado, ya que si se deja un espacio entre la coma y el nombre de la columna a buscar, Laravel identifica dicho espacio como parte del nombre de la Columna, es decir que si lo dejamos asi: 'unique:users, email', Laravel pensaria que el nombre de la columna a buscar es ' email'
			array_push($rules['email'], 'unique:users,email');
			//Se agrega la nueva regla de requerido a password
			array_push($rules['password'], 'required');
		} else {
			//Este es lo mismo que el anterior, solo que al number_id del segundo parametro se le pone una coma, la cual indica que se espera un id o un registro
			//Esto se hace para que en caso de que se este actualizando algun dato del usuario, y se envien los datos actualizados, el codigo busque que dicho number_id no este repetido con todos los demás usuarios, pero no lo comparara con nuestro propio usuario, de lo contrario saltaria el sistema
			array_push($rules['number_id'], 'unique:users,number_id,' . $this->user->id);
			array_push($rules['email'], 'unique:users,email,' . $this->user->id);
			array_push($rules['password'], 'nullable');
		}
		return $rules;
	}

	//Podemos personalizar los mensajes que muestre el sistema, en caso de que no se cumpla una regla, pero si no, por defecto laravel muestra unos mensajes, que se encuentran en la carpeta "lang"
	public function messages()
	{
		return [
			//Se puede hacer un mensaje por cada regla
			'name.required' => 'El nombre es requerido',
			'name.string' => 'El nombre debe ser valido',
		];
	}
}
