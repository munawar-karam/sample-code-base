<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Models\User;

class SignupController extends Controller
{
    public function user_signup(SignupRequest $request)
    {
        $response = ['error' => true, 'detail' => ['message' => 'Can\'t sign you up right now, please try again.']];

        $user = User::create_new_user($request->all());

        if ($user != null) {
            $response['error'] = false;
            $response['detail']['message'] = 'Account created successfully';
        }

        return response()->json($response);
    }
}
