<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class PasswordReset extends Model
{
    use HasFactory;

    public static function generate_reset_link($user)
    {
        $token = generate_unique_encrypted_id();
        $password_reset = new PasswordReset();
        $password_reset->encrypted_id = generate_unique_encrypted_id();
        $password_reset->token = $token;
        $password_reset->user_id = $user->id;
        $password_reset->is_used = 'no';
        $password_reset->save();

        //send the password reset link email
        Mail::to($user->email)->send(new \App\Mail\PasswordReset($user));

    }
}
