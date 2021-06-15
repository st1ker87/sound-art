<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

	/**
	 * ! User <11> Profile !
	 * 
	 * Each User has only 1 Profile
	 * >>> profile() singular
	 */
	public function profile()
	{
		return $this->hasOne('App\Profile');
	}

	/**
	 * ! User <1N> Message !
	 * 
	 * Each User has many messages
	 * >>> messages() plural
	 */
	public function messages()
	{
		return $this->hasMany('App\Message');
	}

	/**
	 * ! User <1N> Review !
	 * 
	 * Each User has many reviews
	 * >>> reviews() plural
	 */
	public function reviews()
	{
		return $this->hasMany('App\Review');
	}

	/**
	 * ! User <NM> Category !
	 * 
	 * Each User belongs to many categories
	 * >>> categories() plural
	 */
	public function categories()
	{
		return $this->belongsToMany('App\Category','user_category');
	}

	/**
	 * ! User <NM> Genre !
	 * 
	 * Each User belongs to many genres
	 * >>> genres() plural
	 */
	public function genres()
	{
		return $this->belongsToMany('App\Genre','user_genre');
	}

	/**
	 * ! User <NM> Offer !
	 * 
	 * Each User belongs to many offers
	 * >>> offers() plural
	 */
	public function offers()
	{
		return $this->belongsToMany('App\Offer','user_offer');
	}

	/**
	 * ! User <1N> Contract !
	 * 
	 * Each User has many contracts
	 * >>> contracts() plural
	 */
	public function contracts()
	{
		return $this->hasMany('App\Contract');
	}

}


