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
    //Public whattheysaid Routes
    Route::get('said/view',['as'=>'said.view','uses'=>'\App\Http\Controllers\Api\Admin\PersonController@said_view']);
    Route::post('said/status/{id}',['as'=>'said.status','uses'=>'\App\Http\Controllers\Api\Admin\PersonController@status_update']);
    Route::post('all/said/status',['as'=>'all.said.status','uses'=>'\App\Http\Controllers\Api\Admin\PersonController@all_status_update']);
    //Excel Download Route
    Route::get('excel/download',['as'=>'excel.download','uses'=>'\App\Http\Controllers\Api\Admin\ImportController@excel_download']);

});

//Client Api Routes

//Search Route
Route::post('search',['as'=>'search','uses'=>'\App\Http\Controllers\Api\Client\SearchController@search']);
//Count Route
Route::post('count/{id}',['as'=>'count','uses'=>'\App\Http\Controllers\Api\Client\SearchController@count_person']);
Route::post('like/count/{id}',['as'=>'like.count','uses'=>'\App\Http\Controllers\Api\Client\SearchController@likes_count_person']);

//Said Route
Route::post('said/process',['as'=>'said.process','uses'=>'\App\Http\Controllers\Api\Client\SaidController@said_process']);
//Comment Routes
Route::post('comment/process',['as'=>'comment.process','uses'=>'\App\Http\Controllers\Api\Client\SaidController@comment_process']);
Route::get('comment/view/{id}',['as'=>'comment.view','uses'=>'\App\Http\Controllers\Api\Client\SaidController@comment_view']);





