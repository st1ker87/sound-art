<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'hour_duration', 'price'
    ];

	/**
	 * ! Sponsorship <1N> Contract !
	 * 
	 * Each Sponsorship has many contracts
	 * >>> contracts() plural
	 */
	public function contracts()
	{
		return $this->hasMany('App\Contract');
	}

}
