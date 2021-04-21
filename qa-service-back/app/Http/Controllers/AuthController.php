<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function register(Request $request){

        $validateData = $request->validate([
            'username' => 'required|unique:users|string|max:255',
            'password' => 'required|string|min:8'
        ]);

        $user = User::create([
            'username' => $validateData['username'],
            'password' => bcrypt($validateData['password'])
        ])->assignRole('participant');;

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'OK',
            'username' => $user->username,
            'roles' => $user->getRoleNames(),
            'access_token' => $token,
        ]);
    }

    //
    public function login(Request $request){

        if (!Auth::attempt($request->only('username', 'password'))){
            return response()->json([
                'message'=> 'Invalid login details'
            ], 401);
        }

        $user = User::where('username',$request['username'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'OK',
            'username' => $user->username,
            'roles' => $user->getRoleNames(),
            'access_token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
