<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Admin Api Routes
Route::prefix('admin')->namespace('Admin')->group(function(){
    //Login Routes
    Route::post('login',['as'=>'login','uses'=>'\App\Http\Controllers\Api\Admin\LoginController@admin_login_process']);
    //Profile Routes
    Route::post('profile/{id}',['as'=>'profile','uses'=>'\App\Http\Controllers\Api\Admin\ProfileController@admin_update_profile']);

});
