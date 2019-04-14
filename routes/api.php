<?php

use Illuminate\Http\Request;

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
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

Route::post('register','auths@reg');
Route::post('login','auths@logs');
Route::get('logout','auths@log')->middleware('auth:api');
Route::get('cek','auths@opt')->middleware('auth:api');
route::get('apps','auths@resxt')->middleware('auth:api');
route::get('lihat','auths@show')->middleware('auth:api');
route::post('simpan','auths@added')->middleware('auth:api');
route::get('/del/ {id}','auths@del')->middleware('auth:api');
route::get('/update/{id}','auths@updt')->middleware('auth:api');
route::put('/singel/{id}','auths@one')->middleware('auth:api');


