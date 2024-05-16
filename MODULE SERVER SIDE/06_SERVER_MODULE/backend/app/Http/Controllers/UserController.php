<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        return response()->json([
            "totalElements" => User::count(),
            "content" => User::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username|min:4|max:60',
            'password' => 'required|min:5|max: 10'
        ]);

        if ($validator->errors()->has('username')) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'Username already exists'
            ], 400);
        }

        $user = User::create($validator->validated());
        return response()->json([
            'status' => 'success',
            'username' => $user->username
        ], 201);
    }

    public function update(Request $request,User $user) {
        $rules = [
            'username' => 'required|unique:users,username|min:4|max:60',
            'password' => 'required|min:5|max: 10'
        ];

        if ($request->input('username') == $user->username) {
            $rules['username'] = 'required|min:4|max:60';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->errors()->has('username')) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'Username already exists'
            ], 400);
        }

        $user->update($validator->validated());
        return response()->json([
            'status' => 'succes'
        ]);
    }

    public  function show(User $user)
    {
        return response()->json($user->load('authoredGames', 'highscores'));
    }
    public function destroy(User $user){
        $user->authoredGames()->delete();
        $user->highScores()->delete();
        $user->delete();
        return response(status: 204);
    }
}
