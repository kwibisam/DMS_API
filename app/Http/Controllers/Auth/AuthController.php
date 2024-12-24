<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function register (Request $request) {
        $validator = Validator::make($request->all(),[
            "name" => "required|string|max:255",
            "email" => "required|email",
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "validation failed",
                "fail_msg" => $validator->messages()
            ],422);
        }

        try {
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password
            ]);

            $token = $user->createToken($request->name);

            return response()->json([
                "message" => "user created successfully",
                "token" => $token->plainTextToken,
                "data" => $user], 201);

        } catch (\Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());
            return response()->json(["message" => "error failed to create user"],500);
        }
       
    }

    function login (Request $request) {
        Log::info($request);

        try {
            $validator = Validator::make($request->all(),[
                "email" => "required",
                "password" => "required"
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    "message" => "validation failed",
                    "fail_msg" => $validator->messages()
                ],422);
            }
            
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(["message" => "username or password incorrect"],400);
            }

            $token = $user->createToken($user->name);
            return response()->json(["message" => "login success", "token" => $token->plainTextToken, "data" => $user]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(["message" => "something went wrong",],500);
        }
    }

    function logout (Request $request) {
        $request->user()->tokens()->delete();
        return ["message" => "you are logged out"];
    }

    function index () {
        $users = User::get();
        return response()->json(['data' => $users], 200);
    }
}
