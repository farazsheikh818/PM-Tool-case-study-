<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiTokenLoginRequest;
use App\Http\Requests\ApiTokenRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Cookie;

class ApiTokenController extends Controller
{
    public function register(Request $request)
    {
        if(!$request->ajax()){
            $roles=Role::all();
            return view('register', compact('roles'));
        }
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (User::where('email', $request->email)->exists()) {
            return response()->json(['success'=>false,'error' => "User already register"], 409);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $user->assignRole($request->roles);
        $token = $user->createToken("Personal Access Token");

        // Abilities
        //$token = $user->createToken($request->token_name, ['repo:view', 'repo:create']);

        return [
            'success'=>true,
            'token' => $token->plainTextToken,
            'user' => $user
        ];
    }

    public function login_index(Request $request){
        if(!$request->ajax()){
            return view('login');
        }
    }
    public function login(ApiTokenLoginRequest $request)
    {
      
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['success'=>false,'error' => "Invalid credentials"], 401);
        }

        $user->tokens()->where('name', "Personal Access Token")->delete();

        $token = $user->createToken("Personal Access Token");
        // Abilities
        //$token = $user->createToken($request->token_name, ['repo:view']);
              $token_key=explode("|",$token->plainTextToken);
              $token_key=(isset($token_key[1])) ? $token_key[1]  :$token->plainTextToken;
              
              
        return [
            'success' =>true,
            'token' => $token_key,
            'user' => $user
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response(null, 204);
    }
}
