<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/*
	User <-> users 
	create_users_tabe
	/////////////////////////////////////////////////////////////////////////////////////
	profile() 	{ return $this->hasOne('App\Profile'); }

	categories(){ return $this->belongsToMany('App\Category'); }
	genres() 	{ return $this->belongsToMany('App\Genre'); }
	offers() 	{ return $this->belongsToMany('App\Offer'); }

	contracts() { return $this->hasMany('App\Contract'); }
	reviews()	{ return $this->hasMany('App\Review') }
	messages()	{ return $this->hasMany('App\Message') }
	/////////////////////////////////////////////////////////////////////////////////////
	CRUD:
		YES > utente registrato: dettaglio SE STESSO, delete SOLO SE STESSO (eventualmente)
		Controllers/Admin/UserController
*/

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
}
