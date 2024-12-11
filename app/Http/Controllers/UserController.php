<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

	//muestra una vista
	public function index(Request $request) {
		$users = User::get();
		if (!$request->ajax()) {
			return view();
		}
		//Se pone 200 como status code porque la respuesta es resultado de una busqueda
		return response()->json(['users' => $users], 200);
	}

	//Muestra una vista
	public function create()
	{
		//
	}

	// Recibe un requets y lo almacena en la db
	//Cuando se coloca un Request personalizado, lo que hace Laravel es primero envia el objeto de $request a nuestro Request para verificar que dicho objeto cumple con las reglas definidas, si cumple se ejecuta la funcion sin ningun problema
	//Pero en caso de que no se cumplan las reglas, se devuelve un status code 422 que indica que el servidor no pudo procesar una solicitud porque los datos que contiene no son válidos.
	public function store(UserRequest $request)
	{
		//Manera larga de hacerlo, tocaria pasar cada dato para crear una nueva instancia
		// User::create(['number_id' => $request->number_id]);

		//Manera mas sencilla de realizar un registro
		$user = new User($request->all());
		$user->save();
		//Se comprueba si es una vista o no
		//Si no es ajax quire decir que viene de una vista el $request de una manera tradicional, es decir que si viene con ajax la respuesta no sería un recargue de la pagina anterior con un mensaje, si no simplemente se notificaria con un status code
		if (!$request->ajax()) {
			//Retorna a la vista con el mensaje
			return back()->with('success', 'User created');
		}
		//Cuando es una creacion se debe devolver el status code 201
		// El código de estado HTTP 201, también conocido como "Creado", indica que una solicitud se realizó correctamente y se creó un nuevo recurso
		return response()->json(['status' => 'User created', 'user' => $user], 201);
	}


	public function show(Request $request, User $user)
	{
		if (!$request->ajax()) {
			return view();
		}
		return response()->json(['user' => $user], 200);
	}


	public function edit($id)
	{
		//
	}

	//Como se observa, como segundo parametro se pasa el $id, para buscar el usuario a actualizar
	public function update2(UserRequest $request, $id)
	{
		//Se pasa a la variable la consulta realizada
		$user = User::find($id);
		//Se le asigna el request a la variable
		$user->update($request->all());
		//Se comprueba si el usuario existe
		if ($user) {
			return abort(404);
		}
	}

	//Pero para evitarnos realizar la consulta podemos pasarle todo el usuario, y comprueba de paso si el usuario existe, en caso de que no, Laravel automaticamente devuelve un 404
	public function update(UserRequest $request, User $user)
	{
		$user->update($request->all());
		if (!$request->ajax()) {
			return back()->with('success', 'User updated');
		}
		//El status code 204 es una respuesta exitosa pero sin cuerpo, es decir no se incluira el usuario y sus propiedades en la respuesta, aun que se deje dentro del json
		//Por el cual se deja el json vacío
		return response()->json([], 204);
	}


	public function destroy(Request $request, User $user)
	{
		$user->delete();
		if (!$request->ajax()) {
			return back()->with('success', 'User deleted');
		}
		return response()->json([], 204);
	}
}
