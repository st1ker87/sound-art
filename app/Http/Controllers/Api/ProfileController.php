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
    public function index(Request $request) 
	{

		// ! ingredienti DB
		$users 			= User::all();
		$profiles 		= Profile::all();
		$categories 	= Category::all();
		$genres 		= Genre::all();
		$offers 		= Offer::all();
		$messages 		= Message::all();
		$reviews 		= Review::all();
		// $contracts		= Contract::all();
		// $sponsorships	= Sponsorship::all();

		// ! torta senza filtri
		$profiles_array = $profiles;

		foreach ($profiles_array as $profile) {

			$iper_profile = $profile->toArray();

			$iper_profile['name'] = $profile->user->name;
			$iper_profile['surname'] = $profile->user->surname;

			$categories = $profile->user->categories;
			$genres		= $profile->user->genres;
			$offers 	= $profile->user->offers;
			$messages 	= $profile->user->messages;
			$reviews 	= $profile->user->reviews;

			foreach ($categories as $category)	$iper_profile['categories'][]	= $category->name;
			foreach ($genres as $genre)			$iper_profile['genres'][]		= $genre->name;
			foreach ($offers as $offer)			$iper_profile['offers'][] 		= $offer->name;
			foreach ($messages as $message)		$iper_profile['messages'][]		= $message->toArray();
			$iper_profile['msg_count'] = count($messages);
			
			if ($reviews->isNotEmpty()) {
				$total_vote = 0; $counter = 0;
				foreach ($reviews as $review) {		
					$iper_profile['reviews'][] = $review->toArray();	
					$total_vote += $review['rev_vote'];
					$counter++;
				}
				$iper_profile['average_vote'] = $total_vote/$counter;
			} else {
				$iper_profile['average_vote'] = 0;
			}

			$iper_profiles[] = $iper_profile;
		}

		// 1 query ottiene tutti i profile dove category = quella richiesta
		// 2 query ottiene tutti i profile dove genre = quella richiesta
		// 3 query ottiene tutti i profile dove vote = quella richiesta
		// 4 query ottiene tutti i profile dove reviewNum = quella richiesta

		// ! ingredienti utente
		$category 	= $request->get('category');
		$genre		= $request->get('genre');
		$vote		= $request->get('vote');
		$reviewNum	= $request->get('reviewNum');

		$filters = [];
		if ($category)	$filters['category'] = $category;
		if ($genre)		$filters['genre'] = $genre;
		if ($vote)		$filters['vote'] = $vote;
		if ($reviewNum)	$filters['reviewNum'] = $reviewNum;




		// $iper_profiles_tmp = $iper_profiles;

		// foreach ($filters as $key => $filter) {

		// 	$iper_profiles_tmp = iperProfilesFilter($iper_profiles_tmp,$key,$filter);


		// }

		
		// function iperProfilesFilter($_iper_profiles,$key,$filter) {
			
		// 	iperProfilesFilter($_iper_profiles,$key,$filter);


		// }


		return response()->json([
			'success' => true,
			'results' => $iper_profiles
		]);
	}


	/**
	 * 
	 * 
	 */
	protected function iperProfilesFilter($_array,$_filter,$_value) {
		foreach ($_array as $item) {
			if ( !empty($item[$_filter]) && in_array($_value,$item['categories']) ) {
				$filtered_array[] = $item;
			}
		}
		return $filtered_array;
	}
	
}





