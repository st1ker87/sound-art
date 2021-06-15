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
// # home page con ricerca semplice 
Route::get('/', 'HomeController@index')->name('home');

/**
 * ! http://localhost:8000/search
 */
Route::prefix('search')   	// prefisso URI raggruppamento sezione /search/...
	->group(function () {	// rotte specifiche search

		// # ricerca avanzata - atterraggio diretto senza filtri 
		Route::get('/', 'HomeController@search')->name('search'); //  {{ route('search') }}

		// # ricerca avanzata - atterraggio da home page con filtri 
		Route::post('/', 'HomeController@search_from_home')->name('search_from_home'); //  {{ route('search_from_home') }}

	});
	
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
// %         ADMIN ROUTES        % 
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 

Auth::routes(); // signup presente in guest home
// Auth::routes(['register'=>false]); // disattivazione signup in guest home 

/**
 * ! http://localhost:8000/admin
 */
Route::prefix('admin')   	// prefisso URI raggruppamento sezione /admin/...
	->namespace('Admin')	// ubicazione dei Controller admin /app/Http/Controllers/Admin/...
	->middleware('auth')	// controllore autenticazione
	->group(function () {	// rotte specifiche admin

		// # DASHBOARD base (poi vediamo) # 
		Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');




		/**
		 * Home Page utente loggato
		 */
		// Route::get('/', 'HomeController@index')->name('admin-home');
		/**
		 * Post CRUD
		 */
		// Route::resource('/posts', PostController::class)->names([
		// 	'index' 	=> 'admin.posts.index',
		// 	'show' 		=> 'admin.posts.show',
		// 	'create' 	=> 'admin.posts.create',
		// 	'store' 	=> 'admin.posts.store',
		// 	'edit' 		=> 'admin.posts.edit',
		// 	'update' 	=> 'admin.posts.update',
		// 	'destroy' 	=> 'admin.posts.destroy',
		// ]);
		/**
		 * Category CRUD
		 */
		// Route::resource('/categories', CategoryController::class)->names([
		// 	'index' 	=> 'admin.categories.index',
		// 	'show' 		=> 'admin.categories.show',
		// 	'create' 	=> 'admin.categories.create',
		// 	'store' 	=> 'admin.categories.store',
		// 	'edit' 		=> 'admin.categories.edit',
		// 	'update' 	=> 'admin.categories.update',
		// 	'destroy' 	=> 'admin.categories.destroy',
		// ]);
		/**
		 * API con token
		 * pannello generazione token utente loggato
		 * generazione token 
		 */
		// Route::get('/profile', 'HomeController@profile')->name('admin-profile');
		// Route::post('/profile/generate-token', 'HomeController@generateToken')->name('admin.generate_token');
	});



