<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Notifications\LoginNotification;

class LoginController extends Controller
{
    public function login(LoginRequest $request){

        $cridentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(auth()->attempt($cridentials)){
            $user=Auth::user();
            $user->tokens()->delete();
            $user->notify(new LoginNotification());
            $success['token']=$user->createToken($request->userAgent())->plainTextToken;
            $success['name']=$user->first_name;
            $success['success']=true;
            return response()->json($success,200);
        }else{
            return response()->json(['error'=>'Cridentials not Right'],401);
        }
    }
}
