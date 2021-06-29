<h2>TESTACODICE #2</h2>
{{-- ///////////////////////////////////////////// --}}

{{-- 
	INPUT  : data-ora del DB (created_at) [ 2021-06-25 13:00:20 ]
	OUTPUT : data-ora leggibile, inglese  [ Friday June 25, 2021, 13:00:20 ]
--}}
{{-- @php
function getTimeDisplay($db_time) {
	// create DateTime object
	$db_time = DateTime::createFromFormat('Y-m-d H:i:s', $db_time);
	// get string time
	return date_format($db_time, 'l F j, Y, G:i:s');
}
@endphp --}}


{{-- NON CANCELLARE QUESTA PAGINA DI TEST --}}
{{--        SERVE A STEFANO E YURI        --}}
{{-- 
	
	
	@php

	$route_name = Route::currentRouteName();
	dump($route_name);
	
	if ($route_name == 'profiles.show') {
		// per profiles.show (PROFILO ESISTE)
		// visto da guest o admin: $profile viene da ProfileController
		$my_profile = $profile;
		$my_user = $profile->user;
	} else {
		// per dashboard e simili (PROFILO PUÒ NON ESISTERE usare user)
		// visto da admin: $my_profile = Auth::user()->profile;
		$my_user = Auth::user();
		$my_profile = $my_user->profile;
	}

    $reviews = $my_user->reviews;
    // Set average vote to false
    $average_vote = false;
    // If collection of votes is not empty
    if($reviews->isNotEmpty()) {
        // Set average vote to 0 so I can start adding the votes found
        $average_vote = 0;
        // Keeps track of number of votes
        $counter = 0;
        foreach($reviews as $review) {
            // For each vote add +1 to counter
            $counter++;
            // Update average vote
            $average_vote += $review->rev_vote;
        }
        // When for loop ends, do average and round the result
        $average_vote = round($average_vote / $counter);
    }
@endphp

<!-- JUMBOTRON DASHBOARD -->
<div class="jumbo-dash container-fluid">
	<div class="row jumbo_height">
		<!-- <div class="over-jumbo d-block d-xl-none"></div> -->
		<div class="container jumbo_height">
			<div class="jumbo_img jumbo_height d-none d-lg-block">
				<div class="diagonal_container">
					<div class="diagonal"></div>
					@if ($my_profile)
						<img class="jumbo_height" src="{{asset('storage/'.$my_profile->image_url)}}" alt="">  
					@endif
				</div>
			</div>
			<div class="title-dash">
				<h1>{{ $my_user->name }} {{ $my_user->surname }}</h1>
				<h3>
					@foreach ($my_user->categories as $category)
						@if($loop->last)
							{{$category->name}}
						@else
							{{$category->name . ' |'}}
						@endif
					@endforeach
				</h3>
				<div class="votes">
					@if ($average_vote)
						@for ($i = 0; $i < $average_vote; $i++)
							<i class='fas fa-star'></i>   
						@endfor
					@else <span>No raiting</span>
					@endif 
				</div>
				@if ($my_profile)
					<p>{{ $my_profile->work_town }}</p>  
				@endif
			</div>
		</div>
	</div>
</div>



 --}}



{{-- ///////////////////////////////////////////// --}}
{{-- ///////// qua sopra scrivi in blade ///////// --}}
{{-- ///////////////////////////////////////////// --}}
@php
/////////////////////////////////////////////
////////// qua sotto scrivi in php //////////
/////////////////////////////////////////////


use App\Message;
$faker = Faker\Factory::create();

		// # MESSAGES & REVIEWS (src list) # 

		$messages = config('seeder_people_messages');
		$reviews = config('seeder_people_reviews');


		@dump($messages);
		@dd($reviews);

		$min_num_of_messages = 10; // max 25 (src list)

		$max_num_of_messages = count($messages);
		$num_of_messages = random_int($min_num_of_messages, $max_num_of_messages);
		$rand_messages_keys = array_rand($messages, $num_of_messages);
		if($num_of_messages == 1) $rand_messages_keys = [$rand_messages_keys];
		$rand_messages = [];
		foreach ($rand_messages_keys as $key) {
			$rand_messages[] = $messages[$key];
		}
		$counter = 0;
		foreach ($rand_messages as $message) {
			$new_message = new Message();
			$new_message['user_id'] = 44;
			$new_message['msg_sender_email'] = $faker->freeEmail();
			$new_message['msg_sender_name'] = $faker->name();
			$new_message['msg_subject'] = $message['msg_subject'];
			$new_message['msg_text'] = $message['msg_text'];
			// slug must be unique
			$slug = Str::slug($new_message['msg_subject'],'-');
			$slug_tmp = $slug;
			$slug_is_present = Message::where('slug',$slug)->first();
			$counter = 1;
			while ($slug_is_present) {
				$slug = $slug_tmp.'-'.$counter;
				$counter++;
				$slug_is_present = Message::where('slug',$slug)->first();
			}
			$new_message['slug'] = $slug;
			$new_message['msg_read_status'] = 0;
			// $new_message->save(); // ! DB writing here ! 
			// change created_at (backward in time)

			date_default_timezone_set('Europe/Rome');
			$now = new DateTime();
			// @dump($now);
			$new_message['created_at'] = date_format($now, 'Y-m-d H:i:s');
			// @dump($new_message['created_at']);

			$tmp_datetime = DateTime::createFromFormat('Y-m-d H:i:s', $new_message['created_at']);
			// @dump($tmp_datetime);
			$counter++;
			$days = random_int(1, 30);
			$hours = random_int(1, 24);
			$minutes = random_int(1, 59);
			date_sub($tmp_datetime, date_interval_create_from_date_string($days.' days')); 
			date_sub($tmp_datetime, date_interval_create_from_date_string($hours.' hours')); 
			date_sub($tmp_datetime, date_interval_create_from_date_string($minutes.' minutes')); 
			// @dump($tmp_datetime);

			$new_message['created_at'] = date_format($tmp_datetime, 'Y-m-d H:i:s');
			@dump($new_message['created_at']);
			// $new_message->update(); // ! DB writing here ! 
			// @dump($new_message['created_at']);
		}







/////////////////////////////////////////////


// $messages = [
// 	[
// 		'msg_subject' => "Collaboration", // ! obbligatorio !
// 		'msg_text'    => "We are interested in a collaboration for our productions. I'll be in touch next week", // ! obbligatorio !
// 	],
// 	[
// 		'msg_subject' => "I need your services", // ! obbligatorio !
// 		'msg_text'    => "Your talent is amazing! I'm compleyely bewitched. I'll contact you for learn more about you", // ! obbligatorio !
// 	],
// 	[
// 		'msg_subject' => "We would like to know you", // ! obbligatorio !
// 		'msg_text'    => "We are interested in you services. Please call +44 333 765 2956 or email us. Regards", // ! obbligatorio !
// 	],
// 	[
// 		'msg_subject' => "Hiring proposal", // ! obbligatorio !
// 		'msg_text'    => "Please contact us for a very important proposal about our events. Cheers", // ! obbligatorio !
// 	],
// ];

// $min_num_of_messages = 1;
// $max_num_of_messages = count($messages);

// $num_of_messages = random_int($min_num_of_messages, $max_num_of_messages);
// $rand_messages_keys = array_rand($messages, $num_of_messages);
// if($num_of_messages == 1) $rand_messages_keys = [$rand_messages_keys];
// $rand_messages = [];
// foreach ($rand_messages_keys as $key) {
// 	$rand_messages[] = $messages[$key];
// }
// @dump($rand_messages);


/////////////////////////////////////////////


// use App\Sponsorship;
// use App\Contract;
// // use DateTime;


// $number_of_contracts = 5;

// // list of sponsorship's id
// $db_sponsosrships = Sponsorship::all();
// foreach ($db_sponsosrships as $db_sponsosrship) $db_sponsosrship_ids[] = $db_sponsosrship->id;


// // $new_contract = new Contract;
// // $new_contract['user_id'] = 44;
// // $new_contract['sponsorship_id'] = $db_sponsosrship_ids[random_int(0,count($db_sponsosrship_ids)-1)];
// // $sel_sponsorship = Sponsorship::where('id',$new_contract['sponsorship_id'])->first();
// // date_default_timezone_set('Europe/Rome');
// // $now = new DateTime();
// // $date_db_start = date_format($now, 'Y-m-d H:i:s');
// // date_add($now, date_interval_create_from_date_string($sel_sponsorship->hour_duration.' hours'));
// // $date_db_end = date_format($now, 'Y-m-d H:i:s');
// // $new_contract['date_start'] = $date_db_start;
// // $new_contract['date_end'] 	= $date_db_end;
// // $new_contract['transaction_status'] = 'submitted_for_settlement';
// // @dump($sel_sponsorship->hour_duration);
// // @dump($new_contract->toArray());




// // $past_sponsorship_sequence_duration = [];

// // now & cycle frontier
// date_default_timezone_set('Europe/Rome');
// $tmp_time = new DateTime();

// for ($i=0; $i<$number_of_contracts; $i++) {
// 	$new_contract = new Contract;
// 	$new_contract['user_id'] = 44;
// 	// contract with randomly selected sponsorship
// 	$new_contract['sponsorship_id'] = $db_sponsosrship_ids[random_int(0,count($db_sponsosrship_ids)-1)];
// 	$sel_sponsorship = Sponsorship::where('id',$new_contract['sponsorship_id'])->first();
// 	// $sel_sponsorship_duration = $sel_sponsorship->hour_duration;
// 	// $past_sponsorship_sequence_duration[] = $sel_sponsorship_duration; // [24,144,24,72] backward in time
// 	@dump($sel_sponsorship->hour_duration);
// 	// |--------------------------|--------------------------|--------------------------|--------------------------|--------------------------|
// 	//                                                                                                  date_start = tmp_time-24     date_end = tmp_time
// 	//                                                                        tmp_start = tmp_time-144     tmp_end = tmp_time
// 	//                                             tmp_start = tmp_time-24      tmp_end = tmp_time 
// 	//                  tmp_start = tmp_time-72      tmp_end = tmp_time
// 	$date_db_end   = date_format($tmp_time, 'Y-m-d H:i:s');
// 	date_sub($tmp_time, date_interval_create_from_date_string($sel_sponsorship->hour_duration.' hours'));
// 	$date_db_start = date_format($tmp_time, 'Y-m-d H:i:s');
// 	// results
// 	$new_contract['date_start'] = $date_db_start;
// 	$new_contract['date_end'] 	= $date_db_end;
// 	$new_contract['transaction_status'] = 'submitted_for_settlement';
// 	// $new_contract->save(); // ! DB writing here ! 
// 	echo '--------------------------------------------------------------------';
// 	@dump($new_contract->toArray());
// }




























// use App\Category;

// $categories = ['lyricist','vocalist'];


// foreach ($categories as $category) {
			
// 	// se non c'è nella tabella categories aggiungi
// 	$db_categories = Category::all();
// 	$is_category_present = false;
// 	foreach ($db_categories as $db_category) {
// 		if ($db_category->name == $category) $is_category_present = true;
// 	}
// 	if (!$is_category_present) {
// 		$new_category = new Category();
// 		$new_category['name'] = $category;
// 		@dump($new_category['name']);
// 		// $new_category->save(); // ! DB writing here ! 
// 	}

// 	// costruisce array di id corrispondenti ai nomi dati
// 	$category_id = Category::where('name',$category)->first()->id;
// 	$categories_ids[] = $category_id;
// }
// @dump($categories);
// @dump($categories_ids);

		





/////////////////////////////////////////////



// date_default_timezone_set('Europe/Rome');

// use App\Classes\DateDisplay;

// echo 'dateTime (tutte le funzioni php):';
// $date = new DateTime();
// @dump($date);

// echo 'da dateTime a created_at (per il db):';
// // $date = $date->format('Y-m-d H:i:s');
// $date = date_format($date, 'Y-m-d H:i:s');
// @dump($date);

// $date = (new DateDisplay)->get($date);
// @dump($date);



// $start = 5;
// $end = 7;

// //              1    2   [3    4]   5
// //              0    1    2    3    4
// $input = array("a", "b", "c", "d", "e");
// @dump($input);

// $output = array_slice($input, $start-1,($end-$start+1));      // returns "c", "d", and "e"
// @dump($output);

// $rem = array_slice($input, $end);
// @dump($rem);
// @dump(count($rem));



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




// use App\User;
// use App\Sponsorship;
// use App\Contract;

// $fraction_of_users_with_contract = 0.3;

// $users = User::all();
// foreach ($users as $user) $user_ids[] = $user->id;
// $number_of_contracts = round($fraction_of_users_with_contract*count($users));
		
// 		$sponsosrships = Sponsorship::all();
// 		foreach ($sponsosrships as $sponsosrship) $sponsosrship_ids[] = $sponsosrship->id;

// 		$sel_user_ids =[];
// 		while (count($sel_user_ids) < $number_of_contracts) {
// 			$sel_user_id = $user_ids[random_int(0,count($user_ids)-1)];
// 			if (!in_array($sel_user_id,$sel_user_ids)) $sel_user_ids[] = $sel_user_id;
// 		}
		
// 		for ($i=0; $i<$number_of_contracts; $i++) {

// 			$new_contract = new Contract;
// 			$new_contract['user_id'] = $sel_user_ids[$i];
// 			$new_contract['sponsorship_id'] = $sponsosrship_ids[random_int(0,count($sponsosrship_ids)-1)];

// 			$date = new DateTime();
// 			date_add($date, date_interval_create_from_date_string(($i).' minutes'));
// 			$date_start = date_format($date, 'Y-m-d H:i:s');
// 			date_add($date, date_interval_create_from_date_string((15+$i).' hours'));
// 			$date_end = date_format($date, 'Y-m-d H:i:s');
// 			$new_contract['date_start'] = $date_start;
// 			$new_contract['date_end'] 	= $date_end;
			
// 			$new_contract['transaction_status'] = 'submitted_for_settlement';

// 			// $new_contract->save(); // ! DB writing here ! 
// 			@dump($new_contract);
// 		}


/////////////////////////////////////////////


	// 	use App\Profile;

	// 	// DB starting source
	// 	$profiles = Profile::all();

	// 	// building $iper_profiles, array of $iper_profile 
	// 	foreach ($profiles as $profile) {

	// 		// starting properties 
	// 		$iper_profile = $profile->toArray(); // array, NOT laravel collection!

	// 		// adding name, surname >>> strings
	// 		$iper_profile['name'] 	 = $profile->user->name;
	// 		$iper_profile['surname'] = $profile->user->surname;

	// 		// warning: these are lravel collections!
	// 		$profile_categories = $profile->user->categories;
	// 		$profile_genres		= $profile->user->genres;
	// 		$profile_offers 	= $profile->user->offers;
	// 		// $profile_messages 	= $profile->user->messages;
	// 		$profile_reviews 	= $profile->user->reviews;
	// 		// $profile_contracts 	= $profile->user->contracts;
	// 		$profile_contracts 	= $profile->user->contracts;

	// 		// adding categories, genres, offers >>> array of strings
	// 		foreach ($profile_categories as $category)	$iper_profile['categories'][]	= $category->name;
	// 		foreach ($profile_genres as $genre)			$iper_profile['genres'][]		= $genre->name;
	// 		foreach ($profile_offers as $offer)			$iper_profile['offers'][] 		= $offer->name;

	// 		// adding messages >>> array of array of strings [NO!]
	// 		// foreach ($profile_messages as $message)		$iper_profile['messages'][]		= $message->toArray(); // array, NOT laravel collection!

	// 		// adding reviews >>> array of array of strings [NO!]
	// 		// adding average_vote, rev_count >>> strings
	// 		if ($profile_reviews->isNotEmpty()) {
	// 			$total_vote = 0;
	// 			foreach ($profile_reviews as $review) {
	// 				// $iper_profile['reviews'][] = $review->toArray(); // array, NOT laravel collection!
	// 				$total_vote += $review['rev_vote'];
	// 			}
	// 			$iper_profile['average_vote'] = $total_vote/count($profile_reviews); // ! voto obbligatorio per ogni review (testo facoltativo)
	// 		} else {
	// 			$iper_profile['average_vote'] = 0;
	// 		}
	// 		$iper_profile['rev_count'] = count($profile_reviews);

	// 		// sponsorship flags
	// 		date_default_timezone_set('Europe/Rome');
	// 		$is_active_sponsorship = false;
	// 		$active_contract_id = null;
	// 		foreach ($profile_contracts as $contract) {
	// 			$date_start = DateTime::createFromFormat('Y-m-d H:i:s', $contract->date_start);
	// 			$date_end   = DateTime::createFromFormat('Y-m-d H:i:s', $contract->date_end);
	// 			$now 		= new DateTime();
	// 			if ($date_start < $now && $date_end >= $now) {
	// 				$is_active_sponsorship = true;
	// 				$active_contract_id = $contract->id;
	// 			}
	// 		}
	// 		$iper_profile['is_active_sponsorship'] = $is_active_sponsorship;
	// 		$iper_profile['active_contract_id'] = $active_contract_id;

	// 		// less transmitted properties
	// 		$unset_properties = [
	// 			'work_address','work_address_gps','phone',
	// 			'bio_text1','bio_text2','bio_text3','video_url','audio_url','public',
	// 			'created_at','updated_at'
	// 		];
	// 		foreach ($unset_properties as $unset_property) {
	// 			unset($iper_profile[$unset_property]);
	// 		}

	// 		// a new iper_profile is born!
	// 		$iper_profiles[] = $iper_profile;
	// 	}

	// 	// query parameters 1: user's filters from axios query url
	// 	$category 	= null;
	// 	$genre		= null;
	// 	$offer		= null;
	// 	$vote		= null;
	// 	$rev_count	= null;

	// 	// query parameters 2: only profiles with sponsorship in response
	// 	$only_sponsorship = false; // true / false

	// 	// building filter set (only not null values)
	// 	$filters = [];
	// 	// ! these keys must be equal to $iper_profile's keys!
	// 	if ($category)	$filters['categories']		= $category;
	// 	if ($genre)		$filters['genres']			= $genre;
	// 	if ($offer)		$filters['offers']			= $offer;
	// 	if ($vote)		$filters['average_vote']	= $vote;
	// 	if ($rev_count)	$filters['rev_count']		= $rev_count;

	// 	// filtering iteration on user's filter set 
	// 	$filtered_iper_profiles = $iper_profiles;
	// 	$tmp_iper_profiles = $filtered_iper_profiles;
	// 	foreach ($filters as $key => $value) {
	// 		$mode = is_numeric($value) ?  'greater' : 'contains';
	// 		$filtered_iper_profiles = getFilteredProfiles($tmp_iper_profiles,$key,$value,$mode);
	// 		$tmp_iper_profiles = $filtered_iper_profiles;
	// 	}

	// 	// filtered iper profile array shuffle
	// 	shuffle($filtered_iper_profiles);

	// 	echo 'TUTTE selezionate dall\'utente';
	// 	@dump($filtered_iper_profiles);

	// 	// # SPLIT BY SPONSORSHIP # 

	// 	// ! after shuffle !

	// 	$spons_f_i_profiles = [];
	// 	$no_spons_f_i_profiles = [];
	// 	foreach ($filtered_iper_profiles as $f_i_profile) {
	// 		if ($f_i_profile['is_active_sponsorship'])
	// 			$spons_f_i_profiles[] = $f_i_profile;
	// 		else 
	// 			$no_spons_f_i_profiles[] = $f_i_profile;
	// 	}

	// 	echo 'gruppo sponsorship';
	// 	@dump($spons_f_i_profiles);

	// 	echo 'gruppo NO sponsorship';
	// 	@dump($no_spons_f_i_profiles);

	// 	echo 'la somma delle due';
	// 	@dump([...$spons_f_i_profiles, ...$no_spons_f_i_profiles]);	

	// 	// # FILTER 2: ONLY PROFILES WITH SPONSORSHIP # 

	// 	if ($only_sponsorship) { // ! home page
	// 		$filtered_iper_profiles = $spons_f_i_profiles;
	// 	} else { 				// ! no home page
	// 		$filtered_iper_profiles = [...$spons_f_i_profiles, ...$no_spons_f_i_profiles];
	// 	}

	// 	// @dump($only_sponsorship);
	// 	// echo 'finale con $only_sponsorship = '.$only_sponsorship;
	// 	// @dump($filtered_iper_profiles);

	// function getFilteredProfiles($_array,$_key,$_value,$_mode) {
	// 	$filtered_array = [];
	// 	foreach ($_array as $item) {
	// 		if (array_key_exists($_key,$item)) {
	// 			if ($_mode == 'contains') $condition = (in_array($_value,$item[$_key]));
	// 			if ($_mode == 'greater')  $condition = ($item[$_key] >= $_value);
	// 			if ($condition) $filtered_array[] = $item;
	// 		}
	// 	}
	// 	return $filtered_array;
	// }

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


