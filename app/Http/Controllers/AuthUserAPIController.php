<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\AuthRequest;

class AuthUserAPIController extends Controller
{
	public function login(AuthRequest $request)
	{
		//La función first() lo que hace es traer el primer elemento que coincida con la busqueda
		$user = User::where('email', $request->email)->first();
		//Se le pasa un método (handlerMessage) para generar mensajes, y no estarlos creando por cada metodo nuevo, que se requiera un mensaje
		if (!$user) return response()->json($this->handlerMessage(401), 401);
		//A través de Hash::check() se puede verificar o comparar la contraseña que esta encirptada en la db y la contraseña que ingreso el usuario, el cual Hash desencripta y compara las contraseñas.
		if (!Hash::check($request->password, $user->password)) {
			return response()->json($this->handlerMessage(401), 401);
		};
		//La función createToken se trae del modelo User, y dentro del modelo se trae a tráves de la propiedad HasApiToken
		//Como parametro se le pone el nombre del token, y despues se vuelve a texto plano el token
		$token = $user->createToken('auth_token')->plainTextToken;
		$data = ['access_token' => $token];
		return response()->json($this->handlerMessage(200, $data), 200);
	}

	public function logout()
	{
		//A traves de este mensaje, se le dice a laravel que el modelo al que pertenece la variable $user es al modelo User, si no pensará que hace referencia a Auth, y nos arrojara un error al eliminar el token

		/** @var \App\Models\User\User $user */
		$user = Auth::user();
		//Elimina todos los tokens que tenga el usuario
		$user->tokens()->delete();
		return response()->json([], 204);
	}

	public function profile()
	{
		return response()->json(['auth_user'=>Auth::user()], 200);
	}

	//La data es opcional, por eso esta en null por defecto
	private function handlerMessage($code, $data = null)
	{
		switch ($code) {
			case '401':
				return ['login' => false, 'message' => 'Password or email not valid'];

			default:
				return ['login' => true, 'message' => 'Login succesful', 'data' => $data];
		}
	}
}
