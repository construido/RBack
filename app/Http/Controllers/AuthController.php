<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

use Exception;

class AuthController extends Controller
{
    public function __construnct(){
        $this->middleware('jwt.verify', ['except' => ['authenticate']]);
    }

    public function authenticate(Request $request){
        $credential = $request->only('Usuario', 'password');

        try{
            if(!$token = JWTAuth::attempt($credential)){
                return response(null, 401);
            }

            return \response()->json([
                'status'    => true,
                'token'     => \compact('token'),
                'data'      => JWTAuth::user(),
                'message'   => 'Credenciales válidos'
            ]);

        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function logout(){
        Auth::logout();
        return \response()->json([
            'status' => true,
            'message' => 'Successfully logged out'
        ]);
    }
}
