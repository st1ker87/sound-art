<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
		
		// fa cose per salvare i dati 


		// slug: lo creo da users-name/surname e controllo unicità in DB
		
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

		// il corrispondente user_id ($id è l'id del profile!)
		$user_id = $profile->user_id;
		@dd($user_id);

		// lo user corrispondente a questo profile
		$user = User::where('id',$user_id)->first();

		// cancellare le relazioni user-tag presenti nelle pivot
		// boolpress: $post->tags()->sync([]);
		$user->categories()->sync([]);
		$user->genres()->sync([]);
		$user->offers()->sync([]);

		// cancellare il profile $id
		// boolpress: $post->delete();
		$profile->delete();

		// ! lo user non ha più un profile 
		// ! ma potrebbe ancora avere messages e reviews (collegati a user)
		// ! che fare?

 		// alla fine torno in dashboard
		return redirect()->route('dashboard')->with('status','Profile deleted');
    }
}
