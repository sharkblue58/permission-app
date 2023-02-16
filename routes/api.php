<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\EmailVerfyController;
use App\Http\Controllers\Auth\ForgetPassController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\ResetPassController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//public
Route::post('register',[RegisterController::class,'register']);
Route::post('login',[LoginController::class,'login']);
Route::post('password/forget-password',[ForgetPassController::class,'forgetPassword']);
Route::post('password/reset-password',[ResetPassController::class,'passwordReset']);
//protected
Route::middleware('auth:sanctum')->group(function(){
    Route::get('profile', function (Request $request) {
        return $request->user();
    });
Route::post('profile/update',[ProfileController::class,'updateProfile']);
Route::post('email-verfication',[EmailVerfyController::class,'emaiVerify']);
Route::get('email-verfication',[EmailVerfyController::class,'resendEmailVerify']);
});

