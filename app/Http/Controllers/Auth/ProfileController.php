<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Requests\Auth\ProfileUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function updateProfile(ProfileUpdateRequest $request){
        $theuser=$request->user();
        $valideData=$request->validated();
        $user=User::find( $theuser->id)->first();
        $user->update($valideData);
        $user=$user->refresh();
        $success['success']=true;
        $success['user']=$user;
       return response()->json($success,200);
    }
}
