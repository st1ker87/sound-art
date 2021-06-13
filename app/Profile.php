<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
		'user_id','slug',
		'work_town','work_address','work_address_gps','phone',
		'bio_text1','bio_text2','bio_text3','image_url','video_url','public'
	];

	/**
	 * ! Profile<11>User !
	 * 
	 * Each Profile belongs to only 1 User
	 * >>> user() singular
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

}
