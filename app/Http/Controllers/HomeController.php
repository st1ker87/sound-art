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
    public function search()
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
