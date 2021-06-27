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
use App\Contract;
use App\Sponsorship;

class HomeController extends Controller
{
	/**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %        INDEX (DASHBOARD)      %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data = [
			// 'users' 		=> User::all(),
			// 'profiles' 		=> Profile::all(),
			// 'categories' 	=> Category::all(),
			// 'genres' 		=> Genre::all(),
			// 'offers' 		=> Offer::all(),
			// 'messages' 		=> Message::all(),
			// 'reviews' 		=> Review::all(),
 		];

        return view('admin.dashboard',$data);
    }

	/**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %           STATISTICS          %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function statistics()
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

        return view('admin.statistics',$data);
    }
}
