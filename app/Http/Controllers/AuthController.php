<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $successStatus = 200;
    //
     /**
     * Registro de usuario
     */
    public function signUp(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'password_confirmation' => 'required|string' 
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors'=>$validator->errors()], 401);
        }

        $input = $request->all();

        if ($input['password'] != $input['password_confirmation']) {
            return response()->json([
                "message" => "The given data was invalid.",
                "errors" => [
                    "password_confirmation" => ["The password confirmation does not match."]
                ]
            ], 401);
        }

        $input['password'] = bcrypt($input['password']);
        if ($user = User::create($input)) {
            $token =  $user->createToken('MyApp')->accessToken;
            $success['user']['name'] =  $user->name;
            $success['user']['email'] =  $user->name;
            $success['user']['created_at'] =  $user->created_at;
            $success['user']['updated_at'] =  $user->updated_at;        
            return response()->json(["user" => $user, "token" => $token, "message" => "User signed successfully!"], 201);        
        } else {
            return response()->json(["message" => "User can´t be signed!"], 401);        
        }
    }

    public function login(Request $request)
    {
        // $loginData = $request->validate([
        //     'email' => 'email|required',
        //     'password' => 'required'
        // ]);

        // if (!auth()->attempt($loginData)) {
        //     return response(['message' => 'Invalid Credentials']);
        // }

        // $accessToken = auth()->user()->createToken('authToken')->accessToken;

        // return response(['user' => auth()->user(), 'token' => $accessToken, 'message' => 'Login successfully'], 200);

    
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $token =  $user->createToken('Password Token')-> accessToken; 
            $success['name'] = $user->name;
            $success['email'] = $user->email;
            return response()->json(['message' => 'Login successfully','user' => $success, 'token' => $token], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['message'=>'User unauthorized'], 401); 
        } 
    }

    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function user(Request $request) 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return $response;
    }
}
