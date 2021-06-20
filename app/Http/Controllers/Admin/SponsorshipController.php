<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;

use App\User;
use App\Profile;
use App\Category;
use App\Genre;
use App\Offer;
use App\Review;
use App\Message;
use App\Sponsorship;
use App\Contract;

class SponsorshipController extends Controller
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
		// double check: creation only for users without sponsorship
		$my_contracts = Auth::user()->contracts;
		$is_active_sponsorship = false;
		foreach ($my_contracts as $my_contract) {
			$date_start = DateTime::createFromFormat('Y-m-d H:i:s', $my_contract->date_start);
			$date_end   = DateTime::createFromFormat('Y-m-d H:i:s', $my_contract->date_end);
			$now 		= new DateTime();
			if ($date_start < $now && $date_end >= $now) $is_active_sponsorship = true;
		}
		if ($is_active_sponsorship)
			return redirect()->route('dashboard')->with('status','A Sponsorship is already active!');

		$data = [
			'users'			=> User::all(),
			'profiles'		=> Profile::all(),
			'categories'	=> Category::all(),
			'genres'		=> Genre::all(),
			'offers'		=> Offer::all(),
			'messages'		=> Message::all(),
			'reviews'		=> Review::all(),
			'sponsorships'	=> Sponsorship::all(),
			'contracts'		=> Contract::all(),
 		];

		return view('admin.sponsorships.index',$data);
    }

    /**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %             SHOW              %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * 
     * Display the specified resource.
     *
     * @param  \App\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function show($id) // origniale: show(Sponsorship $sponsorship)
    {
		$data = [
			// main info: passed resource
			'sponsorship'	=> Sponsorship::where('id',$id)->first(),
			// aux infos: db tables
			'users' 		=> User::all(),
			'profiles'		=> Profile::all(),
			'categories'	=> Category::all(),
			'genres' 		=> Genre::all(),
			'offers' 		=> Offer::all(),
			'messages' 		=> Message::all(),
			'reviews' 		=> Review::all(),
			'sponsorships'	=> Sponsorship::all(),
			'contracts'		=> Contract::all(),
 		];

		if(!$data['sponsorship']) {
			abort(404);
		}

		return view('admin.sponsorships.show',$data);
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsorship $sponsorship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsorship $sponsorship)
    {
        //
    }
}
