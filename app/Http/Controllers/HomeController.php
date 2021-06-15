<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Category;
use App\Genre;
use App\Offer;

class HomeController extends Controller
{
    /**
     * ! HOME
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$data = [
			'users' 		=> User::all(),
			'profiles' 		=> Profile::all(),
			'categories' 	=> Category::all(),
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
 		];
        return view('home',$data);
    }

	// ! dismessa da qua e inserita in Admin/HomeController@dashboard
	// /**
    //  * ! DASHBOARD
    //  *
    //  * @return \Illuminate\Contracts\Support\Renderable
    //  */
    // public function dashboard()
    // {
	// 	$data = [
	// 		'users' 		=> User::all(),
	// 		'profiles' 		=> Profile::all(),
	// 		'categories' 	=> Category::all(),
	// 		'genres' 		=> Genre::all(),
	// 		'offers' 		=> Offer::all(),
 	// 	];
    //     return view('admin.dashboard',$data);
    // }

	/**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %   ADVANCED SEARCH no filter   %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 *  
	 * ! equivale alla CRUD profiles > index, devo metterla in ProfileController@search ? 
	 * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
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
     * @return \Illuminate\Contracts\Support\Renderable
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
	 * #################################
	 * #         CODE TEST PAGE        #
	 * #################################
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function test()
    {
		$data = [
			'users' 		=> User::all(),		
			'profiles' 		=> Profile::all(),
			'categories' 	=> Category::all(),
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
 		];
        return view('test',$data); 
    }

}
