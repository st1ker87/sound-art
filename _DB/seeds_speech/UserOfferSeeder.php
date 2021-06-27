<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Offer;
use Illuminate\Support\Facades\DB;

class UserOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		/** 
		 * ! ************************************* !
		 * !                                       !
		 * ! ESEGUIRE SOLO DOPO SEED TABELLA USERS !
		 * !            E TABELLA OFFER            !
		 * !                                       !
		 * ! ************************************* !
		 */

		$min_num_offers_per_user = 0;
		$max_num_offers_per_user = 2;

		$users = User::All();
		$offers = Offer::All();

		$tag_ids = [];
		foreach ($offers as $offer) $tag_ids[] = $offer['id'];

		foreach ($users as $user) {

			shuffle($tag_ids);
			$tag_num = random_int($min_num_offers_per_user,$max_num_offers_per_user);

			for ($i=0; $i<$tag_num; $i++) {

				DB::table('user_offer')->insert([
        			'user_id'	=> $user['id'],  
        			'offer_id' 	=> $tag_ids[$i],
    			]);

			}
		}
    }
}
