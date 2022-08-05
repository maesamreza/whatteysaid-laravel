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
    //Person Routes
    Route::get('person/count',['as'=>'person.count','uses'=>'\App\Http\Controllers\Api\Admin\PersonController@counts']);
    Route::get('person',['as'=>'person','uses'=>'\App\Http\Controllers\Api\Admin\PersonController@person_view']);
    Route::post('person/store',['as'=>'person.store','uses'=>'\App\Http\Controllers\Api\Admin\PersonController@person_process']);
    Route::get('person/edit/{id}',['as'=>'person.edit','uses'=>'\App\Http\Controllers\Api\Admin\PersonController@person_edit']);
    Route::get('person/delete/{id}',['as'=>'person.delete','uses'=>'\App\Http\Controllers\Api\Admin\PersonController@delete_person']);
    Route::post('person/update/{id}',['as'=>'person.update','uses'=>'\App\Http\Controllers\Api\Admin\PersonController@person_update']);
    //Import Route
    Route::post('person/import',['as'=>'person.import','uses'=>'\App\Http\Controllers\Api\Admin\ImportController@fileImport_procedure']);
});

//Client Api Routes
Route::post('search',['as'=>'search','uses'=>'\App\Http\Controllers\Api\Client\SearchController@search']);
Route::post('count/{id}',['as'=>'count','uses'=>'\App\Http\Controllers\Api\Client\SearchController@count_person']);


