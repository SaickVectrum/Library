<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserRequest;

class UserController extends Controller
{
	public function index(Request $request)
	{
		$users = User::get();
		if (!$request->ajax()) return back()->with('success', 'User created');
		return response()->json(['users' => $users], 200);
	}

	public function create()
	{
		// view
	}

	public function store(UserRequest $request)
	{
		$user = new User($request->all());
		$user->save();
		if (!$request->ajax()) return back()->with('success', 'User created');
		return response()->json(['status' => 'User created', 'user' => $user], 201);
	}

	public function show(Request $request, User $user)
	{
		if (!$request->ajax()) return view();
		return response()->json(['user' => $user], 200);
	}

	public function edit($id)
	{
		//
	}

	public function update(UserRequest $request,User $user)
	{
		$user->update($request->all());
		if (!$request->ajax()) return back()->with('success', 'User created');
		return response()->json([], 204);
	}

	/**Otra forma de hacer una actualización */
	// public function update(UserRequest $request,$id)
	// {
	// 	$user = User::find($id);
	// 	$user->update($request->all());
	// }

	//Como no se trae nada, se utiliza el request normal
	public function destroy(Request $request,User $user)
	{
		$user->delete();
		if (!$request->ajax()) return back()->with('success', 'User deleted');
		return response()->json([], 204);
	}
}
