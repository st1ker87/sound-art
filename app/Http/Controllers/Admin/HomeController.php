<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
	 * %           DASHBOARD           %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
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
    
}
