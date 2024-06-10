<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
    *   This function is used to Login the user
    *   @method POST
    *   @route  / (public)
    *   @param \Illuminate\Http\Request $request
    *   @return \Illuminate\Http\Response
    */
    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'message' => 'Login Successfully',
                'token'   => $token,
            ], 201);
        }
        
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    /**
    *   This function is used to Store task Details
    *   @method POST
    *   @route  /register(protected)
    *   @middleware (auth:sanctum)
    *   @param \Illuminate\Http\Request $request
    *   @return \Illuminate\Http\Response
    */
    public function logout(){
        if (Auth::guard('api')->check()) {
            $user = Auth::user();
            $user->tokens()->delete();

            return response()->json([
                  'success' => true,
                  'message' => 'You have been logged out.',
            ], 200);
        }
        return response()->json([
              'error' => true,
              'message' => 'You are already logged out!!',
        ], 401);
    }
}
