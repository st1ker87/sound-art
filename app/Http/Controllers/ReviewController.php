<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Profile;
use App\Review;

class ReviewController extends Controller
{
    /**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %            CREATE             %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
	 * 
	 * ! OBSOLETO PER MODALITÀ MODAL
     */
    // public function create($slug)
    // {
	// 	// recipient: from profile $slug to $user
	// 	$profile = Profile::where('slug',$slug)->first();
	// 	$user 	 = User::where('id',$profile->user_id)->first();

	// 	$data = [
	// 		'user' => $user,
 	// 	];
		
	// 	if(!$data['user']) {
	// 		abort(404);
	// 	}

	// 	return view('guest.reviews.create',$data);
    // }

    /**
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * %             STORE             %
	 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
	 * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
		// validazione parte post 
		$this->reviewValidation($request);

		// review recipient is user $id
		$profile = Profile::where('user_id',$id)->first();

		$form_data = $request->All();

		$new_review = new Review;
		$new_review['user_id']			= $id;
		$new_review['slug']				= $this->slugGeneration($form_data['subject']);
		$new_review['rev_sender_name']	= $form_data['name'];
		$new_review['rev_subject']		= $form_data['subject'];
		$new_review['rev_vote']			= $form_data['vote'];
		$new_review['rev_text']			= $form_data['text'];

		// ! before writing in DB the created_at
		date_default_timezone_set('Europe/Rome');

		$new_review->save(); // ! DB writing here !

		return redirect()->route('profiles.show',$profile->slug)->with('status','Review sent');
    }

	/**
	 * #################################
	 * #       REVIEW VALIDATION       #
	 * #################################
     *
	 * Review: form data validation
	 * https://laravel.com/docs/7.x/validation
	 * errors shown in EDIT/CREATE view
	 * 
	 * @param  \Illuminate\Http\Request  $req
	 */
	protected function reviewValidation($req) {
		$req->validate([
			'subject'	=> 'required|max:255',
			'vote'		=> 'required',
			'text'		=> 'required',
		]);
	}

	/**
	 * #################################
	 * #          REVIEW SLUG          #
	 * #################################
     *
	 * Creazione slug a partire da stringa sorgente
	 * deve essere unico nellla tabella profiles
	 * 
	 * @param string $slug_source
	 * @return string
	 */
	protected function slugGeneration($slug_source) {
		$slug = Str::slug($slug_source,'-');
		$slug_tmp = $slug;
		$slug_is_present = Review::where('slug',$slug)->first();
		$counter = 1;
		while ($slug_is_present) {
			$slug = $slug_tmp.'-'.$counter;
			$counter++;
			$slug_is_present = Review::where('slug',$slug)->first();
		}
		return $slug;
	}

























	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
