<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetLinkRequest;
use App\Http\Requests\UpdateResetPasswordRequest;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function generate_link(PasswordResetLinkRequest $request)
    {
        $response = ['error' => false, 'detail' => ['message' => 'Password reset email will be sent if user exists. Please check your email.']];

        $user = User::where('email', $request->email)->first();

        if(!empty($user)) {
            PasswordReset::generate_reset_link($user);
        }

        return response()->json($response);
    }


    public function reset_password(Request $request)
    {
        $response = ['error' => true, 'detail' => ['message' => 'Authentication failed.']];

        if (isset($request->token) && $request->token != null) {
            $token = PasswordReset::where(['token' => $request->token, 'is_used' => 'no'])->first();
            if($token) {
                if( Carbon::parse($token->created_at)->diffInMinutes(Carbon::now()->toDateTimeString()) < 60 ) {
                    return redirect(env('APP_URL').'/reset_password/'.$request->token);
                } else {
                    return response()->json(['error' => true, 'detail' => ['message' => 'Password reset link expired.']]);
                }
            }
        }

        return response()->json($response);
    }


    public function update_password(UpdateResetPasswordRequest $request)
    {
        $response = ['error' => true, 'detail' => ['message' => 'Password reset token expired.']];

        $token = PasswordReset::where(['token' => $request->token, 'is_used' => 'no'])->first();
        if($token) {
            if( Carbon::parse($token->created_at)->diffInMinutes(Carbon::now()->toDateTimeString()) < 60 ) {
                $user = User::where('id', $token->user_id)->first();
                $updated = PasswordReset::update_user_password($user->id, $request->password, $token->token);
                if($updated) {
                    return  response()->json(['error' => 'false', 'detail' => ['message' => 'Password updated successfully.']]);
                }
            }
        }

        return response()->json($response);
    }
}
