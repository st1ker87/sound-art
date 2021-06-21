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

// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
// %         GUEST ROUTES        % 
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 

/**
 * # HOME = SIMPLE SEARCH #
 * 
 * home page con ricerca semplice
 * http://localhost:8000/
 */
Route::get('/', 'HomeController@index')->name('home');	// !  GET	/	return view('home');

/**
 * # PROFILES = ADVANCED SEARCH #
 * 
 * Profile CRUD: parte guest (index,show) TUTTI I PROFILI
 * http://localhost:8000/search
 * 
 * !---------------------------------------!
 * !                                       !
 * !           /profiles/search            !
 * !       search & search_from_home       !
 * !     THIS URL IS IN Vue.js mount()     !
 * !                                       !
 * !---------------------------------------!
 */
Route::prefix('profiles')   // prefisso URI raggruppamento sezione /search/...
	->group(function () {	// rotte specifiche search = profiles

		// atterraggio diretto senza filtri di ricerca semplice	[come fosse ->name('profiles.index')]
		Route::get('/search', 'ProfileController@search')->name('search'); 						// !  GET	/profiles/search		return view('guest.profiles.search');

		// atterraggio da home page con ricerca semplice 
		Route::post('/search', 'ProfileController@search_from_home')->name('search_from_home');	// ! POST	/profiles/search		return view('guest.profiles.search');

		// dettaglio profilo (di chiunque per chiunque)
		Route::get('/search/{slug}', 'ProfileController@show')->name('profiles.show'); 			// ! GET	/profiles/search/{slug}	return view('guest.profiles.show');

	});

/**
 * # MESSAGES #
 * 
 * Message CRUD: parte guest (create,store)
 * http://localhost:8000/messages
 * * .../{slug} : slug of user recipient
 * * .../{id} 	: id of user recipient
 */
Route::get('/messages/create/{slug}',	'MessageController@create')->name('messages_create');	// ! GET	/messages/create/{id}	return view('guest.messages.create');
Route::post('/messages/{id}', 			'MessageController@store')->name('messages_store'); 	// ! GET	/messages/{id}			return redirect()->route('profiles.show')->with('status','Message sent');

/**
 * # REVIEWS #
 * 
 * Review CRUD: parte guest (create,store)
 * http://localhost:8000/reviews
 * * .../{slug} : slug of user recipient
 * * .../{id} 	: id of user recipient
 */
Route::get('/reviews/create/{slug}',	'ReviewController@create')->name('reviews_create');		// ! GET	/reviews/create/{id}	return view('guest.reviews.create');
Route::post('/reviews/{id}',			'ReviewController@store')->name('reviews_store');		// ! GET	/reviews/{id}			return redirect()->route('profiles.show')->with('status','Review created');


// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 
// %         ADMIN ROUTES        % 
// %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% 

Auth::routes(); // signup presente in guest home
// Auth::routes(['register'=>false]); // disattivazione signup in guest home 

Route::prefix('admin')   	// prefisso URI raggruppamento sezione /admin/...
	->namespace('Admin')	// ubicazione dei Controller admin /app/Http/Controllers/Admin/...
	->middleware('auth')	// controllore autenticazione
	->group(function () {	// rotte specifiche admin

		/**
		 * # DASHBOARD #
		 * 
		 * home dell'utente loggato >>> definita in laravel qua:
		 * 
		 * /app/Http/Providers/RouteServiceProvider
		 *		public const HOME = '/admin/dashboard';
		 *
		 * http://localhost:8000/admin/dashboard
		 */
		Route::get('/dashboard', 'HomeController@index')->name('dashboard'); // ! GET	/admin/dashboard	return view('admin.dashboard');

		/**
		 * # PROFILES #
		 * 
		 * Profile CRUD: parte admin (create,store,edit,update,destroy) SOLO IL PROPRIO PROFILE
		 * http://localhost:8000/admin/profiles
		 */
		Route::resource('/profiles', ProfileController::class)->names([
			'index'		=> 'admin.profiles.index',		// ! GET	/admin/profiles				return view('admin.profiles.index'); >>>>>>> È DIVERSA DALLA DASHBOARD !!!
			'show'		=> 'admin.profiles.show',		// ! GET	/admin/profiles/{slug}		return view('admin.profiles.show');
			'create' 	=> 'admin.profiles.create',		// ! GET	/admin/profiles/create		return view('admin.profiles.create');
			'store' 	=> 'admin.profiles.store',		// ! POST	/admin/profiles				return redirect()->route('dashboard')->with('status','Profile created');
			'edit' 		=> 'admin.profiles.edit',		// ! GET	/admin/profiles/{slug}/edit	return view('admin.profiles.edit');
			'update' 	=> 'admin.profiles.update',		// ! PUT	/admin/profiles/{slug}		return redirect()->route('dashboard')->with('status','Profile udated');
			'destroy' 	=> 'admin.profiles.destroy',	// ! DEL	/admin/profiles/{slug}		return redirect()->route('dashboard')->with('status','Profile deleted');
		]);

		/**
		 * # MESSAGES #
		 * 
		 * Message CRUD: parte admin (index,show,destroy) MESSAGGI RICEVUTI
		 * http://localhost:8000/admin/messages
		 */
		Route::resource('/messages', MessageController::class)->names([
			'index'		=> 'admin.messages.index',		// ! GET	/admin/messages				return view('admin.messages.index');
			// 'show'	=> 'admin.messages.show',		// ! GET	/admin/messages/{slug}		return view('admin.messages.show');
			'destroy' 	=> 'admin.messages.destroy',	// ! DEL	/admin/messages/{slug}		return redirect()->route('admin.messages.index')->with('status','Message deleted');
		]);

		/**
		 * # REVIEWS #
		 * 
		 * Review CRUD: parte admin (index,show) RECENSIONI RICEVUTE 
		 * http://localhost:8000/admin/reviews
		 */
		Route::resource('/reviews', ReviewController::class)->names([
			'index'		=> 'admin.reviews.index',		// ! GET	/admin/reviews				return view('admin.reviews.index');
			// 'show'	=> 'admin.reviews.show',		// ! GET	/admin/reviews/{slug}		return view('admin.reviews.show');
		]);

		/**
		 * # CONTRACTS #
		 * 
		 * Braintree process payment (index,create,store) and checkout (store)
		 * http://localhost:8000/admin/sponsorship
		 * * /sponsorship/create/{id} : chosen sponsorship_id
		 */
		Route::get('/sponsorship/list', 	 	'ContractController@index')->name('my_sponsorships'); // ! GET	/admin/sponsorship/list			return view('admin.contracts.index');
		Route::get('/sponsorship/create/{id}', 	'ContractController@create')->name('sponsorship');	// ! GET	/admin/sponsorship/create/{id}	return view('admin.contracts.create');
		Route::post('/sponsorship/checkout', 	'ContractController@store')->name('checkout'); 		// ! POST	/admin/sponsorship/checkout		DIPENDE !

		/**
		 * # SPONSORSHIPS #
		 * 
		 * Sponsorship CRUD: solo admin (index,show) PRODOTTI IN VENDITA 
		 * http://localhost:8000/admin/sponsorship
		 */
		Route::resource('/sponsorships', SponsorshipController::class)->names([
			'index'		=> 'admin.sponsorships.index',	// ! GET	/admin/sponsorships			return view('admin.sponsorships.index');
			'show'		=> 'admin.sponsorships.show',	// ! GET	/admin/sponsorships/{id}	return view('admin.sponsorships.show');
		]);




		
		/**
		 * API con token
		 * pannello generazione token utente loggato
		 * generazione token 
		 */
		// Route::get('/profile', 'HomeController@profile')->name('admin-profile');
		// Route::post('/profile/generate-token', 'HomeController@generateToken')->name('admin.generate_token');

	});




// ############################### 
// #         DEV  ROUTES         # 
// ############################### 

Route::get('/test', 'HomeController@test')->name('test');  		// ! SOLO PER TESTARE CODICE 
Route::get('/test2', 'HomeController@test2')->name('test2');  	// ! SOLO PER TESTARE CODICE 


