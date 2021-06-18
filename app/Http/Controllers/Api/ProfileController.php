<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Profile;

class ProfileController extends Controller
{
	/**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %     IPER PROFILE ENDPOINT     %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
     *
	 * restituisce in json tutta la tabella profile con info ausiliarie
	 * 
	 */
    public function index(Request $request)
	{
		// DB starting source
		$profiles = Profile::all();

		// building $iper_profiles, array of $iper_profile 
		foreach ($profiles as $profile) {

			// starting properties 
			$iper_profile = $profile->toArray(); // array, NOT laravel collection!

			// adding name, surname >>> strings
			$iper_profile['name'] 	 = $profile->user->name;
			$iper_profile['surname'] = $profile->user->surname;

			// warning: these are lravel collections!
			$profile_categories = $profile->user->categories;
			$profile_genres		= $profile->user->genres;
			$profile_offers 	= $profile->user->offers;
			$profile_messages 	= $profile->user->messages;
			$profile_reviews 	= $profile->user->reviews;
			// $profile_contracts 	= $profile->user->contracts;

			// adding categories, genres, offers >>> array of strings
			foreach ($profile_categories as $category)	$iper_profile['categories'][]	= $category->name;
			foreach ($profile_genres as $genre)			$iper_profile['genres'][]		= $genre->name;
			foreach ($profile_offers as $offer)			$iper_profile['offers'][] 		= $offer->name;

			// adding messages, revies >>> array of array of strings
			// adding average_vote, rev_count >>> strings
			foreach ($profile_messages as $message)		$iper_profile['messages'][]		= $message->toArray(); // array, NOT laravel collection!
			if ($profile_reviews->isNotEmpty()) {
				$total_vote = 0;
				foreach ($profile_reviews as $review) {
					$iper_profile['reviews'][] = $review->toArray(); // array, NOT laravel collection!
					$total_vote += $review['rev_vote'];
				}
				$iper_profile['average_vote'] = $total_vote/count($profile_reviews); // ! voto obbligatorio per ogni review (testo facoltativo)
			} else {
				$iper_profile['average_vote'] = 0;
			}
			$iper_profile['rev_count'] = count($profile_reviews);
			
			// a new iper_profile is born!
			$iper_profiles[] = $iper_profile;
		}

		// user's filters from axios query url
		$category 	= $request->get('category');
		$genre		= $request->get('genre');
		$offer		= $request->get('offer');
		$vote		= $request->get('vote');
		$rev_count	= $request->get('reviewNum');

		// building filter set (only not null values)
		$filters = [];
		// ! these keys must be equal to $iper_profile's keys!
		if ($category)	$filters['categories']		= $category;
		if ($genre)		$filters['genres']			= $genre;
		if ($offer)		$filters['offers']			= $offer;
		if ($vote)		$filters['average_vote']	= $vote;
		if ($rev_count)	$filters['rev_count']		= $rev_count;
		
		// iterating on filter set 
		$filtered_iper_profiles = $iper_profiles;
		$tmp_iper_profiles = $filtered_iper_profiles;
		foreach ($filters as $key => $value) {
			$mode = is_numeric($value) ?  'greater' : 'contains';
			$filtered_iper_profiles = $this->getFilteredProfiles($tmp_iper_profiles,$key,$value,$mode);
			$tmp_iper_profiles = $filtered_iper_profiles;
		}

		return response()->json([
			'success' => true,
			'results' => $filtered_iper_profiles
		]);

	}




	/**
	 * Array Filter Function
	 * 
	 * mode 1: $_mode = 'contains' 
	 * returns $_array items where $_filter set contains $_value
	 * 
	 * mode 2: $_mode = 'greater' 
	 * returns $_array items where $_filter value is greater than $_value
	 */
	protected function getFilteredProfiles($_array,$_key,$_value,$_mode) {
		$filtered_array = [];
		foreach ($_array as $item) {
			if (array_key_exists($_key,$item)) {
				if ($_mode == 'contains') $condition = (in_array($_value,$item[$_key]));
				if ($_mode == 'greater')  $condition = ($item[$_key] >= $_value);
				if ($condition) $filtered_array[] = $item;
			}
		}
		return $filtered_array;
	}

}





