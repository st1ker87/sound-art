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
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %     HOME & SIMPLE SEARCH      %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
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
