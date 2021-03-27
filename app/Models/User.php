<?php

namespace App\Models;

use App\Models\Models\Country;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function create_new_user($request)
    {
        $response = null;

        $country = Country::where('iso', $request['country'])->first();

        $user = self::create([
            'encrypted_id'      =>  generate_unique_encrypted_id(),
            'first_name'        =>  $request['first_name'],
            'last_name'         =>  $request['last_name'],
            'middle_name'       =>  @$request['middle_name'],
            'email'             =>  $request['email'],
            'dob'               =>  $request['dob'],
            'password'          =>  Hash::make($request['password']),
            'country_id'        =>  @$country['id'],
            'city'              =>  $request['city'],
            'address'           =>  $request['address'],
            'contact_number'    =>  $request['contact_number']
        ]);

        if($user) {
            $response = $user;
        }

        return $response;
    }
}
