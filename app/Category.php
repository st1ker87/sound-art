<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
	 * ! Category <MN> User !
	 * 
	 * Each Category belongs to many users
	 * >>> users() plural
	 */
	public function users()
	{
		return $this->belongsToMany('App\User','user_category');
	}
}
