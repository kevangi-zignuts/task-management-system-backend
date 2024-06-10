<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function resetPassword(Request $request, $token){
        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $tokenRecord = DB::table('password_reset_tokens')->where('token', $token)->first();

        if ($tokenRecord) {
            $user = User::where('email', $tokenRecord->email)->first();

            $password = Hash::make($request['password']);
            $user->update(['password' => $password]);

            Mail::to($tokenRecord->email)->send(new ResetPassword($user->first_name));

            // Delete the used token from the database
            DB::table('password_reset_tokens')->where('token', $token)->delete();

            return response()->json([
                'message' => 'Password Reset Successfully'
            ], 201);
        }
        return response()->json([
            'message' => 'token not found'
        ], 404);
    }
}
