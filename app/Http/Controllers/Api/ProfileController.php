<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Profile;

use DateTime;

class ProfileController extends Controller
{
	/**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %     IPER PROFILE ENDPOINT     %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
     *
	 * @return json: array of profiles with aux infos
	 */
    public function index(Request $request)
	{
		// # DB PROFILES WITH AUX PARAMETERS # 

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
			// $profile_messages 	= $profile->user->messages;
			$profile_reviews 	= $profile->user->reviews;
			// $profile_contracts 	= $profile->user->contracts;
			$profile_contracts 	= $profile->user->contracts;

			// adding categories, genres, offers >>> array of strings
			foreach ($profile_categories as $category)	$iper_profile['categories'][]	= $category->name;
			foreach ($profile_genres as $genre)			$iper_profile['genres'][]		= $genre->name;
			foreach ($profile_offers as $offer)			$iper_profile['offers'][] 		= $offer->name;

			// adding messages >>> array of array of strings [NO!]
			// foreach ($profile_messages as $message)		$iper_profile['messages'][]		= $message->toArray(); // array, NOT laravel collection!

			// adding reviews >>> array of array of strings [NO!]
			// adding average_vote, rev_count >>> strings
			if ($profile_reviews->isNotEmpty()) {
				$total_vote = 0;
				foreach ($profile_reviews as $review) {
					// $iper_profile['reviews'][] = $review->toArray(); // array, NOT laravel collection!
					$total_vote += $review['rev_vote'];
				}
				$iper_profile['average_vote'] = $total_vote/count($profile_reviews);
			} else {
				$iper_profile['average_vote'] = 0;
			}
			$iper_profile['rev_count'] = count($profile_reviews);

			// sponsorship flags
			date_default_timezone_set('Europe/Rome');
			$is_active_sponsorship = false;
			$active_contract_id = null;
			foreach ($profile_contracts as $contract) {
				$date_start = DateTime::createFromFormat('Y-m-d H:i:s', $contract->date_start);
				$date_end   = DateTime::createFromFormat('Y-m-d H:i:s', $contract->date_end);
				$now 		= new DateTime();
				if ($date_start < $now && $date_end >= $now) {
					$is_active_sponsorship = true;
					$active_contract_id = $contract->id;
				}
			}
			$iper_profile['is_active_sponsorship'] = $is_active_sponsorship;
			$iper_profile['active_contract_id'] = $active_contract_id;

			// less transmitted properties
			$unset_properties = [
				'work_address','work_address_gps','phone',
				'bio_text1','bio_text2','bio_text3','video_url','audio_url','public',
				'created_at','updated_at'
			];
			foreach ($unset_properties as $unset_property) {
				unset($iper_profile[$unset_property]);
			}

			// a new iper_profile is born!
			$iper_profiles[] = $iper_profile;
		}

		// # AXIOS QUERY URL # 

		// user's request 
		$category 	= $request->get('category');
		$genre		= $request->get('genre');
		$offer		= $request->get('offer');
		$vote		= $request->get('vote');
		$rev_count	= $request->get('reviewNum');

		// only profiles with sponsorship requested
		$only_sponsorship = ($request->get('only_sponsorship') == 'true') ? true : false;

		// list segment requested
		$profile_num_start	= $request->get('profile_num_start');
		$profile_num_end	= $request->get('profile_num_end');

		// # FILTER 1: USER'S REQUEST # 

		// building filter set (only not null values)
		$filters = [];
		// ! these keys must be equal to $iper_profile's keys!
		if ($category)	$filters['categories']		= $category;
		if ($genre)		$filters['genres']			= $genre;
		if ($offer)		$filters['offers']			= $offer;
		if ($vote)		$filters['average_vote']	= $vote;
		if ($rev_count)	$filters['rev_count']		= $rev_count;

		// filtering iteration on user's filter set 
		$filtered_iper_profiles = $iper_profiles;
		$tmp_iper_profiles = $filtered_iper_profiles;
		foreach ($filters as $key => $value) {
			$mode = is_numeric($value) ?  'greater' : 'contains';
			$filtered_iper_profiles = $this->getFilteredProfiles($tmp_iper_profiles,$key,$value,$mode);
			$tmp_iper_profiles = $filtered_iper_profiles;
		}

		// # FILTER 2: ONLY PROFILES WITH SPONSORSHIP # 

		// split by sponsorship
		$spons_profiles = [];
		$no_spons_profiles = [];
		foreach ($filtered_iper_profiles as $f_i_profile) {
			if ($f_i_profile['is_active_sponsorship'])
				$spons_profiles[] = $f_i_profile;
			else
				$no_spons_profiles[] = $f_i_profile;
		}

		if ($only_sponsorship) {
			$filtered_iper_profiles = $spons_profiles;
		} else {
			$filtered_iper_profiles = [...$spons_profiles, ...$no_spons_profiles];
		}

		// # LIST PACKETIZATION #

		// only $filtered_iper_profiles from ($profile_num_start - 1) to ($profile_num_end - 1)
		if ($profile_num_start && $profile_num_end) {
			$slice_profiles = array_slice($filtered_iper_profiles, $profile_num_start - 1, ($profile_num_end - $profile_num_start + 1));
			$rem_profiles 	= array_slice($filtered_iper_profiles, $profile_num_end);
		
			if (count($rem_profiles) > 0) 
				$is_last_profile_group = false;
			else	
				$is_last_profile_group = true;
		
			$filtered_iper_profiles = $slice_profiles;
		}

		// # RESPONSE EJECT # 

		return response()->json([
			'success' => true,
			'results' => $filtered_iper_profiles,
			'is_last_profile_group' => $is_last_profile_group
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





