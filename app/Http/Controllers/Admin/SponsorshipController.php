<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Classes\IsNowInInterval;

use App\Sponsorship;

date_default_timezone_set('Europe/Rome');

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
			if ((new IsNowInInterval)->get($my_contract->date_start,$my_contract->date_end)) 
				$is_active_sponsorship = true;
		}
		if ($is_active_sponsorship)
			return redirect()->route('dashboard')->withErrors('A Sponsorship is already active!');

		$data = [
			'sponsorships'	=> Sponsorship::all(),
 		];

		if(!$data['sponsorships']) {
			abort(404);
		}

		return view('admin.sponsorships.index',$data);
    }




























    /**
     * Display the specified resource.
     *
     * @param  \App\Sponsorship  $sponsorship
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsorship $sponsorship)
    {
		//
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
