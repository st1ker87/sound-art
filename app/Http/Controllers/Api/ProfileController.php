<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Profile;
use App\Category;
use App\Genre;
use App\Offer;
use App\Message;
use App\Review;
// use App\Contract;
// use App\Sponsorship;

class ProfileController extends Controller
{
	/**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %     IPER PROFILE ENDPOINT     %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
     *
	 * STEP 1: restituisce in json tutta la tabella profile
	 * STEP 2: restituisce in json tutta la tabella profile con info ausiliarie
	 * 
	 */
    public function index() 
	{
		// ! ingredienti
		$users 			= User::all();
		$profiles 		= Profile::all();
		$categories 	= Category::all();
		$genres 		= Genre::all();
		$offers 		= Offer::all();
		$messages 		= Message::all();
		$reviews 		= Review::all();
		// $contracts		= Contract::all();
		// $sponsorships	= Sponsorship::all();

		// ! torta
		$iper_profiles = $profiles;

		// che fare?


		return response()->json([
			'success' => true,
			'results' => $iper_profiles
		]);
	}
}
