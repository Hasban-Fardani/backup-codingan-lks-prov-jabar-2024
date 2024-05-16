<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        // login user
        $user = auth('user')->attempt($validator->validated());
        // login admin
        $admin = auth('administrator')->attempt($validator->validated());
        if (!$user && !$admin) {
            return response()->json([
                "status"=> "invalid",
                "message"=>"Wrong username or password"
            ], 401);
        }

        if ($user) {
            $token = auth('user')->user()->createToken('accessToken', ['user'])->plainTextToken;
        } else {
            $token = auth('administrator')->user()->createToken('accessToken', ['admin'])->plainTextToken;
        }

        return response()->json([
            'status' => 'success',
            'token' => $token
        ]);

    }

    public  function signout() {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public  function sigup(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username|min:4|max:60',
            'password' => 'required|min:5|max: 10'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Request body is not valid',
                'violations' => $validator->errors()
            ], 400);
        }

        $user = User::create($validator->validated());
        $token = $user->createToken('accessToken')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'token' => $token
        ], 201);
    }
}
