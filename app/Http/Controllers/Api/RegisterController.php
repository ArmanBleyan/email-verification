<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function register(Request $request) {   
        $validator = Validator::make($request->all(),

            [
                'name' => 'required|max:255|regex:/^[a-zA-ZÑñ\s]+$/',
                'email' => 'required|email|unique:users',
                'password' => 'required | confirmed | min:8',
                'password_confirmation' => 'required '
            ]

            );

        if ($validator->fails()){
            return response($validator->errors(), 200);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->save();

        
        $success = $user;
        $success['token'] =  $user->createToken('authToken')->accessToken;

        return response()->json($success, 200);

    }


    public function login(Request $request) {

        if(auth()->guard('user')->attempt(['email' => request('email'), 'password' => request('password')])){
                $login = $request->validate([
                    'email' => 'required|string',
                    'password' => 'required|string'
                ]);

    
                $user = User::find(auth()->guard('user')->user()->id);

                $user['token'] =  $user->createToken('authToken')->accessToken;

                return response()->json($user, 200);
    
            }else{ 
                return response()->json(['error' => ['Email and Password are Wrong.']], 200);
            }
    }

}