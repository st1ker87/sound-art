<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Profile;
use App\Category;
use App\Genre;
use App\Offer;
use App\Message;
use App\Review;

class ProfileController extends Controller
{
	/**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %             INDEX             %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data = [
			'users' 		=> User::all(),
			'profiles' 		=> Profile::all(),
			'categories' 	=> Category::all(),
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
			'messages' 		=> Message::all(),
			'reviews' 		=> Review::all(),
 		];
        return view('admin.profiles.index',$data);
    }

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
			// main info: passed profile
			'profile' 		=> Profile::where('slug',$slug)->first(),
			// aux infos: db tables
			'users' 		=> User::all(),
			'profiles'		=> Profile::all(),
			'categories'	=> Category::all(),
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
			'messages' 		=> Message::all(),
			'reviews' 		=> Review::all(),
			// ! info assemblate
			// ! da definire
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
		$data = [
			'users' 		=> User::all(),
			'profiles'		=> Profile::all(),
			'categories'	=> Category::all(),
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
			'messages' 		=> Message::all(),
			'reviews' 		=> Review::all(),
		];

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
        $form_data = $request->all();
		
		// validazione parte post 
		$this->profileValidation($request);

		// $new_profile è il nuovo profile da mettere in DB 
		$new_profile = new Profile;

		// id user che crea il post
		$new_profile['user_id'] = Auth::id();

		// generazione slug da nome e cognome di me stesso!
		$user = Auth::user();
		$pre_slug = $user->name.' '.$user->surname;
		$new_profile['slug'] = $this->slugGeneration($pre_slug);

		// gestione immagine
		if(array_key_exists('image_url',$form_data)) {
			// salvo immagine in /storage/app/public/profile_image/ e recupero path
			// ! qui viene definita la cartella /profile_image/ dentro /public/ !
			$image_path = Storage::put('profile_image',$form_data['image_url']);
			// @dump($image_path);
			// modifico il default path del form
			$form_data['image_url'] = $image_path; 
		}

		// gestione video
		if(array_key_exists('video_url',$form_data)) {
			// salvo immagine in /storage/app/public/profile_video/ e recupero path
			// ! qui viene definita la cartella /profile_video/ dentro /public/ !
			$image_path = Storage::put('profile_video',$form_data['video_url']);
			// @dump($image_path);
			// modifico il default path del form
			$form_data['video_url'] = $image_path; 
		}

		// gestione audio
		if(array_key_exists('audio_url',$form_data)) {
			// salvo immagine in /storage/app/public/profile_audio/ e recupero path
			// ! qui viene definita la cartella /profile_audio/ dentro /public/ !
			$image_path = Storage::put('profile_audio',$form_data['audio_url']);
			// @dump($image_path);
			// modifico il default path del form
			$form_data['audio_url'] = $image_path; 
		}

		// ! aggiungo $new_profile nella table profiles; NON sono qui i 3 tag !
		// il nuovo profile acquisisce i dati del form e viene buttato nel DB
		$new_profile->fill($form_data);
		$new_profile->save(); // ! DB writing here !

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
		$data = [
			// main info: passed profile
			'profile' 		=> Profile::where('slug',$slug)->first(),
			// aux infos: db tables
			'users' 		=> User::all(),
			'profiles'		=> Profile::all(),
			'categories'	=> Category::all(),
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
			'messages' 		=> Message::all(),
			'reviews' 		=> Review::all(),
			// ! info assemblate
			// ! da definire
 		];

		if(!$data['profile']) {
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
		// faccio cose


        // alla fine torno in dashboard
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

		// lo user corrispondente a questo profile
		$user = User::where('id',$profile->user->id)->first();

		// cancellare le relazioni user-tag presenti nelle pivot
		// boolpress: $post->tags()->sync([]);
		$user->categories()->sync([]);
		$user->genres()->sync([]);
		$user->offers()->sync([]);

		// cancellare il profile $id
		// boolpress: $post->delete();
		$profile->delete();

		// ! lo user non ha più un profile 
		// ! ma potrebbe ancora avere messages, reviews, cotracts (collegati a user)
		// ! che fare?

 		// alla fine torno in dashboard
		return redirect()->route('dashboard')->with('status','Profile deleted');
    }


	/**
	 * Profile: form data validation
	 * https://laravel.com/docs/7.x/validation
	 * errors shown in EDIT/CREATE view
	 * 
	 * @param  \Illuminate\Http\Request  $req
	 */
	protected function profileValidation($req) {
		// $req->validate([
		// 	'title'		=> 'required|max:255',
		// 	'content'	=> 'required'
		// ]);
	}

	/**
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






}
