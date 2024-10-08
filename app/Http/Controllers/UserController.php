<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $validationRules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|string|max:255|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
    ];

    public function index()
    {
        $user = User::all();
        return response()->json($user);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules);

        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $request->validate($this->validationRules);

        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
