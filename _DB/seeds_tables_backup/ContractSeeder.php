<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Sponsorship;
use App\Contract;

date_default_timezone_set('Europe/Rome');

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		/**
		 * Contract Model $fillable:
		 * 	'user_id', 'sponsorship_id', 'date_start', 'date_end', 'transaction_status'
		 */

		$fraction_of_users_with_contract = 0.3;

		$users = User::all();
		foreach ($users as $user) $user_ids[] = $user->id;
		$number_of_contracts = round($fraction_of_users_with_contract*count($users));
		
		$sponsosrships = Sponsorship::all();
		foreach ($sponsosrships as $sponsosrship) $sponsosrship_ids[] = $sponsosrship->id;

		$sel_user_ids =[];
		while (count($sel_user_ids) < $number_of_contracts) {
			$sel_user_id = $user_ids[random_int(0,count($user_ids)-1)];
			if (!in_array($sel_user_id,$sel_user_ids)) $sel_user_ids[] = $sel_user_id;
		}
		
		for ($i=0; $i<$number_of_contracts; $i++) {

			$new_contract = new Contract;
			$new_contract['user_id'] = $sel_user_ids[$i];
			$new_contract['sponsorship_id'] = $sponsosrship_ids[random_int(0,count($sponsosrship_ids)-1)];

			$date = new DateTime();
			date_add($date, date_interval_create_from_date_string(($i).' minutes'));
			$date_start = date_format($date, 'Y-m-d H:i:s');
			date_add($date, date_interval_create_from_date_string((15+$i).' hours'));
			$date_end = date_format($date, 'Y-m-d H:i:s');
			$new_contract['date_start'] = $date_start;
			$new_contract['date_end'] 	= $date_end;

			$new_contract['transaction_status'] = 'submitted_for_settlement';

			$new_contract->save(); // ! DB writing here ! 

		}

    }
}
