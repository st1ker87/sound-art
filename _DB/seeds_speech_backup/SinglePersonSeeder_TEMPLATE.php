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

class SinglePersonSeeder extends Seeder
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
		$is_active_contract = 1; // 1 or 0


	// #  MINIMAL EDIT END                                                                                              
	// #################################################################################################################

		/**
		 * ! MESSAGES & REVIEWS (lista sorgente per numero di item randomici con limiti definiti sopra)
		 * !	>> inventare o copiare da soundbetter
		 * !	>> NON lasciare campi obbligatori vuoti
		 * !    >> per ridurre/aumentare il numero di messaggi/review eliminare/duplicare i corrispondenti elementi dagli array
		 * !	>> nel subject potete spostare l'inizio del text (togliendolo dal text)
		 * !	>> messaggi generici: copiabili anche per altri profili
		 * ! 	>> ATTENZIONE all'escape di eventuali doppi apici (") dentro il testo ( " diventa \" )
		 */

		// # MESSAGES (src list) # 

		$messages = [
			[
				'msg_subject' => "Collaboration", // ! obbligatorio !
				'msg_text'    => "We are interested in a collaboration for our productions. I'll be in touch next week", // ! obbligatorio !
			],
			[
				'msg_subject' => "I need your services", // ! obbligatorio !
				'msg_text'    => "Your talent is amazing! I'm compleyely bewitched. I'll contact you for learn more about you", // ! obbligatorio !
			],
			[
				'msg_subject' => "We would like to know you", // ! obbligatorio !
				'msg_text'    => "We are interested in your services. Please call +44 333 765 2956 or email us. Regards", // ! obbligatorio !
			],
			[
				'msg_subject' => "Hiring proposal", // ! obbligatorio !
				'msg_text'    => "Please contact us for a very important proposal about our events. Cheers", // ! obbligatorio !
			],
			[
				'msg_subject' => "Hiring proposal", // ! obbligatorio !
				'msg_text'    => "Wery interested in your work. Please email us. Regards", // ! obbligatorio !
			],
			[
				'msg_subject' => "Contact", // ! obbligatorio !
				'msg_text'    => "I'll call you in few days", // ! obbligatorio !
			],
			[
				'msg_subject' => "Hiring", // ! obbligatorio !
				'msg_text'    => "I find you very talented. Need your work. Please contact me", // ! obbligatorio !
			],
			[
				'msg_subject' => "Discuss rates", // ! obbligatorio !
				'msg_text'    => "If you agree to organize a meeting at your earliest convenience, we would likne to discuss rates and details", // ! obbligatorio !
			],
			[
				'msg_subject' => "Very fascinating", // ! obbligatorio !
				'msg_text'    => "Please contact me at +44 789 234 33 25", // ! obbligatorio !
			],
			[
				'msg_subject' => "Hiring", // ! obbligatorio !
				'msg_text'    => "We are intrestad in your activities. We'll get in touch for hiring", // ! obbligatorio !
			],
			[
				'msg_subject' => "Proposal", // ! obbligatorio !
				'msg_text'    => "", // ! obbligatorio !
			],
			[
				'msg_subject' => "Intrested", // ! obbligatorio !
				'msg_text'    => "I'd like to know if you could be interested in some kind of collaboration with my Record company.", // ! obbligatorio !
			],
			[
				'msg_subject' => "We need you", // ! obbligatorio !
				'msg_text'    => "Email us as soon as possible", // ! obbligatorio !
			],
			[
				'msg_subject' => "Collaboration and more", // ! obbligatorio !
				'msg_text'    => "Please accept a date with me", // ! obbligatorio !
			],
			[
				'msg_subject' => "Collaboration", // ! obbligatorio !
				'msg_text'    => "We have been in the Industry for almost a century and we would like to meet you for a colaboration. Regards", // ! obbligatorio !
			],
			[
				'msg_subject' => "Amazing job!", // ! obbligatorio !
				'msg_text'    => "I absolutely like you pro skill and I was wandering if you are available for a live event next month. Please contact me", // ! obbligatorio !
			],
			[
				'msg_subject' => "Love your productions", // ! obbligatorio !
				'msg_text'    => "Interested in some collaboration. Please call me at this number +44 654 372 89 22", // ! obbligatorio !
			],
			[
				'msg_subject' => "We are looking for a pro like you", // ! obbligatorio !
				'msg_text'    => "For concerts and recordings. We are a new company in this industry. Email us please", // ! obbligatorio !
			],
			[
				'msg_subject' => "Eventually someone who we were expecting for", // ! obbligatorio !
				'msg_text'    => "We are interested in your pro services. Let's stay in touch", // ! obbligatorio !
			],
			[
				'msg_subject' => "Hiring proposal", // ! obbligatorio !
				'msg_text'    => "Please let us know how to reach you for a collaboration.", // ! obbligatorio !
			],
			[
				'msg_subject' => "Intresting solutions for you", // ! obbligatorio !
				'msg_text'    => "We would like to have your attention on our services. We are able to provide you with serveral solutions for you career.", // ! obbligatorio !
			],
			[
				'msg_subject' => "We can help each other", // ! obbligatorio !
				'msg_text'    => "It would be our pleasure to show you all services we provide for professionals like you. Please let us know how to reach you", // ! obbligatorio !
			],
			[
				'msg_subject' => "Dogs&Cats Records Inc.", // ! obbligatorio !
				'msg_text'    => "We was wondering if your performances are suitable for our productions.", // ! obbligatorio !
			],
			[
				'msg_subject' => "Collaboration search", // ! obbligatorio !
				'msg_text'    => "We are looking for a pro like you. Please accept our meeting proposal the last week of next month.", // ! obbligatorio !
			],
			[
				'msg_subject' => "Boolean hiring programme", // ! obbligatorio !
				'msg_text'    => "We are seeking entertrainers for our prom", // ! obbligatorio !
			],
		];

		// # REVIEWS (src list) # 

		$reviews = [
			[
				'rev_vote'    => 4,  // ! obbligatorio !
				'rev_subject' => "Very good!", // ! obbligatorio !
				'rev_text'    => "Its so good to be back working with this professional again! she did another amazing job and we are both super excited to work on the rest of the songs i got in plan.",
			],
			[
				'rev_vote'    => 5,  // ! obbligatorio !
				'rev_subject' => "All amazing", // ! obbligatorio !
				'rev_text'    => "Amazing singer! Delivered what I wanted, and more!",
			],
			[
				'rev_vote'    => 5,  // ! obbligatorio !
				'rev_subject' => "Five stars!!!!", // ! obbligatorio !
				'rev_text'    => "This professional is my favorite person to work with. Great vocals, suggestions to make your songs better, and a great personality! always a joy to come back and work with her. I will be back to work with her for my second album! going to be amazing.",
			],
			[
				'rev_vote'    => 5,  // ! obbligatorio !
				'rev_subject' => "A pro from top to bottom!", // ! obbligatorio !
				'rev_text'    => "Such an easy going, down to earth, fun experience working with this artist! Will definitely want to do another project with her. warmly recommended!",
			],
			[
				'rev_vote'    => 4, // ! obbligatorio !
				'rev_subject' => "Effortless", // ! obbligatorio !
				'rev_text'    => "Making new music with this artist has become almost effortless now. We know how each other works and what each other wants. I am doing my best work i have ever done with Kate. She just adds so much to my stuff and takes it to the next level. 5/5 again no surprise there :)",
			],
			[
				'rev_vote'    => 2, // ! obbligatorio !
				'rev_subject' => "Disappointed Expectations", // ! obbligatorio !
				'rev_text'    => "",
			],
			[
				'rev_vote'    => 3, // ! obbligatorio !
				'rev_subject' => "Something cheaper would be better", // ! obbligatorio !
				'rev_text'    => "Nothing to complain but the fee",
			],
			[
				'rev_vote'    => 5, // ! obbligatorio !
				'rev_subject' => "Very easy to work with", // ! obbligatorio !
				'rev_text'    => "We got this done at its best. Very easy to work with. Good results. What more could you ask for?",
			],
			[
				'rev_vote'    => 4, // ! obbligatorio !
				'rev_subject' => "Achieved what I wanted", // ! obbligatorio !
				'rev_text'    => "Very professional and quick. Clearly looked over my rough way, references, and suggestions well to make sure we were on the same page and it was easy to work with him to edit and achieve sound I wanted.",
			],
			[
				'rev_vote'    => 5, // ! obbligatorio !
				'rev_subject' => "Finished ahead of schedule!", // ! obbligatorio !
				'rev_text'    => "This is the third song we have done with this artist and this was our tightest schedule yet. We stepped up to the plate and made sure we got it done. We actually finished ahead of schedule!",
			],
			[
				'rev_vote'    => 4, // ! obbligatorio !
				'rev_subject' => "Would recommend!", // ! obbligatorio !
				'rev_text'    => "Great to work with and keeps a great line of communication. Would recommend!",
			],
			[
				'rev_vote'    => 3, // ! obbligatorio !
				'rev_subject' => "Almost satisfiend", // ! obbligatorio !
				'rev_text'    => "Starting with some problem and finishing with decent work done.",
			],
			[
				'rev_vote'    => 4, // ! obbligatorio !
				'rev_subject' => "Very good", // ! obbligatorio !
				'rev_text'    => "This artist is a talented and versatile professional with a beautiful attitude that works across genres.",
			],
			[
				'rev_vote'    => 5, // ! obbligatorio !
				'rev_subject' => "Great experience", // ! obbligatorio !
				'rev_text'    => "Super professional and nice, looking forward to our next cooperation!!!",
			],
			[
				'rev_vote'    => 2, // ! obbligatorio !
				'rev_subject' => "Difficult communication", // ! obbligatorio !
				'rev_text'    => "",
			],
			[
				'rev_vote'    => 1, // ! obbligatorio !
				'rev_subject' => "Not achieved my goal", // ! obbligatorio !
				'rev_text'    => "",
			],
			[
				'rev_vote'    => 1, // ! obbligatorio !
				'rev_subject' => "I don't like the professional attitude", // ! obbligatorio !
				'rev_text'    => "",
			],
			[
				'rev_vote'    => 5, // ! obbligatorio !
				'rev_subject' => "KILLER!", // ! obbligatorio !
				'rev_text'    => "We are always blown away with the results, but this time was even more awesome than we could have imagined. Amazing person. LOVE working with this artist.",
			],
			[
				'rev_vote'    => 5, // ! obbligatorio !
				'rev_subject' => "An absolute star!", // ! obbligatorio !
				'rev_text'    => "I provided a type of sound and style that I was looking for, after a very short while he sent over EXACTLY what I was looking for AND played it, that’s both dedication and custom care! An awesome guy and great musician, will definitely hire again and so should you",
			],
			[
				'rev_vote'    => 3, // ! obbligatorio !
				'rev_subject' => "A joy to work with but...", // ! obbligatorio !
				'rev_text'    => "A true pro who can create the beat you're looking for. Some high rate though",
			],
			[
				'rev_vote'    => 5, // ! obbligatorio !
				'rev_subject' => "A ninja! 10/10", // ! obbligatorio !
				'rev_text'    => "",
			],
			[
				'rev_vote'    => 5, // ! obbligatorio !
				'rev_subject' => "Always an amazing job!!!", // ! obbligatorio !
				'rev_text'    => "This artist goes above and beyond to make the client happy. I wouldn't use another pro!!!!",
			],
			[
				'rev_vote'    => 4, // ! obbligatorio !
				'rev_subject' => "Love his work.", // ! obbligatorio !
				'rev_text'    => "An outstanding creative individual to work with. Versatile and responsive artist and seeks to find the best “take” for a song.",
			],
			[
				'rev_vote'    => 4, // ! obbligatorio !
				'rev_subject' => "Quite good", // ! obbligatorio !
				'rev_text'    => "Recommended! Very cooperative and talented.",
			],
			[
				'rev_vote'    => 2, // ! obbligatorio !
				'rev_subject' => "What could I say...", // ! obbligatorio !
				'rev_text'    => "Yes and no",
			],
		];

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
