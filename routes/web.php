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

Route::get('/search', 'HomeController@search')->name('search'); //  {{ route('search') }}



// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
// %         GUEST ROUTES        % 
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
/**
 * ! http://localhost:8000/
 */

Route::get('/', 'HomeController@index')->name('home');


// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
// %         ADMIN ROUTES        % 
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
/**
 * ! http://localhost:8000/admin (da confermare /admin)
 */

// # DASHBOARD base (poi vediamo) # 
Route::get('/dashboard', 'HomeController@admin_index')->name('dashboard')->middleware('auth');


Auth::routes(); // signup presente in guest home
// Auth::routes(['register'=>false]); // disattivazione signup in guest home 

// Route::prefix('admin')   	// prefisso URI raggruppamento sezione /admin/...
// 	->namespace('Admin')	// ubicazione Controller admin /app/Http/Controllers/Admin/
// 	->middleware('auth')	// controllore autenticazione
// 	->group(function () {	// rotte specifiche admin
// 		Route::get('/', 'HomeController@index')->name('admin-home');
// 	});

