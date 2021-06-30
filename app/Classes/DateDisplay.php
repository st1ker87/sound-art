<?php 

namespace App\Classes;

use Illuminate\Support\Facades\Route;
use DateTime;

class DateDisplay {
	/**
	 * INPUT  : data-ora del DB (created_at) [ 2021-06-25 13:00:20 ]
	 * OUTPUT : data-ora leggibile, inglese  [ Friday June 25, 2021, 13:00:20 ]
	 * 
	 * to use this class: 
	 * 		use App\Classes\DateDisplay;
	 * 		$date = (new DateDisplay)->get($date);
	 */
    public function get($_db_time) {
		date_default_timezone_set('Europe/Rome');
		// create DateTime object
		$_db_time = DateTime::createFromFormat('Y-m-d H:i:s', $_db_time);
		// get string time

		// if ((Route::currentRouteName() == 'my_sponsorships')) 
		// 	return date_format($_db_time, 'l F j, Y');			// ! without hour
		
		return date_format($_db_time, 'l F j, Y, G:i');			// ! with hour, without seconds
		// return date_format($_db_time, 'l F j, Y, G:i:s'); 	// ! with hour and  seconds
    }
}

