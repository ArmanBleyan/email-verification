<?php

use Illuminate\Http\Request;
use app\Http\Controllers\Api\RegisterController;
use app\Http\Controllers\Api\VerificationController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', 'App\Http\Controllers\Api\RegisterController@register');

Route::post('login', 'App\Http\Controllers\Api\RegisterController@login');

Route::get('/email/resend', 'App\Http\Controllers\Api\VerificationController@resend')->name('verification.resend')->middleware('auth:api');

Route::get('/email/verify/{id}/{hash}', 'App\Http\Controllers\Api\VerificationController@verify')->name('verification.verify');

Route::get('/verified-only', function(Request $request){

    dd('your are verified', $request->user()->name);
})->middleware('auth:api','verified');



