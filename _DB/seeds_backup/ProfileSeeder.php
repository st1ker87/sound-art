<?php

use Illuminate\Database\Seeder;
use App\Profile;
use App\User;
use Illuminate\Support\Str;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		/** 
		 * ! ************************************* !
		 * !                                       !
		 * ! ESEGUIRE SOLO DOPO SEED TABELLA USERS !
		 * !                                       !
		 * ! ************************************* !
		 */

		/**
		 * Profile Model $fillable:
		 * 	'user_id','slug',
		 * 	'work_town','work_address','work_address_gps','phone',
		 * 	'bio_text1','bio_text2','bio_text3','bio_text4','image_url','video_url','audio_url','public'
		 */
	
		$work_towns 	= ['Milano','Bologna','Roma','Napoli','Trieste','Avellino','Firenze','Cuneo','Foggia','Torino','Brescia','Ravenna','Cremona','Pesaro','Rimini','Cagliari'];
		$work_addresses = ['Via Santo Stefano 3','Via Spirito Eterno 2','Via Giuseppe Garibaldi 1','Piazza Duca D\'Aosta 33','Via Gramsci 87','Via De Gasperi 34','Via Cavour 8','Corso Indipendenza 3','Corso Unione Sovietica 1','Corso XX Settembre 109','Via Parini 2','Via Dante 3','Via Torquato Tasso 76','Via Montenapoleone 1','Piazza Einaudi 8','Piazza Oberdan 21'];
		$phones			= ['+39 339 45 23 777','+39 440 56 23 777','+39 551 45 34 777','+39 662 54 23 777','+39 773 46 23 777','+39 884 45 34 777','+39 995 54 23 777','+39 006 45 32 777','+39 112 67 23 777','+39 223 45 23 777','+39 334 45 23 777','+39 445 45 23 777','+39 445 00 32 777','+39 445 11 43 777','+39 445 23 23 777','+39 667 45 00 777'];
		$bio_text_long 	= 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
		$bio_text_short = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

		$users = User::All();

		foreach($users as $user) {

			$work_town 		= $work_towns[random_int(0,count($work_towns)-1)];
			$work_address 	= $work_addresses[random_int(0,count($work_addresses)-1)];
			$phone 			= $phones[random_int(0,count($phones)-1)];
			// slug must be unique
			$slug = Str::slug($user['name'].' '.$user['surname'],'-');
			$slug_tmp = $slug;
			$slug_is_present = Profile::where('slug',$slug)->first();
			$counter = 1;
			while ($slug_is_present) {
				$slug = $slug_tmp.'-'.$counter;
				$counter++;
				$slug_is_present = Profile::where('slug',$slug)->first();
			}

			$new_profile = new Profile();
			$new_profile['user_id'] = $user['id']; // ! deve essere un id ESISTENTE della tabella users > eseguire DOPO seed users
			$new_profile['slug'] = $slug;	
			$new_profile['work_town'] = $work_town;
			$new_profile['work_address'] = $work_address;
			$new_profile['work_address_gps'] = '';
			$new_profile['phone'] = $phone;
			$new_profile['bio_text1'] = $bio_text_long;
			$new_profile['bio_text2'] = $bio_text_long;
			$new_profile['bio_text3'] = $bio_text_long;
			$new_profile['bio_text4'] = $bio_text_short;
			$new_profile['image_url'] = 'profile_image/image_placeholder.jpg';
			$new_profile['video_url'] = 'profile_video/video_placeholder.mp4';
			$new_profile['audio_url'] = 'profile_audio/audio_placeholder.mp3';
			$new_profile['public'] = 1;
			$new_profile->save(); // ! DB writing here ! 
	

		}

    }
}
