<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
		'user_id','slug',
		'msg_sender_email','msg_sender_name','msg_subject','msg_text','msg_read_status'
	];

	/**
	 * ! Message <N1> User !
	 * 
	 * Each Message belongs to 1 User
	 * >>> user() singular
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
