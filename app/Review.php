<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
		'user_id','slug',
		'rev_sender_name','rev_subject','rev_vote','rev_text'
	];

	/**
	 * ! Review <N1> User !
	 * 
	 * Each Review belongs to 1 User
	 * >>> user() singular
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
