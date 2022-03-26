<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class LoginController extends Controller
{
    //login
    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $token = $user->createToken('Token Name')->accessToken;

            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Invalid email or password'
            ]);
        }
    }
}
