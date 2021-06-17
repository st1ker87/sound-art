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

		// ! DB source
		$users 			= User::all();
		$profiles 		= Profile::all();
		$categories 	= Category::all();
		$genres 		= Genre::all();
		$offers 		= Offer::all();
		$messages 		= Message::all();
		$reviews 		= Review::all();
		// $contracts		= Contract::all();
		// $sponsorships	= Sponsorship::all();

		// ! building iper_profile
		foreach ($profiles as $profile) {

			$iper_profile = $profile->toArray();

			$iper_profile['name'] 	 = $profile->user->name;
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
			if ($reviews->isNotEmpty()) {
				$total_vote = 0;
				foreach ($reviews as $review) {
					$iper_profile['reviews'][] = $review->toArray();	
					$total_vote += $review['rev_vote'];
				}
				$iper_profile['average_vote'] = $total_vote/count($reviews);
			} else {
				$iper_profile['average_vote'] = 0;
			}
			$iper_profile['rev_count'] = count($reviews);
			
			// new iper_profile is listed
			$iper_profiles[] = $iper_profile;
		}

		// ! user's filters
		$category 	= $request->get('category');
		$genre		= $request->get('genre');
		$offer		= $request->get('offer');
		$vote		= $request->get('vote');
		$rev_count	= $request->get('reviewNum');

		// >>>TEST VALUES<<<
		// $category 	= 'Drummer'; // Mixer/Engineer
		// $genre		= 'Metal'; // Rock
		// $offer		= 'Recording'; // 
		// $vote		= 3;
		// $rev_count	= 5;

		// ! filtering values (keys must be iper_profile's keys!)
		$filters = [];
		if ($category)	$filters['categories']		= $category;
		if ($genre)		$filters['genres']			= $genre;
		if ($offer)		$filters['offers']			= $offer;
		if ($vote)		$filters['average_vote']	= $vote;
		if ($rev_count)	$filters['rev_count']		= $rev_count;
		
		// filtering iteration for each user filter
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





