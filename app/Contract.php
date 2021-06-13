<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'sponsorship_id', 
		'date_start', 'date_end',
		'transaction_status'
    ];

	/**
	 * ! Contract <N1> User !
	 * 
	 * Each Contract belongs to 1 User
	 * >>> user() singular
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * ! Contract <N1> Sponsorship !
	 * 
	 * Each Contract belongs to 1 Sponsorship
	 * >>> sponsorship() singular
	 */
	public function sponsorship()
	{
		return $this->belongsTo('App\Sponsorship');
	}

}
