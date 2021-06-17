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

/**
 * # AUTHENTICATION #
 * 
 * default laravel
 * http://localhost:8000/api/user/
 */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * # IPER PROFILES #
 * 
 * rotte estrazione iper profiles dal DB
 * http://localhost:8000/api/profiles
 */
Route::get('profiles', 'Api\ProfileController@index');  // api senza protezione	
// Route::get('profiles', 'Api\ProfileController@index')->middleware('api_token_check');
