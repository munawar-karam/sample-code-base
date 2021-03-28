<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/signup','App\Http\Controllers\SignupController@user_signup');
Route::post('/login','App\Http\Controllers\LoginController@user_login');
Route::post('/forget_password','App\Http\Controllers\PasswordResetController@generate_link');
Route::get('/reset_password/{token}','App\Http\Controllers\PasswordResetController@reset_password');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', 'App\Http\Controllers\LogoutController@user_logout');
}) ;


