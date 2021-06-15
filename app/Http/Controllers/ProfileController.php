<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Category;
use App\Genre;
use App\Offer;

class ProfileController extends Controller
{
	/**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %   ADVANCED SEARCH no filter   %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 *  
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search() // index()
    {
		$data = [
			'users' 		=> User::all(),
			'profiles' 		=> Profile::all(),
			'categories' 	=> Category::all(),
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
 		];
        return view('guest.profiles.search',$data);
    }

    /**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %  ADVANCED SEARCH with filter  %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
     *
     * @return \Illuminate\Http\Response
     */
    public function search_from_home(Request $request)
    {
        $form_data = $request->all();
		
		// ! tutto questo va pensato in funzione delle info GIÀ MONTATE necessarie in pagina
		// ! non ne abbiamo ancora un'idea chiara 
        // $search_from_home = [];
        // $search_from_home['id'] = $form_data['id'];
        // if (array_key_exists('category', $form_data)) {
        //     $search_from_home['category'] = $form_data['category'];   
        // }
        // else {
        //     $search_from_home['genre'] = $form_data['genre'];
        // }

		// ! cosa serve qua da passare alla pagina ?

		$data = [
			// ! parte generica: tabelle DB disaccoppiate
			// ! con queste si può fare tutto, ma lato pagina
			'users' 		=> User::all(),
			'profiles' 		=> Profile::all(),
			'categories' 	=> Category::all(),
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
			// ! parte specifica: info DB GIÀ ASSEMBLATE
			// ! da definire 
            // 'search_from_home' => $search_from_home
 		];
        return view('guest.profiles.search',$data); // CRUD index profiles 
    }












    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        // dettaglio profilo 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
