<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Classes\IsNowInInterval;
use DateTime;

use App\User;
use App\Profile;
use App\Category;
use App\Genre;
use App\Offer;

class ProfileController extends Controller
{
    /**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %             SHOW              %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * 
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show($slug) // originale: show(Profile $profile)
    {
		$data = [
			'profile' => Profile::where('slug',$slug)->first(),
 		];

		if(!$data['profile']) {
			abort(404);
		}

		return view('admin.profiles.show',$data);
    }

    /**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %            CREATE             %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		// only logged users without profile can create
		$profile_is_present = Profile::where('user_id',Auth::user()->id)->first();
		if ($profile_is_present) 
			return redirect()->route('dashboard')->with('status','Profile already exists!');

		$data = [
			'categories'	=> Category::all(),
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
		];

		if(!$data['categories'] || !$data['genres'] || !$data['offers']) {
			abort(404);
		}

		return view('admin.profiles.create',$data);
    }

    /**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %             STORE             %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		// only logged users without profile can store
		$profile_is_present = Profile::where('user_id',Auth::user()->id)->first();
		if ($profile_is_present) 
			return redirect()->route('dashboard')->with('status','Profile already exists!');

        $form_data = $request->all();
		
		// validazione parte post 
		$this->profileValidation($request,'store');

		// utente che crea il profilo
		$user = Auth::user();

		// $new_profile è il nuovo profile da mettere in DB 
		$new_profile = new Profile;

		// id user che crea il post
		$new_profile['user_id'] = Auth::id();

		// generazione slug da nome e cognome di me stesso!
		$pre_slug = $user->name.' '.$user->surname;
		$new_profile['slug'] = $this->slugGeneration($pre_slug);

		// gestione immagine
		if(array_key_exists('image_url',$form_data)) {
			$image_path = Storage::put('profile_image',$form_data['image_url']);
			$form_data['image_url'] = $image_path; 
		}

		// gestione video
		if(array_key_exists('video_url',$form_data)) {
			$image_path = Storage::put('profile_video',$form_data['video_url']);
			$form_data['video_url'] = $image_path; 
		}

		// gestione audio
		if(array_key_exists('audio_url',$form_data)) {
			$image_path = Storage::put('profile_audio',$form_data['audio_url']);
			$form_data['audio_url'] = $image_path; 
		}

		// il nuovo profile acquisisce i dati del form e viene buttato nel DB
		$new_profile->fill($form_data);
		$new_profile->save(); // ! DB writing here !

		// pivot tables for categories, genres, offers
		if(array_key_exists('categories', $form_data)) 
			$user->categories()->sync($form_data['categories']);
		if(array_key_exists('genres', $form_data)) 
			$user->genres()->sync($form_data['genres']);
		if(array_key_exists('offers', $form_data))
			$user->offers()->sync($form_data['offers']);

		return redirect()->route('dashboard')->with('status','Profile created');
    }

    /**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %             EDIT              %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * 
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) // originale: edit(Profile $profile)
    {
		// only logged profile owner can edit
		$my_slug = Auth::user()->profile->slug;
		if ($slug != $my_slug) 
			return redirect()->route('dashboard');

		$data = [
			'profile' 		=> Profile::where('slug',$slug)->first(),
			'categories'	=> Category::all(),
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
 		];

		if(!$data['profile'] || !$data['categories'] || !$data['genres'] || !$data['offers']) {
			abort(404);
		}

		return view('admin.profiles.edit',$data);
    }

    /**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %            UPDATE             %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
		// only logged profile owner can update
		if ($profile->user_id != Auth::id())
			return redirect()->route('dashboard');

		$form_data = $request->all();
			
		// validazione parte post 
		$this->profileValidation($request,'update');
	  
		// gestione media
		if(array_key_exists('image_url',$form_data)) {
			$image_path = Storage::put('profile_image',$form_data['image_url']);
			$form_data['image_url'] = $image_path; 
		}
		if(array_key_exists('video_url',$form_data)) {
			$image_path = Storage::put('profile_video',$form_data['video_url']);
			$form_data['video_url'] = $image_path; 
		}	
		if(array_key_exists('audio_url',$form_data)) {
			$image_path = Storage::put('profile_audio',$form_data['audio_url']);
			$form_data['audio_url'] = $image_path; 
		}

		// profile update
		$profile->update($form_data);

		// pivot tables for categories, genres, offers
		$user = Auth::user();
		if(array_key_exists('categories', $form_data)) 
			$user->categories()->sync($form_data['categories']);
		else 
			$user->categories()->sync([]);
		if(array_key_exists('genres', $form_data)) 
			$user->genres()->sync($form_data['genres']);
		else
			$user->genres()->sync([]);
		if(array_key_exists('offers', $form_data))
			$user->offers()->sync($form_data['offers']);
		else
			$user->offers()->sync([]);
      
		return redirect()->route('dashboard')->with('status','Profile udated');
    }

    /**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %            DESTROY            %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * 
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // originale: destroy(Profile $profile)
    {
		// il profile in questione
		$profile = Profile::find($id);
		
		// only logged profile owner can destroy
		if ($profile->user_id != Auth::id())
			return redirect()->route('dashboard');

		// lo user corrispondente a questo profile
		$user = User::where('id',$profile->user->id)->first();

		// cancellare le relazioni user-tag presenti nelle pivot
		$user->categories()->sync([]);
		$user->genres()->sync([]);
		$user->offers()->sync([]);

		// interruzione sponsorship attiva
		date_default_timezone_set('Europe/Rome');
		foreach ($user->contracts as $contract) {
			if ((new IsNowInInterval)->get($contract->date_start,$contract->date_end)) {;
				$contract['date_end'] = (new DateTime())->format('Y-m-d H:i:s');
				$contract->update();
			}		
		}

		// cancellare il profile
		$profile->delete();

		// ! lo user non ha più un profile 
		// ! ma conserva messages, reviews, cotracts (collegati a user)

		return redirect()->route('dashboard')->with('status','Profile deleted');
    }


	/**
	 * #################################
	 * #       PROFILE VALIDATION      #
	 * #################################
     *
	 * Profile: form data validation
	 * https://laravel.com/docs/7.x/validation
	 * errors shown in EDIT/CREATE view
	 * 
	 * @param  \Illuminate\Http\Request  $req
	 */
	protected function profileValidation($req,$method) {
		$image_val = (($method=='update') ? '' : 'required|').'mimes:jpg,png,jpeg,gif,svg|max:2048';
		$req->validate([
			'work_town'		=> 'required|max:255',
			'work_address'	=> 'max:255',
			'phone'			=> 'max:25',
			'bio_text1'		=> 'required',
			// 'bio_text2'		=> '',
			// 'bio_text3'		=> '',
			'bio_text4'		=> 'required',
			'image_url'		=> $image_val,  // required non possibile in edit se immagine e già presente e un'altra non è caricata
			'categories'	=> 'required',
			'offers'		=> 'required',
		]);
	}

	/**
	 * #################################
	 * #          PROFILE SLUG         #
	 * #################################
     *
	 * Creazione slug a partire da stringa sorgente
	 * deve essere unico nellla tabella profiles
	 * 
	 * @param string $slug_source
	 * @return string
	 */
	protected function slugGeneration($slug_source) {
		$slug = Str::slug($slug_source,'-');
		$slug_tmp = $slug;
		$slug_is_present = Profile::where('slug',$slug)->first();
		$counter = 1;
		while ($slug_is_present) {
			$slug = $slug_tmp.'-'.$counter;
			$counter++;
			$slug_is_present = Profile::where('slug',$slug)->first();
		}
		return $slug;
	}












	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//
	}




}
















