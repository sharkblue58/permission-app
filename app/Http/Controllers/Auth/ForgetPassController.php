<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgetPassRequest;
use App\Notifications\resetpassnotify;
use Illuminate\Http\Request;
use App\Models\User;

class ForgetPassController extends Controller
{
    public function forgetPassword(ForgetPassRequest $request){
      
        $input=$request->only('email');
        $user=User::where('email',$input)->first();
        $user->notify( new resetpassnotify());
        $success['success']=true;
        return response()->json($success,200);

    }
}
