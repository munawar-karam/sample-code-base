<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetLinkRequest;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function generate_link(PasswordResetLinkRequest $request)
    {
        $response = ['error' => true, 'message' => 'Invalid email/password provided.'];

        $user = User::where('email', $request->email)->first();

        if(!empty($user)){
            PasswordReset::generate_reset_link($user);
            $response['message'] = 'reset link is generated.';
            $response['error'] = false;
        }

        return response()->json($response);
    }

    public function reset_password(Request $request){

    }
}
