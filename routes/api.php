<?php

use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

//group como su nombre lo indica es para agrupar rutas que comparten el mismo prefijo
Route::group(['prefix' => 'users', 'controller' => UserController::class], function () {
	//El primer parametro es la ruta, y el segundo seria la función que le corresponde en el controlador (UserController)
	Route::get('/', 'index');
	Route::get('/{user}', 'show');
	Route::post('/', 'store');
	//El parametro que pasemos se debe llamar igual a como está en el controlador
	Route::put('/{user}', 'update');
	Route::delete('/{user}', 'destroy');
});
