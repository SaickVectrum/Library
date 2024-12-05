<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

	//muestra una vista
	public function index() {}

	//Muestra una vista
	public function create()
	{
		//
	}

	// Recibe un requets y lo almacena en la db
	public function store(Request $request)
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
		return response()->json(['status' => 'User created'], 201);
	}


	public function show($id)
	{
		//
	}


	public function edit($id)
	{
		//
	}

	public function update(Request $request, $id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}
}
