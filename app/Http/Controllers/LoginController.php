<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;

class LoginController extends Controller
{
    public function user_login(LoginRequest $request)
    {
        $response = ['error' => true, 'detail' => ['message' => 'Invalid email/password provided.']];

        $check_credentials = User::check_credentials($request->all());

        if($check_credentials != false) {
            $response = [
                'error'     => false,
                'detail'    => [
                    'message'   => 'Logged in successfully',
                    'token'     => $check_credentials->createToken('login_token')->plainTextToken
                ]
            ];
        }

        return response()->json($response);
    }
}
