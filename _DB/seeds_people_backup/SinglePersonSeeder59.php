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

class SinglePersonSeeder59 extends Seeder
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
	 * copy use ...
	 * copy run(Faker $faker)
	 * copy //////...//////
	 * php artisan db:seed --class=SinglePersonSeederN (change N)
	 * 
	 */

	// #################################################################################################################
	// #  MINIMAL EDIT START                                                                                            


		// % USER % 

		$name 		= 'Tom';
		$surname 	= 'Spiker';

		// % PROFILE % 

		$work_town		= 'Philadelphia, PA, USA';
		$work_address 	= '115 W Lehigh Ave, Philadelphia, PA 19133';
		$phone 			= '+1 21 5634 9053';

		/**
		 * ! TESTO
		 * !	>> copiare testo da soundbetter, dividendo in 2 o 3 parti (per ogni bio_text1,2,3)
		 * ! 	>> ATTENZIONE all'escape di eventuali doppi apici (") dentro il testo ( " diventa \" )
		 * ! 	>> lasciare una riga vuota nel testo per separare i paragafi (renderizzazione introdotta in pagina)
		 * ! 	>> bio_text3 può essere lasciato vuoto
		 */

		// * About me
		$bio_text1 = 
			"One-stop shop production, mixing, tracking and session work based in Philadelphia, Pa. Past clients (studio or live) include Meghan Trainor, Bilal, Talib Kweli, Kelis, Ellie Goulding, Burhan O'cal, G Love and members of the Sun Ra Arkestra. I'm new here, so let's get something going!

			20+ years of professional experience. I’ve toured on guitar and bass (as well as light keys and percussion) with Internationally known singer-songwriters, rnb/hip hop artists, jazz groups, and Bollywood artists. I have a jazz background, but my taste and experience spans multiple genres.
			
			Home base is Undercarriage Recording in Philadelphia, Pa. Undercarriage is equipped with 10 channels of DW Fearn mic pres (nothing compares!), a Fearn VT7 compressor, a slew of great instruments and too many other great tools and toys to mention here.
			
			A full gear list is here:
			
			http://www.undercarriagerecording.com/gear-list/
			
			I work primarily in Pro Tools HD Native, but I can get around Ableton and Logic in a pinch and have the ability to do transfers between DAWs.
			
			I want to stress that I’m an easy and fun collaborator and will definitely put the artist's vision first. No producer bullying!! I greatly respect the balance of staying out of the way of the music or taking control as needed. Equally happy keeping it simple or getting super weird!
			
			Misc. other offerings:
			
			Pro Tools editing

			Vocal comping/tuning

			Pedal steel guitar

			Acoustic guitar

			Upright bass

			Ambient sound design
			
			Contact me through the blue button above and let's get to work.";

		// * Professional Services
		$bio_text2 = "";

		// * Extra informations
		$bio_text3 = "";

		// * Preview text (for short presentation in Search Pages)
		$bio_text4 = "One-stop shop production, mixing, tracking and session work based in Philadelphia";

		/**
		 * ! IMMAGINE
		 * !	>> scaricare immagine da soundbetter (inspector > Application > Frames > top > Images)
		 * !    >> posizionare dentro /storage/app/public/profile_image/ (!! NON dentro /public/storage/ !!)
		 * !    >> tenere il nome orginale dell'immagine e inserirlo in $image_name (! solo il nome !)
		 */

		 $image_name = 'SPIKER-5506.jpg';

		/**
		 * ! CATEGORIES, GENRES, OFFERS
		 * !	>> si possono usare categories, genres, offer già presenti nei rispettivi seeder
		 * !    >> si possono introdurre nuove categories, genres, offer (vengono aggiunte nel DB)
		 */

		// % CATEGORIES % 

		$categories = ['Producer','Mixer']; // ! obbligatorio ! 
		
		// % GENRES % 

		$genres = ['Blues','Jazz','R&B','Soul','Reggae','Soundtrack'];  

		// % OFFERS % 

		$offers = ['recording','mixing','editing']; // ! obbligatorio !

		// % MESSAGES % 

		$min_num_of_messages = 7; // max 25 (src list)

		// % REVIEWS % 

		$min_num_of_reviews = 10; // max 25 (src list)

		// % CONTRACTS % 

		$min_number_of_past_contracts = 2; // less than max
		$max_number_of_past_contracts = 6; // no limits
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
