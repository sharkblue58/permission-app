<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\EmailVerfyController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//public
Route::post('register',[RegisterController::class,'register']);
Route::post('login',[LoginController::class,'login']);
//protected
Route::middleware('auth:sanctum')->group(function(){
Route::post('email-verfication',[EmailVerfyController::class,'emaiVerify']);
Route::get('email-verfication',[EmailVerfyController::class,'resendEmailVerify']);
});

