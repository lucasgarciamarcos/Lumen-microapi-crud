<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $this->validate($request, [
            'search' => 'nullable'
        ]);

        $users = User::where('email', 'LIKE', '%' . $request->search . '%')->get();
        return response()->json($users);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        if (User::find(['email' => $request->email])->count() > 0) {
            return response()->json(['error' => 'Email already in use'], 404);
        }

        $model = User::create([
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response()->json([
            'created' => true,
            'model'=> $model
        ], 201);
    }

    public function get(int $user_id)
    {
        $user = User::find($user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    public function delete(int $user_id)
    {
        $user = User::find($user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $deleted = $user->delete();

        if (!$deleted) {
            abort(404);
        }

        return response()->json(['deleted' => true], 204);
    }

    public function update(int $user_id, Request $request)
    {
        $user = User::find($user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->update($request->all());

        return response()->json([
            'updated' => true,
            'model'=> $user
        ], 201);
    }
}
