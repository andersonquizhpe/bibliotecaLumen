<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Helper\ResponseBuilder;
use Illuminate\Support\Facades\Hash;
use ILLuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends BaseController
{
    public function login(Request $request){
        if($request->isJSon()){
            $username = $request->username;
            $password = $request->password;
            $user = User::where('username', $username)->first();
            
            if(!empty($user)){
                if($this->django_password_verify($password, $user->password)){
                    $status= true;
                    $info = "Welcome to site";
                }else{
                    $status= false;
                    $info = "invalidate username or password";
                }
            }else{
                $status= false;
                $info = "User not found";
            }
            return ResponseBuilder::result($status, $info);
        }else{
            $status= falsse;
            $info = "Unauthorized";   
        }
        return ResponseBuilder::result($status, $info);
    }
    public function django_password_verify(string $password, string $djangoHash): bool{
        $pieces = explode('$',$djangoHash);
        if(count($pieces) !== 4){
            throw new Exceptcion("Formato incorrecto");
        }
        list($header, $iter, $salt, $hash) = $pieces;
        if(preg_match('#^pbkdf2_([a-z0-9A-Z]+)$#', $header, $m)){
            $algo = $m[1];
        }else{
            throw new Exception(sprintf("BAD HEADERS (%s)", $header));
        }
        if(!in_array($algo, hash_algos())){
            throw new Exception(sprintf("Ilegal hash algorithm (%s)", $algo));
        }
        $calc = hash_pbkdf2(
            $algo, 
            $password, 
            $salt, 
            (int) $iter, 
            32, 
            true
        );
        return hash_equals($calc, base64_decode($hash));
        
    }
    
    public function getUsers(Request $request){
        if($request->isJson()){
            $users = User::all();
            return response()->json($users, 200);
        }else{
            $status=false;
            $info = "Unathorized";
        }
        return ResponseBuilder::result($status, $info);
    }
    public function logout(Request $request){

    }
}
