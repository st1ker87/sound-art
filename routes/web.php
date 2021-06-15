<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ############################### 
// #         DEV  ROUTES         # 
// ############################### 

Route::get('/test', 'HomeController@test')->name('test');  // ! SOLO PER TESTARE CODICE 



// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
// %         GUEST ROUTES        % 
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
/**
 * ! http://localhost:8000/
 */

// # home page 
Route::get('/', 'HomeController@index')->name('home');

// # ricerca avanzata - atterraggio diretto senza filtri 
Route::get('/search', 'HomeController@search')->name('search'); //  {{ route('search') }}

// # ricerca avanzata - atterraggio da home page con filtri 
Route::post('/search', 'HomeController@search_from_home')->name('search_from_home'); //  {{ route('search') }}


// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
// %         ADMIN ROUTES        % 
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
/**
 * ! http://localhost:8000/admin (da confermare /admin)
 */

Auth::routes(); // signup presente in guest home
// Auth::routes(['register'=>false]); // disattivazione signup in guest home 

// # DASHBOARD base (poi vediamo) # 
Route::get('/dashboard', 'HomeController@admin_index')->name('dashboard')->middleware('auth');







// Route::prefix('admin')   	// prefisso URI raggruppamento sezione /admin/...
// 	->namespace('Admin')	// ubicazione Controller admin /app/Http/Controllers/Admin/
// 	->middleware('auth')	// controllore autenticazione
// 	->group(function () {	// rotte specifiche admin
// 		Route::get('/', 'HomeController@index')->name('admin-home');
// 	});

