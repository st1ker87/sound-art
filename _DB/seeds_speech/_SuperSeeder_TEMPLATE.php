<?php

use Illuminate\Database\Seeder;
use App\Profile;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SuperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		// @php $pars = preg_split("/\r\n|\n|\r/", $post['content']); @endphp
		// @foreach ($pars as $par) <p>{{$par}}</p> @endforeach
	

		// % USER % 
		$name 		= 'Kate';
		$surname 	= 'Glock';

		// % PROFILE % 
		$work_town		= 'London, UK';
		$work_address 	= '168A Grange Rd, London SE1 3BN';
		$phone 			= '+44 378 922 25 66';

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

		// * ??
		$bio_text3 = "";

		// * Preview text (for short presentation in Search Pages)
		$bio_text4 = "Professional touring singer/songwriter based out of London, from East European origin.";

		$image_url = 'profile_image/IMG_4960.jpg';

		// % CATEGORIES % 
		$category = ['lyricist','topliner','vocalist'];
		
		// % GENRES % 


		// % OFFERS % 


		// % MESSAGES % 


		// % REVIEWS % 


		// % CONTRACTS % 



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
		$new_profile['image_url'] = $image_url;
		$new_profile['public'] = 1;
		$new_profile->save(); // ! DB writing here ! 



















    }
}
