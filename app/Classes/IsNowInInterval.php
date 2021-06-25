<?php 

namespace App\Classes;

use DateTime;

class IsNowInInterval {
	/**
	 * INPUT  : $_time_start, $_time_end times in DB format (created_at) [ 2021-06-25 13:00:20 ]
	 * OUTPUT : true/false whether the present moment is in given interval
	 * 
	 * to use this class: 
	 * 		use App\Classes\IsNowInInterval;
	 * 		$condition = (new IsNowInInterval)->get($start,$end);
	 */
    public function get($_time_start,$_time_end) {
		date_default_timezone_set('Europe/Rome');
		$ret   = false;
		$start = DateTime::createFromFormat('Y-m-d H:i:s', $_time_start);
		$end   = DateTime::createFromFormat('Y-m-d H:i:s', $_time_end);
		$now   = new DateTime();
		if ($start < $now && $end >= $now) $ret = true;
		return $ret;
    }
}
