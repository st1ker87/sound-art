<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;
// use DateTime;

use App\Profile;
use App\User;
use App\Category;
use App\Genre;
use App\Offer;
use App\Message;
use App\Review;
use App\Contract;
use App\Sponsorship;

class SinglePersonSeeder1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	/**
	 * 
	 * php artisan make:seeder SinglePersonSeederN (change N)
	 * copy //////...//////
	 * copy use ...
	 * copy run(Faker $faker)
	 * php artisan db:seed --class=SinglePersonSeederN (change N)
	 * 
	 */

	// #################################################################################################################
	// #  MINIMAL EDIT START                                                                                            


		// % USER % 

		$name 		= 'Kate';
		$surname 	= 'Glock';

		// % PROFILE % 

		$work_town		= 'London, UK';
		$work_address 	= '168A Grange Rd, London SE1 3BN';
		$phone 			= '+44 378 922 25 66';

		/**
		 * ! TESTO
		 * !	>> copiare testo da soundbetter, dividendo in 2 o 3 parti (per ogni bio_text1,2,3)
		 * ! 	>> ATTENZIONE all'escape di eventuali doppi apici (") dentro il testo ( " diventa \" )
		 * ! 	>> lasciare una riga vuota nel testo per separare i paragafi (renderizzazione introdotta in pagina)
		 * ! 	>> bio_text3 può essere lasciato vuoto
		 */

		// * About me
		$bio_text1 = 
			"Professional touring singer/songwriter based out of London, from East European origin. I am lead vocalist with my band who have produced and released two successful albums. We've played throughout Europe including Download, Glastonbury, Reading & Leeds, and supported Deftones in Hellfest. 
			
			I specialise in strong vocal delivery, using my own pro-level studio and equipment. Please listen to my vocal sample upload. I can provide vocals either processed, or raw (clean, clear, without delay/reverb) for mixing in your own studio.
			
			Reviews:
			
			\"A pro from top to bottom! Such an easy going, down to earth, fun experience working with Kate!\"
			
			\"Kate's really blown me away when it comes to fast delivery with high quality. She gets the concept with the song in no time!\"
			
			\"I am doing my best work with Kate!\"";

		// * Professional Services
		$bio_text2 = 
			"All clients receive final WAVs in 24bit/44Khz format (all takes, adlibs, backing etc), as well as bounced pro-demo-level tracks that should only require minor mixing and mastering adjustments to release.
			
			Approximate overall costs are listed but do let me know if you have a specific budget to work with.
			
			TERMS & CONDITIONS:
			
			- No free demo's/samples/tests. If you're not entirely sure about my voice listen to the multiple samples, listen to our last album, send me your track and I'll honestly tell you if I think it could work.
			
			- One free revision, any other changes after are $100 per revision across all services
			
			- Every job requires a fully funded project before we begin.
			
			- All jobs are completed within approx 1-2 week period
			
			- You retain all rights to anything I produce for you. It's yours! Period! If you want to use my name as a vocalist that's fine.";

		// * Extra informations
		$bio_text3 = "";

		// * Preview text (for short presentation in Search Pages)
		$bio_text4 = "Professional touring singer/songwriter based out of London, from East European origin.";

		/**
		 * ! IMMAGINE
		 * !	>> scaricare immagine da soundbetter (inspector > Application > Frames > top > Images)
		 * !    >> posizionare dentro /storage/app/public/profile_image/ (!! NON dentro /public/storage/ !!)
		 * !    >> tenere il nome orginale dell'immagine e inserirlo in $image_name (! solo il nome !)
		 */

		 $image_name = 'IMG_4960.jpg';

		/**
		 * ! CATEGORIES, GENRES, OFFERS
		 * !	>> si possono usare categories, genres, offer già presenti nei rispettivi seeder
		 * !    >> si possono introdurre nuove categories, genres, offer (vengono aggiunte nel DB)
		 */

		// % CATEGORIES % 

		$categories = ['lyricist','topliner','vocalist']; // ! obbligatorio !
		
		// % GENRES % 

		$genres = ['classical','pop','chill'];

		// % OFFERS % 

		$offers = ['teaching','writing']; // ! obbligatorio !

		// % MESSAGES % 

		$min_num_of_messages = 10; // max 25 (src list)

		// % REVIEWS % 

		$min_num_of_reviews = 15; // max 25 (src list)

		// % CONTRACTS % 

		$min_number_of_past_contracts = 3; // less than max
		$max_number_of_past_contracts = 9; // no limits
		$is_active_contract = 0; // 1 or 0


	// #  MINIMAL EDIT END                                                                                              
	// #################################################################################################################

	
		// # MESSAGES & REVIEWS (src list) # 

		$messages = config('seeder_people_messages');
		$reviews = config('seeder_people_reviews');

		// # USER # 

		// email must be unique
		$email_name = strtolower(str_replace(' ', '', $name));
		$email = $email_name.'@gmail.com';
		$email_is_present = User::where('email',$email)->first();
		$counter = 1;
		while ($email_is_present) {
			$email = $email_name.$counter.'@gmail.com';
			$counter++;
			$email_is_present = User::where('email',$email)->first();
		}
		$password = explode('@', $email)[0].explode('@', $email)[0];
		$new_user = new User();
		$new_user['name'] 		= $name;
		$new_user['surname'] 	= $surname;
		$new_user['email'] 		= $email;
		$new_user['password'] 	= Hash::make($password);
		$new_user->save(); // ! DB writing here ! 

		// # PROFILE # 

		// slug must be unique
		$slug = Str::slug($name.' '.$surname,'-');
		$slug_tmp = $slug;
		$slug_is_present = Profile::where('slug',$slug)->first();
		$counter = 1;
		while ($slug_is_present) {
			$slug = $slug_tmp.'-'.$counter;
			$counter++;
			$slug_is_present = Profile::where('slug',$slug)->first();
		}
		$new_profile = new Profile();
		$new_profile['user_id'] = $new_user['id']; // ! deve essere un id ESISTENTE della tabella users > eseguire DOPO seed users
		$new_profile['slug'] = $slug;	
		$new_profile['work_town'] = $work_town;
		$new_profile['work_address'] = $work_address;
		$new_profile['work_address_gps'] = '';
		$new_profile['phone'] = $phone;
		$new_profile['bio_text1'] = $bio_text1;
		$new_profile['bio_text2'] = $bio_text2;
		$new_profile['bio_text3'] = $bio_text3;
		$new_profile['bio_text4'] = $bio_text4;
		$new_profile['image_url'] = 'profile_image/'.$image_name;
		$new_profile['public'] = 1;
		$new_profile->save(); // ! DB writing here ! 

		// # CATEGORIES # 

		$categories = array_map('strtolower',$categories);
		$categories_ids = [];
		foreach ($categories as $category) {
			// se non c'è nella tabella aggiungi
			$db_categories = Category::all();
			$is_category_present = false;
			foreach ($db_categories as $db_category) {
				if ($db_category->name == $category) $is_category_present = true;
			}
			if (!$is_category_present) {
				$new_category = new Category();
				$new_category['name'] = $category;
				$new_category->save(); // ! DB writing here ! 
			}
			// costruisce array di id corrispondenti ai nomi dati
			$category_id = Category::where('name',$category)->first()->id;
			$categories_ids[] = $category_id;
		}
		// aggiungi categorie a questa persona
		$new_user->categories()->sync($categories_ids);
		
		// # GENRES # 

		$genres = array_map('strtolower',$genres);
		$genres_ids = [];
		foreach ($genres as $genre) {
			// se non c'è nella tabella aggiungi
			$db_genres = Genre::all();
			$is_genre_present = false;
			foreach ($db_genres as $db_genre) {
				if ($db_genre->name == $genre) $is_genre_present = true;
			}
			if (!$is_genre_present) {
				$new_genre = new Genre();
				$new_genre['name'] = $genre;
				$new_genre->save(); // ! DB writing here ! 
			}
			// costruisce array di id corrispondenti ai nomi dati
			$genre_id = Genre::where('name',$genre)->first()->id;
			$genres_ids[] = $genre_id;
		}
		// aggiungi categorie a questa persona
		$new_user->genres()->sync($genres_ids);

		// # OFFERS # 

		$offers = array_map('strtolower',$offers);
		$offers_ids = [];
		foreach ($offers as $offer) {
			// se non c'è nella tabella aggiungi
			$db_offers = Offer::all();
			$is_offer_present = false;
			foreach ($db_offers as $db_offer) {
				if ($db_offer->name == $offer) $is_offer_present = true;
			}
			if (!$is_offer_present) {
				$new_offer = new Offer();
				$new_offer['name'] = $offer;
				$new_offer->save(); // ! DB writing here ! 
			}
			// costruisce array di id corrispondenti ai nomi dati
			$offer_id = Offer::where('name',$offer)->first()->id;
			$offers_ids[] = $offer_id;
		}
		// aggiungi categorie a questa persona
		$new_user->offers()->sync($offers_ids);

		// # MESSAGES # 

		$max_num_of_messages = count($messages);
		$num_of_messages = random_int($min_num_of_messages, $max_num_of_messages);
		$rand_messages_keys = array_rand($messages, $num_of_messages);
		if($num_of_messages == 1) $rand_messages_keys = [$rand_messages_keys];
		$rand_messages = [];
		foreach ($rand_messages_keys as $key) {
			$rand_messages[] = $messages[$key];
		}
		foreach ($rand_messages as $message) {
			$new_message = new Message();
			$new_message['user_id'] = $new_user['id'];
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
			$new_message->save(); // ! DB writing here ! 
			// change created_at (backward in time)
			$tmp_datetime = DateTime::createFromFormat('Y-m-d H:i:s', $new_message['created_at']);
			$days = random_int(1, 30);
			$hours = random_int(1, 24);
			$minutes = random_int(1, 59);
			date_sub($tmp_datetime, date_interval_create_from_date_string($days.' days')); 
			date_sub($tmp_datetime, date_interval_create_from_date_string($hours.' hours')); 
			date_sub($tmp_datetime, date_interval_create_from_date_string($minutes.' minutes')); 
			$new_message['created_at'] = date_format($tmp_datetime, 'Y-m-d H:i:s');
			$new_message->update(); // ! DB writing here ! 
		}

		// # REVIEWS # 

		$max_num_of_reviews = count($reviews);
		$num_of_reviews = random_int($min_num_of_reviews, $max_num_of_reviews);
		$rand_reviews_keys = array_rand($reviews, $num_of_reviews);
		if($num_of_reviews == 1) $rand_reviews_keys = [$rand_reviews_keys];
		$rand_reviews = [];
		foreach ($rand_reviews_keys as $key) {
			$rand_reviews[] = $reviews[$key];
		}
		foreach ($rand_reviews as $review) {
			$new_review = new Review();
			$new_review['user_id'] = $new_user['id'];
			$new_review['rev_sender_name'] = $faker->name();
			$new_review['rev_vote'] = $review['rev_vote'];
			$new_review['rev_subject'] = $review['rev_subject']; // ! required for slug
			$new_review['rev_text'] = $review['rev_text'];
			// slug must be unique
			$slug = Str::slug($new_review['rev_subject'],'-');
			$slug_tmp = $slug;
			$slug_is_present = Review::where('slug',$slug)->first();
			$counter = 1;
			while ($slug_is_present) {
				$slug = $slug_tmp.'-'.$counter;
				$counter++;
				$slug_is_present = Review::where('slug',$slug)->first();
			}
			$new_review['slug'] = $slug;
			$new_review->save(); // ! DB writing here ! 
			// change created_at (backward in time)
			$tmp_datetime = DateTime::createFromFormat('Y-m-d H:i:s', $new_review['created_at']);
			$days = random_int(1, 30);
			$hours = random_int(1, 24);
			$minutes = random_int(1, 59);
			date_sub($tmp_datetime, date_interval_create_from_date_string($days.' days')); 
			date_sub($tmp_datetime, date_interval_create_from_date_string($hours.' hours')); 
			date_sub($tmp_datetime, date_interval_create_from_date_string($minutes.' minutes')); 
			$new_review['created_at'] = date_format($tmp_datetime, 'Y-m-d H:i:s');
			$new_review->update(); // ! DB writing here ! 
		}

		// # CONTRACTS # 

		// list of sponsorship's id
		$db_sponsosrships = Sponsorship::all();
		foreach ($db_sponsosrships as $db_sponsosrship) $db_sponsosrship_ids[] = $db_sponsosrship->id;
		// * PAST CONTRACTS (expired) *
		$number_of_past_contracts = random_int($min_number_of_past_contracts,$max_number_of_past_contracts);
		// now & cycle frontier
		date_default_timezone_set('Europe/Rome');
		$tmp_time = new DateTime();
		for ($i=0; $i<$number_of_past_contracts; $i++) {
			$new_contract = new Contract;
			$new_contract['user_id'] = $new_user['id'];
			// contract with randomly selected sponsorship
			$new_contract['sponsorship_id'] = $db_sponsosrship_ids[random_int(0,count($db_sponsosrship_ids)-1)];
			$sel_sponsorship = Sponsorship::where('id',$new_contract['sponsorship_id'])->first();
			// --------------|----------------------|----------------------|----------------------|----------------------|
			//                                                                              start = tmp_time-24      end = tmp_time
			//                                                       start = tmp_time-144     end = tmp_time
			//                                start = tmp_time-24      end = tmp_time 
			//         start = tmp_time-72      end = tmp_time
			// --------------|----------------------|----------------------|----------------------|----------------------|
			$date_db_end   = date_format($tmp_time, 'Y-m-d H:i:s');
			date_sub($tmp_time, date_interval_create_from_date_string($sel_sponsorship->hour_duration.' hours'));
			$date_db_start = date_format($tmp_time, 'Y-m-d H:i:s');
			// results...
			$new_contract['date_start'] = $date_db_start;
			$new_contract['date_end'] 	= $date_db_end;
			$new_contract['transaction_status'] = 'submitted_for_settlement';
			$new_contract->save(); // ! DB writing here ! 
		}
		// * PRESENT CONTRACTS (if any) *
		if ($is_active_contract) {
			$new_contract = new Contract;
			$new_contract['user_id'] = $new_user['id'];
			$new_contract['sponsorship_id'] = $db_sponsosrship_ids[random_int(0,count($db_sponsosrship_ids)-1)];
			$sel_sponsorship = Sponsorship::where('id',$new_contract['sponsorship_id'])->first();
			date_default_timezone_set('Europe/Rome');
			$now = new DateTime();
			$date_db_start = date_format($now, 'Y-m-d H:i:s');
			date_add($now, date_interval_create_from_date_string($sel_sponsorship->hour_duration.' hours'));
			$date_db_end = date_format($now, 'Y-m-d H:i:s');
			$new_contract['date_start'] = $date_db_start;
			$new_contract['date_end'] 	= $date_db_end;
			$new_contract['transaction_status'] = 'submitted_for_settlement';
			$new_contract->save(); // ! DB writing here !
		}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
}
