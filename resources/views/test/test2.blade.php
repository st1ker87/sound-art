<h2>TESTACODICE #2</h2>
{{-- ///////////////////////////////////////////// --}}

  








{{-- ///////////////////////////////////////////// --}}
{{-- ///////// qua sopra scrivi in blade ///////// --}}
{{-- ///////////////////////////////////////////// --}}
@php
/////////////////////////////////////////////
////////// qua sotto scrivi in php //////////
/////////////////////////////////////////////


		use App\Profile;

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
				$iper_profile['average_vote'] = $total_vote/count($profile_reviews); // ! voto obbligatorio per ogni review (testo facoltativo)
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

		// query parameters 1: user's filters from axios query url
		$category 	= null;
		$genre		= null;
		$offer		= null;
		$vote		= null;
		$rev_count	= null;

		// query parameters 2: only profiles with sponsorship in response
		$only_sponsorship = false; // true / false

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
			$filtered_iper_profiles = getFilteredProfiles($tmp_iper_profiles,$key,$value,$mode);
			$tmp_iper_profiles = $filtered_iper_profiles;
		}

		// filtered iper profile array shuffle
		shuffle($filtered_iper_profiles);

		echo 'TUTTE selezionate dall\'utente';
		@dump($filtered_iper_profiles);

		// # SPLIT BY SPONSORSHIP # 

		// ! after shuffle !

		$spons_f_i_profiles = [];
		$no_spons_f_i_profiles = [];
		foreach ($filtered_iper_profiles as $f_i_profile) {
			if ($f_i_profile['is_active_sponsorship'])
				$spons_f_i_profiles[] = $f_i_profile;
			else 
				$no_spons_f_i_profiles[] = $f_i_profile;
		}

		echo 'gruppo sponsorship';
		@dump($spons_f_i_profiles);

		echo 'gruppo NO sponsorship';
		@dump($no_spons_f_i_profiles);

		echo 'la somma delle due';
		@dump([...$spons_f_i_profiles, ...$no_spons_f_i_profiles]);	

		// # FILTER 2: ONLY PROFILES WITH SPONSORSHIP # 

		if ($only_sponsorship) { // ! home page
			$filtered_iper_profiles = $spons_f_i_profiles;
		} else { 				// ! no home page
			$filtered_iper_profiles = [...$spons_f_i_profiles, ...$no_spons_f_i_profiles];
		}

		// @dump($only_sponsorship);
		// echo 'finale con $only_sponsorship = '.$only_sponsorship;
		// @dump($filtered_iper_profiles);

	function getFilteredProfiles($_array,$_key,$_value,$_mode) {
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

/////////////////////////////////////////////














// date_default_timezone_set('Europe/Rome');

// $hours = 3;

// echo 'dateTime (tutte le funzioni php):';
// $date = new DateTime();
// @dump($date);

// echo 'da dateTime a created_at (per il db):';
// // $date = $date->format('Y-m-d H:i:s');
// $date = date_format($date, 'Y-m-d H:i:s');
// @dump($date);

// echo 'da created_at a dateTime (tutte le funzioni php):';
// $date = DateTime::createFromFormat('Y-m-d H:i:s', $date);
// @dump($date); 

// echo 'aggiungo 3 ore a dateTime:';
// // $date->add(new DateInterval("PT{$hours}H"));
// date_add($date, date_interval_create_from_date_string($hours.' hours'));
// @dump($date);

// echo 'e dopo ritorno a created_at:';
// // $date = $date->format('Y-m-d H:i:s');
// $date = date_format($date, 'Y-m-d H:i:s');
// @dump($date);




// $date->add(new DateInterval('P10D'));
// echo $date->format('Y-m-d') . "\n";







/////////////////////////////////////////////
/////////////////////////////////////////////
/////////////////////////////////////////////
@endphp


