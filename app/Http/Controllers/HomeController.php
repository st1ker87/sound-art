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

	/**
     * ! DASHBOARD
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin_index()
    {
		$data = [
			'users' 		=> User::all(),
			'profiles' 		=> Profile::all(),
			'categories' 	=> Category::all(),
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
 		];
        return view('admin.dashboard',$data);
    }

	/**
     * ! ADVANCED SEARCH
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
		$data = [
			'users' 		=> User::all(),			// $users > Collection
			'profiles' 		=> Profile::all(),		// $profiles >>>> $profile->user_id->categories
			'categories' 	=> Category::all(),		// $categories
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
 		];
        return view('guest.profiles.search',$data); // CRUD index profiles 
    }

    /**
     * ! SEARCH FROM HOME
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search_from_home(Request $request)
    {
        $form_data = $request->all();
        $search_from_home = [];
        $search_from_home['id'] = $form_data['id'];
        if (array_key_exists('category', $form_data)) {
            $search_from_home['category'] = $form_data['category'];   
        }
        else {
            $search_from_home['genre'] = $form_data['genre'];
        }
		$data = [
			'users' 		=> User::all(),			// $users > Collection
			'profiles' 		=> Profile::all(),		// $profiles >>>> $profile->user_id->categories
			'categories' 	=> Category::all(),		// $categories
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
            'search_from_home' => $search_from_home
 		];
        return view('guest.profiles.search',$data); // CRUD index profiles 
    }

	/**
     * ! TEST PAGE
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
