<h2>PAGINA PER TESTARE CODICE</h2>


{{-- ///////////////////////////////////////////// --}}


{{-- <video width="400" controls>
	<source src="{{asset('storage/profile_video/video_placeholder.mp4')}}" type="video/mp4">
	Your browser does not support HTML video.
</video> --}}


{{-- ///////////////////////////////////////////// --}}

{{-- TEST DATI TABLE
@foreach ($profiles as $profile)
	
	@php
		$cats = $profile->user->categories
	@endphp
	@dump($profile->user->name)
	@foreach($cats as $cat)
		@dump($cat->name)
	@endforeach

@endforeach --}}

{{-- ///////////////////////////////////////////// --}}







{{-- ///////////////////////////////////////////// --}}
{{-- ///////////////////////////////////////////// --}}
{{-- ///////////////////////////////////////////// --}}
@php
/////////////////////////////////////////////
/////////////////////////////////////////////
/////////////////////////////////////////////


use App\User;
use App\Profile;
use App\Category;
use App\Genre;
use App\Offer;
use App\Message;
use App\Review;

// ! ingredienti DB
$users 			= User::all();
$profiles 		= Profile::all();
$categories 	= Category::all();
$genres 		= Genre::all();
$offers 		= Offer::all();
$messages 		= Message::all();
$reviews 		= Review::all();

// ! torta
foreach ($profiles as $profile) {

	$iper_profile = $profile->toArray();

	$iper_profile['name'] 		= $profile->user->name;
	$iper_profile['surname'] 	= $profile->user->surname;

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
	$iper_profile['rev_count'] = count($reviews);
	
	// new iper profile
	$iper_profiles[] = $iper_profile;
}

@dump($iper_profiles);






// ! ingredienti utente
$category 	= 'Drummer'; // Mixer/Engineer
$genre		= 'Metal'; // Rock
$offer		= 'Recording'; // 
$vote		= 3;
$rev_count	= 5;

if ($category)	$filters['categories']		= $category;
if ($genre)		$filters['genres']			= $genre;
if ($offer)		$filters['offers']			= $offer;
if ($vote)		$filters['average_vote']	= $vote;
if ($rev_count)	$filters['rev_count']		= $rev_count;
@dump($filters);

// filtering iteration for each user filter
$tmp_iper_profiles = $iper_profiles;
foreach ($filters as $key => $value) {
	$mode = is_numeric($value) ?  'greater' : 'contains';
	$filtered_iper_profiles = getFilteredProfiles($tmp_iper_profiles,$key,$value,$mode);
	$tmp_iper_profiles = $filtered_iper_profiles;
}

// risultato
@dump($filtered_iper_profiles);



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


// @dump(A(3));

// function A($N) {
// 	if ($N==1) {
// 		return 1;
// 	}
// 	return $N*A($N-1);
// }





/////////////////////////////////////////////


// use App\User;
// use App\Profile;

// $id = 3;

// // il profilo in questione
// $profile = Profile::find($id);
// @dump($profile);

// // $id è id del profile
// // ? quale è il suo user_id 
// $user_id = $profile->user_id;
// @dump($user_id);

// $ciccio = $profile->user->id;
// @dump($ciccio);

// $user = User::where('id',$profile->user->id)->first();
// @dump($user);

/////////////////////////////////////////////

// use App\User;
// use App\Category;

// 		$users = User::All();
// 		$categories = Category::All();

// 		$tag_ids = [];
// 		foreach ($categories as $category)
// 			$tag_ids[] = $category['id'];
			
// 		foreach ($users as $user) {
				
// 			shuffle($tag_ids);
// 			@dump($tag_ids);
// 			$tag_num = random_int(1,3);

// 			for ($i=0; $i<$tag_num; $i++) {

// 				$user_category = ['user_id'=>'','category_id'=>''];
// 				$user_category['user_id'] = $user['id'];
// 				$user_category['category_id'] = $tag_ids[$i];
// 				@dump($user_category);

// 				// DB::table('user_category')->insert([
//         		// 	'user_id'	 	=> $user['id'],  
//         		// 	'category_id' 	=> $tag_ids[$i],
//     			// ]);

// 			}
// 		}


/////////////////////////////////////////////

// use App\User;
// use App\Review;
// use Illuminate\Support\Str;

// $faker = Faker\Factory::create();

// 		$min_rev_number = 0;
// 		$max_rev_number = 5;

// 		$users = User::All();

// 		foreach ($users as $user) {

// 			$rev_num = random_int($min_rev_number,$max_rev_number);

// 			if ($rev_num > 0) {
// 				for ($i=1; $i<=$rev_num; $i++) {
	
// 					$rev_text_is_present = random_int(0,1);

// 					$new_review = new Review();
// 					$new_review['user_id'] = $user['id'];
// 					$new_review['rev_sender_name'] = $faker->name();
// 					$new_review['rev_vote'] = random_int(1,5);
// 					$new_review['rev_subject'] = $faker->sentence(rand(2,6)); // ! required for slug
// 					$new_review['rev_text'] = $rev_text_is_present ? $faker->text() : '';	
// 					// slug must be unique
// 					$slug = Str::slug($new_review['rev_subject'],'-');
// 					$slug_tmp = $slug;
// 					$slug_is_present = Review::where('slug',$slug)->first();
// 					$counter = 1;
// 					while ($slug_is_present) {
// 						$slug = $slug_tmp.'-'.$counter;
// 						$counter++;
// 						$slug_is_present = Review::where('slug',$slug)->first();
// 					}
// 					$new_review['slug'] = $slug;
// 					$new_review->save(); // ! DB writing here ! 

// 				}
// 			}
// 		}



/////////////////////////////////////////////

// use App\User;
// use App\Message;
// use Illuminate\Support\Str;

// $faker = Faker\Factory::create();

// 		$min_msg_number = 0;
// 		$max_msg_number = 5;

// 		$users = User::All();

// 		foreach ($users as $user) {

// 			$msg_num = random_int($min_msg_number,$max_msg_number);

// 			if ($msg_num > 0) {
// 				for ($i=1; $i<=$msg_num; $i++) {
	
// 					$new_message = new Message();
// 					$new_message['user_id'] = $user['id'];
// 					$new_message['msg_sender_email'] = $faker->freeEmail();
// 					$new_message['msg_sender_name'] = $faker->name();
// 					$new_message['msg_subject'] = $faker->sentence(rand(2,6));
// 					$new_message['msg_text'] = $faker->text();
// 					// slug must be unique
// 					$slug = Str::slug($new_message['msg_subject'],'-');
// 					$slug_tmp = $slug;
// 					$slug_is_present = Message::where('slug',$slug)->first();
// 					$counter = 1;
// 					while ($slug_is_present) {
// 						$slug = $slug_tmp.'-'.$counter;
// 						$counter++;
// 						$slug_is_present = Message::where('slug',$slug)->first();
// 					}
// 					$new_message['slug'] = $slug;
// 					$new_message['msg_read_status'] = 0;
// 					// $new_message->save(); // ! DB writing here ! 
// 					@dump($new_message);
// 				}
// 			}
// 		}



/////////////////////////////////////////////

// use App\User;

// $number_of_users_to_be_created = 10;

// $names = ['Lorenzo','Enrico','Francesco','Fabrizio','Antonello','Paola','Elisa','Gianna','Vasco','Mina','Ornella','Loredana','Patty','Marco Antonio'];
// $surnames = ['De Andre','Ruggeri','Guccini','Cherubini','Venditti','De Gregori','Turci','Pausini','Nannini','Rossi'];

// for ($i=0; $i<$number_of_users_to_be_created; $i++) {

// 	$name 		= $names[random_int(0,count($names)-1)];
// 	$surname 	= $surnames[random_int(0,count($surnames)-1)];

// 	// email must be unique
// 	$email_name = strtolower(str_replace(' ', '', $name));		// marcoantonio
// 	$email = $email_name.'@gmail.com';							// marcoantonio@gmail.com
// 	$email_is_present = User::where('email',$email)->first();
// 	$counter = 1;
// 	while ($email_is_present) {
// 		$email = $email_name.$counter.'@gmail.com';				// marcoantonio1o@gmail.com
// 		$counter++;
// 		$email_is_present = User::where('email',$email)->first();
// 	}
	
// 	$password = explode('@', $email)[0].explode('@', $email)[0];

// 	$new_user = new User();
// 	$new_user['name'] 		= $name;
// 	$new_user['surname'] 	= $surname;
// 	$new_user['email'] 		= $email;
// 	$new_user['password'] 	= Hash::make($password);

// 	echo $name.'---'.$surname.'---'.$email.'---'.$password.'<br>';

// 	// @dump($new_user);
// }

/////////////////////////////////////////////

// use App\User;
// use App\Profile;

// $users = User::All();

// foreach($users as $user) {

// 	$new_profile = new Profile();
// 	$new_profile['user_id'] = $user['id'];

// 	// creazione slug
// 	$slug = Str::slug($user['name'].' '.$user['surname'],'-');
// 	$slug_tmp = $slug;
// 	$slug_is_present = Profile::where('slug',$slug)->first();
// 	$counter = 1;
// 	while ($slug_is_present) {
// 		$slug = $slug_tmp.'-'.$counter;
// 		$counter++;
// 		$slug_is_present = Profile::where('slug',$slug)->first();
// 	}
// 	$new_profile['slug'] = $slug;

// 	@dump($new_profile);

// }

/////////////////////////////////////////////

// $password = 'ciccio';
// $hash = Hash::make($password);
// @dump($hash);

/////////////////////////////////////////////

// use App\User;

// $users = User::All();
// // $users = User::get(); // è lo stesso

// @dump($users);

// // $users_array = $users->toArray(); NO

// foreach ($users as $user) {
// 	$name = $user->name;
// 	$surname = $user->surname;
// 	@dump($name,$surname);	
// }

/////////////////////////////////////////////

// use App\User;

// $user = User::find(2);
// $name = $user->name;
// $surname = $user->surname;
// @dump($name,$surname);

/////////////////////////////////////////////

@endphp


