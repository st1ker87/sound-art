<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
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
	 * ! Genre <MN> User !
	 * 
	 * Each Genre belongs to many users
	 * >>> users() plural
	 */
	public function users()
	{
		return $this->belongsToMany('App\User');
	}
}
