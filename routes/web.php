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
 * 
 * http://localhost:8000/
 */
Route::get('/', 'HomeController@index')->name('home');	// !  GET	/	return view('home');

/**
 * # PROFILES = ADVANCED SEARCH #
 * 
 * Profile CRUD: parte guest 
 * 		ELENCO E DETTAGLIO DI TUTTI I PROFILI (index,show)
 * 
 * http://localhost:8000/search
 * 
 * * /search/{slug} : profile slug
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
 * Message CRUD: parte guest 
 * 		CREA MESSAGGIO (create,store)
 * 
 * http://localhost:8000/messages
 * 
 * * .../{slug} : slug of user recipient
 * * .../{id} 	: id of user recipient
 */
/* IN DISUSO PER PASSAGGIO A MODAL *///Route::get('/messages/create/{slug}',	'MessageController@create')->name('messages_create');	// ! GET	/messages/create/{slug}	return view('guest.messages.create');
Route::post('/messages/{id}', 			'MessageController@store')->name('messages_store'); 	// ! GET	/messages/{id}			return redirect()->route('profiles.show')->with('status','Message sent');

/**
 * # REVIEWS #
 * 
 * Review CRUD: parte guest 
 * 		CREA REVIEW (create,store)
 * 
 * http://localhost:8000/reviews
 * 
 * * .../{slug} : slug of user recipient
 * * .../{id} 	: id of user recipient
 */
/* IN DISUSO PER PASSAGGIO A MODAL *///Route::get('/reviews/create/{slug}',	'ReviewController@create')->name('reviews_create');		// ! GET	/reviews/create/{slug}	return view('guest.reviews.create');
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
		 * # DASHBOARD + STATISTICS #
		 * 
		 * dashboard = home dell'utente loggato >>> definita in laravel qua:
		 * 
		 * /app/Http/Providers/RouteServiceProvider
		 *		public const HOME = '/admin/dashboard';
		 *
		 * http://localhost:8000/admin/dashboard
		 * http://localhost:8000/admin/statistics
		 */
		Route::get('/dashboard',  'HomeController@index')->name('dashboard'); 		// ! GET	/admin/dashboard	return view('admin.dashboard');
		Route::get('/statistics', 'HomeController@statistics')->name('statistics'); // ! GET	/admin/statistics	return view('admin.statistics');

		/**
		 * # PROFILES #
		 * 
		 * Profile CRUD: parte admin 
		 * 		GESTIONE COMPLETA PROPRIO PROFILO (create,store,edit,update,destroy)
		 * 
		 * http://localhost:8000/admin/profiles
		 * 
		 * * {slug} : profile slug
		 */
		Route::resource('/profiles', ProfileController::class)->names([
			// 'index'		=> 'admin.profiles.index',	// ! GET	/admin/profiles				return view('admin.profiles.index'); >>>>>>> È DIVERSA DALLA DASHBOARD !!!
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
		 * Message CRUD: parte admin 
		 * 		LISTA MESSAGGI RICEVUTI (index)
		 * 		CANCELLA MESSAGGIO (destroy)
		 * 
		 * http://localhost:8000/admin/messages
		 */
		Route::get('/messages', 			'MessageController@index')->name('admin.messages.index');		// ! GET /admin/messages		return view('admin.messages.index');
		Route::delete('/messages/{slug}',	'MessageController@destroy')->name('admin.messages.destroy');	// ! DEL /admin/messages/{slug}	return redirect()->route('admin.messages.index')->with('status','Message deleted');

		/**
		 * # REVIEWS #
		 * 
		 * Review CRUD: parte admin 
		 * 		LISTA RECENSIONI RICEVUTE (index)
		 * 
		 * http://localhost:8000/admin/reviews
		 */
		Route::get('/reviews', 'ReviewController@index')->name('admin.reviews.index'); // ! GET	/admin/reviews	return view('admin.reviews.index');

		/**
		 * # CONTRACTS #
		 * 
		 * Contract CRUD: solo admin
		 * 		LISTA STORICO SPONSORSHIP (index)
		 * 		BRAINTREE PAYMENT PROCESS: FORM (create) + CHECKOUT (store)
		 * 
		 * http://localhost:8000/admin/sponsorship
		 * * /sponsorship/create/{id} : chosen sponsorship_id
		 */
		Route::get('/sponsorship/list', 	 	'ContractController@index')->name('my_sponsorships');	// ! GET	/admin/sponsorship/list			return view('admin.contracts.index');
		Route::get('/sponsorship/create/{id}', 	'ContractController@create')->name('sponsorship');		// ! GET	/admin/sponsorship/create/{id}	return view('admin.contracts.create');
		Route::post('/sponsorship/checkout', 	'ContractController@store')->name('checkout'); 			// ! POST	/admin/sponsorship/checkout		DIPENDE DALLA TRANSAZIONE !

		/**
		 * # SPONSORSHIPS #
		 * 
		 * Sponsorship CRUD: solo admin
		 * 		LISTA PRODOTTI IN VENDITA (index)
		 * 
		 * http://localhost:8000/admin/sponsorship
		 */
		Route::get('/sponsorship', 'SponsorshipController@index')->name('admin.sponsorships.index'); 	// ! GET	/admin/sponsorships		return view('admin.sponsorships.index');

	});




// ############################### 
// #          DEV ROUTES         # 
// ############################### 

Route::get('/test1', 'HomeController@test1')->name('test1');  	// ! SOLO PER TESTARE CODICE 
Route::get('/test2', 'HomeController@test2')->name('test2');  	// ! SOLO PER TESTARE CODICE 
Route::get('/test3', 'HomeController@test3')->name('test3');  	// ! SOLO PER TESTARE CODICE PER LE STATISTICHE DI LEO
Route::get('/test4', 'HomeController@test4')->name('test4');  	// ! SOLO PER TESTARE CODICE 
Route::get('/modal', 'HomeController@modal')->name('modal');  	// ! MODAL TEMPLATE 


