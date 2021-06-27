<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Profile;
use App\Message;

class MessageController extends Controller
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

	// 	return view('guest.messages.create',$data);
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
		$this->messageValidation($request);

		// message recipient is user $id
		$profile = Profile::where('user_id',$id)->first();

		$form_data = $request->All();

		$new_message = new Message;
		$new_message['user_id']				= $id;
		$new_message['slug']				= $this->slugGeneration($form_data['subject']);
		$new_message['msg_sender_email']	= $form_data['email'];
		$new_message['msg_sender_name']		= $form_data['name'];
		$new_message['msg_subject']			= $form_data['subject'];
		$new_message['msg_text']			= $form_data['text'];
		$new_message['msg_read_status']		= 0;

		// ! before writing in DB the created_at
		date_default_timezone_set('Europe/Rome');

		$new_message->save(); // ! DB writing here !

		return redirect()->route('profiles.show',$profile->slug)->with('status','Message sent');
    }

	/**
	 * #################################
	 * #       MESSAGE VALIDATION      #
	 * #################################
     *
	 * Message: form data validation
	 * https://laravel.com/docs/7.x/validation
	 * errors shown in EDIT/CREATE view
	 * 
	 * @param  \Illuminate\Http\Request  $req
	 */
	protected function messageValidation($req) {
		$req->validate([
			'email'		=> 'required',
			'subject'	=> 'required|max:255',
			'text'		=> 'required',
		]);
	}

	/**
	 * #################################
	 * #         MESSAGE SLUG          #
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
		$slug_is_present = Message::where('slug',$slug)->first();
		$counter = 1;
		while ($slug_is_present) {
			$slug = $slug_tmp.'-'.$counter;
			$counter++;
			$slug_is_present = Message::where('slug',$slug)->first();
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
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }













}
