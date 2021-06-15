<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

	/**
	 * ! Offer <MN> User !
	 * 
	 * Each Offer belongs to many users
	 * >>> users() plural
	 */
	public function users()
	{
		return $this->belongsToMany('App\User','user_offer');
	}
}
