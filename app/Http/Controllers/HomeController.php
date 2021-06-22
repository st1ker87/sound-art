<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Category;
use App\Genre;
use App\Offer;
use App\Message;
use App\Review;
use App\Contract;
use App\Sponsorship;

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
			'messages' 		=> Message::all(),
			'reviews' 		=> Review::all(),
			'contracts' 	=> Contract::all(),
			'sponsorships' 	=> Sponsorship::all(),
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
    public function test1()
    {
		$data = [
			'users' 		=> User::all(),		
			'profiles' 		=> Profile::all(),
			'categories' 	=> Category::all(),
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
			'messages' 		=> Message::all(),
			'reviews' 		=> Review::all(),
			'contracts' 	=> Contract::all(),
			'sponsorships' 	=> Sponsorship::all(),
		];
        return view('test.test1',$data); 
    }

	/**
	 * #################################
	 * #       CODE TEST PAGE 2        #
	 * #################################
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function test2()
    {
		$data = [
			'users' 		=> User::all(),		
			'profiles' 		=> Profile::all(),
			'categories' 	=> Category::all(),
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
			'messages' 		=> Message::all(),
			'reviews' 		=> Review::all(),
			'contracts' 	=> Contract::all(),
			'sponsorships' 	=> Sponsorship::all(),
 		];
        return view('test.test2',$data); 
    }

	/**
	 * #################################
	 * #       CODE TEST PAGE 3        #
	 * #################################
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function test3()
    {
		$data = [
			'users' 		=> User::all(),		
			'profiles' 		=> Profile::all(),
			'categories' 	=> Category::all(),
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
			'messages' 		=> Message::all(),
			'reviews' 		=> Review::all(),
			'contracts' 	=> Contract::all(),
			'sponsorships' 	=> Sponsorship::all(),
 		];
        return view('test.test3',$data); 
    }

}
