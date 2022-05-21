<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\Person;

class RegisterController extends Controller
{
    /**
     * Register a person to access app.
     * 
     * @param App\Http\Requests\RegisterRequest
     * @return \Illuminate\Http\Response
     * */
    public function register(RegisterRequest $request)
    {
        $input = $request->only(['first_name', 'last_name', 'email', 'password']) ;
        $input['password'] = bcrypt($input['password']);
        $person = Person::create($input);
        $token =  $person->createToken('Auth Token')->accessToken;
   
        return response()->json([
            'success' => true,
            'message' => 'Successfully registered.',
            'token' => $token,
            'person' => $person
        ], 200);
   
    }

    /**
     * Login to the apps using email & password
     * 
     * @param App\Http\Requests\LoginRequest
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $token =  $user->createToken('Auth Token')->accessToken; 

            return response()->json([
                'success' => true,
                'message' => 'Successfully login.',
                'token' => $token,
                'person' => $user
            ], 200);
        } 
        
        return response()->error("Email or Password is not correct", 401);

    }

}
