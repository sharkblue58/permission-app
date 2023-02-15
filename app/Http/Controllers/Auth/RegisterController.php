<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Notifications\EmailVerfyNotify;
use GuzzleHttp\Promise\Create;

class RegisterController extends Controller
{
    public function register(RegistrationRequest $request){
       $newuser=$request->validated();
       $newuser['password']=Hash::make($newuser['password']);
       $newuser['role']='user';
       $newuser['status']='active';
       $user=User::Create($newuser);
       $success['token']=$user->createToken('user',['app:all'])->plainTextToken;
       $success['name']=$user->first_name;
       $success['success']=true;
       $user->notify(new EmailVerfyNotify());
       return response()->json($success,200);
    }
}
