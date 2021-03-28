<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function user_logout(Request $request)
    {
        $response = ['error' => true, 'detail' => ['message' => '']];

        $user = Auth::user();

        if($user) {
            $user->currentAccessToken()->delete();
            $response = ['error' => false, 'detail' => ['message' => 'User logged out successfully.']];
        }

        return response()->json($response);
    }
}
