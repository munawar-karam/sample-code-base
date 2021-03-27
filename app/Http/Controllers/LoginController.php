<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;

class LoginController extends Controller
{
    public function user_login(LoginRequest $request)
    {
        $response = ['error' => true, 'message' => 'Invalid email/password provided.'];

        $check_credentials = User::check_credentials($request->all());

        if($check_credentials) {
            $response = [
              'error' => false,
              'message' => 'Logged in successfully'
            ];
        }

        return response()->json($response);
    }
}
